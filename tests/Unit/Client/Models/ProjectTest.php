<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client\Models;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Client\Project;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{

    public function testGetDataReturnsCorrectProjectModel(): void
    {
        $projectModel = $this->getExampleProjectModel();
        $project = new Project(new ModrinthAPIClient(), $projectModel);
        $this->assertEquals($projectModel, $project->getData());
    }

    protected function getExampleProjectModel(): \Aternos\ModrinthApi\Model\Project
    {
        $json = json_decode(file_get_contents(__DIR__ . "/../Fixtures/get_project_response.json"), true);
        return new \Aternos\ModrinthApi\Model\Project($json);
    }
}