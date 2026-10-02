<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\List;

use Aternos\ModrinthApi\Client\List\PaginatedProjectSearchList;
use Aternos\ModrinthApi\Client\Options\ProjectSearchOptions;
use Aternos\ModrinthApi\Client\SearchProject;
use Aternos\ModrinthApi\Tests\Unit\Client\ClientTestCase;
use GuzzleHttp\Psr7\Response;

/**
 * Tests for PaginatedProjectSearchList and the PaginatedList base class.
 *
 * Paging is mocked instead of hitting the API, so that the total number of hits
 * stays small enough to walk every page in a test.
 */
class PaginatedProjectSearchListTest extends ClientTestCase
{
    protected const int TOTAL_HITS = 5;
    protected const int LIMIT = 2;

    /**
     * Build a search response page where every hit has a predictable project id
     * @param int $offset
     * @param int $limit
     * @param int $totalHits
     * @return Response
     */
    protected function searchPage(int $offset, int $limit = self::LIMIT, int $totalHits = self::TOTAL_HITS): Response
    {
        $template = $this->fixtureData("search_projects_response")["hits"][0];

        $hits = [];
        for ($i = $offset; $i < min($offset + $limit, $totalHits); $i++) {
            $hits[] = array_merge($template, [
                "project_id" => "project-" . $i,
                "slug" => "project-" . $i,
                "title" => "Project " . $i,
            ]);
        }

        return $this->jsonResponse([
            "hits" => $hits,
            "offset" => $offset,
            "limit" => $limit,
            "total_hits" => $totalHits,
        ]);
    }

    public function testResultsAreWrappedInSearchProjects(): void
    {
        $client = $this->createClient([$this->searchPage(0)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $this->assertInstanceOf(PaginatedProjectSearchList::class, $list);
        $this->assertCount(2, $list->getResults());
        foreach ($list->getResults() as $project) {
            $this->assertInstanceOf(SearchProject::class, $project);
        }
        $this->assertEquals("project-0", $list->getResults()[0]->getProjectId());
    }

    public function testCountable(): void
    {
        $client = $this->createClient([$this->searchPage(0)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $this->assertCount(2, $list);
        $this->assertEquals(2, $list->count());
    }

    public function testIterator(): void
    {
        $client = $this->createClient([$this->searchPage(0)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $seen = [];
        foreach ($list as $key => $project) {
            $seen[$key] = $project->getProjectId();
        }
        $this->assertEquals([0 => "project-0", 1 => "project-1"], $seen);

        // the iterator must be rewindable
        $second = [];
        foreach ($list as $project) {
            $second[] = $project->getProjectId();
        }
        $this->assertEquals(["project-0", "project-1"], $second);
    }

    public function testIteratorMethodsDirectly(): void
    {
        $client = $this->createClient([$this->searchPage(0)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $this->assertTrue($list->valid());
        $this->assertEquals(0, $list->key());
        $this->assertEquals("project-0", $list->current()->getProjectId());

        $list->next();
        $this->assertTrue($list->valid());
        $this->assertEquals(1, $list->key());
        $this->assertEquals("project-1", $list->current()->getProjectId());

        $list->next();
        $this->assertFalse($list->valid());

        $list->rewind();
        $this->assertTrue($list->valid());
        $this->assertEquals(0, $list->key());
    }

    public function testArrayAccess(): void
    {
        $client = $this->createClient([$this->searchPage(0)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $this->assertTrue(isset($list[0]));
        $this->assertTrue($list->offsetExists(1));
        $this->assertFalse(isset($list[5]));
        $this->assertEquals("project-0", $list[0]->getProjectId());

        $replacement = $list[1];
        $list[0] = $replacement;
        $this->assertSame($replacement, $list[0]);

        unset($list[1]);
        $this->assertFalse(isset($list[1]));
        $this->assertCount(1, $list);
    }

    public function testFirstPageHasNoPreviousPage(): void
    {
        $client = $this->createClient([$this->searchPage(0)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $this->assertFalse($list->hasPreviousPage());
        $this->assertNull($list->getPreviousPage());
        $this->assertRequestCount(1);
    }

    public function testLastPageHasNoNextPage(): void
    {
        $client = $this->createClient([$this->searchPage(4)]);
        $list = $client->searchProjects(
            (new ProjectSearchOptions())->setLimit(static::LIMIT)->setOffset(4)
        );

        $this->assertCount(1, $list);
        $this->assertFalse($list->hasNextPage());
        $this->assertNull($list->getNextPage());
        $this->assertRequestCount(1);
    }

    public function testGetNextPage(): void
    {
        $client = $this->createClient([$this->searchPage(0), $this->searchPage(2)]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $this->assertTrue($list->hasNextPage());
        $next = $list->getNextPage();

        $this->assertInstanceOf(PaginatedProjectSearchList::class, $next);
        $this->assertEquals("project-2", $next[0]->getProjectId());
        parse_str($this->getRequest(1)->getUri()->getQuery(), $query);
        $this->assertEquals("2", $query["offset"]);
    }

    public function testGetPreviousPage(): void
    {
        $client = $this->createClient([$this->searchPage(2), $this->searchPage(0)]);
        $list = $client->searchProjects(
            (new ProjectSearchOptions())->setLimit(static::LIMIT)->setOffset(2)
        );

        $this->assertTrue($list->hasPreviousPage());
        $previous = $list->getPreviousPage();

        $this->assertEquals("project-0", $previous[0]->getProjectId());
        parse_str($this->getRequest(1)->getUri()->getQuery(), $query);
        $this->assertEquals("0", $query["offset"]);
    }

    public function testGetPreviousPageClampsOffsetToZero(): void
    {
        $client = $this->createClient([$this->searchPage(1), $this->searchPage(0)]);
        $list = $client->searchProjects(
            (new ProjectSearchOptions())->setLimit(static::LIMIT)->setOffset(1)
        );

        $list->getPreviousPage();
        parse_str($this->getRequest(1)->getUri()->getQuery(), $query);
        $this->assertEquals("0", $query["offset"]);
    }

    public function testGetOffsetDoesNotModifyTheOriginalOptions(): void
    {
        $options = (new ProjectSearchOptions())->setLimit(static::LIMIT);
        $client = $this->createClient([$this->searchPage(0), $this->searchPage(2)]);

        $list = $client->searchProjects($options);
        $list->getOffset(2);

        $this->assertEquals(0, $options->getOffset());
    }

    public function testGetResultsFromFollowingPages(): void
    {
        $client = $this->createClient([
            $this->searchPage(0),
            $this->searchPage(2),
            $this->searchPage(4),
        ]);
        $list = $client->searchProjects((new ProjectSearchOptions())->setLimit(static::LIMIT));

        $results = $list->getResultsFromFollowingPages();
        $this->assertCount(static::TOTAL_HITS, $results);
        $this->assertEquals(
            ["project-0", "project-1", "project-2", "project-3", "project-4"],
            array_map(fn(SearchProject $project) => $project->getProjectId(), $results)
        );
        $this->assertRequestCount(3);
    }

    public function testGetResultsFromFollowingPagesOnLastPage(): void
    {
        $client = $this->createClient([$this->searchPage(4)]);
        $list = $client->searchProjects(
            (new ProjectSearchOptions())->setLimit(static::LIMIT)->setOffset(4)
        );

        $this->assertCount(1, $list->getResultsFromFollowingPages());
        $this->assertRequestCount(1);
    }
}
