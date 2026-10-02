<?php

namespace Aternos\ModrinthApi\Tests\Unit\Client;

use Aternos\ModrinthApi\Client\ModrinthAPIClient;
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\ObjectSerializer;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * Base class for unit tests that run against a mocked HTTP client.
 *
 * No test in this hierarchy may perform a real request, so every client is built
 * on a Guzzle MockHandler. Clients also get their own Configuration instance,
 * because Configuration::getDefaultConfiguration() is a process wide singleton
 * and an API token set on it would leak into every other test.
 */
abstract class ClientTestCase extends TestCase
{
    /**
     * Requests recorded by the history middleware of the most recent client
     * @var array<int, array{request: RequestInterface, response: mixed}>
     */
    protected array $requests = [];

    protected const string API_TOKEN = "mrp_unit_test_token";

    public function setUp(): void
    {
        $this->requests = [];
    }

    /**
     * Create a client that answers every request with one of the given responses, in order
     * @param Response[] $responses
     * @param string|null $apiToken
     * @return ModrinthAPIClient
     */
    protected function createClient(array $responses = [], ?string $apiToken = null): ModrinthAPIClient
    {
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->requests));

        return new ModrinthAPIClient($apiToken, new Configuration(), new Client(['handler' => $stack]));
    }

    /**
     * Create a client with an API token set, so that authenticated endpoints can be called
     * @param Response[] $responses
     * @return ModrinthAPIClient
     */
    protected function createAuthenticatedClient(array $responses = []): ModrinthAPIClient
    {
        return $this->createClient($responses, static::API_TOKEN);
    }

    /**
     * Build a 200 response from an array, encoded as JSON
     * @param mixed $data
     * @return Response
     */
    protected function jsonResponse(mixed $data): Response
    {
        return new Response(200, ["Content-Type" => "application/json"], json_encode($data));
    }

    /**
     * Build a 200 response from one of the files in tests/Unit/Client/Fixtures
     * @param string $name file name without the .json extension
     * @return Response
     */
    protected function fixtureResponse(string $name): Response
    {
        return new Response(200, ["Content-Type" => "application/json"], $this->fixture($name));
    }

    /**
     * Read a fixture file
     * @param string $name file name without the .json extension
     * @return string
     */
    protected function fixture(string $name): string
    {
        $path = __DIR__ . "/Fixtures/" . $name . ".json";
        $contents = file_get_contents($path);
        $this->assertIsString($contents, "Missing fixture " . $path);
        return $contents;
    }

    /**
     * Read a fixture file and decode it
     * @param string $name file name without the .json extension
     * @return array
     */
    protected function fixtureData(string $name): array
    {
        return json_decode($this->fixture($name), true);
    }

    /**
     * Build a model from a fixture file the same way the generated API classes do.
     *
     * Model constructors only fill their own container, they do not deserialize nested
     * models, so building a model from a decoded fixture array directly would leave
     * nested properties as plain arrays.
     *
     * @template T
     * @param string $name file name without the .json extension
     * @param class-string<T> $class model class, append [] for a list of models
     * @return T
     */
    protected function fixtureModel(string $name, string $class): mixed
    {
        return ObjectSerializer::deserialize(json_decode($this->fixture($name)), $class);
    }

    /**
     * Get a request recorded by the history middleware
     * @param int $index
     * @return RequestInterface
     */
    protected function getRequest(int $index = 0): RequestInterface
    {
        $this->assertArrayHasKey($index, $this->requests, "No request was sent at index " . $index);
        return $this->requests[$index]["request"];
    }

    /**
     * Assert the number of requests that were sent
     * @param int $count
     * @return void
     */
    protected function assertRequestCount(int $count): void
    {
        $this->assertCount($count, $this->requests);
    }

    /**
     * Assert that a recorded request used the given method and path
     * @param string $method
     * @param string $path
     * @param int $index
     * @return void
     */
    protected function assertRequest(string $method, string $path, int $index = 0): void
    {
        $request = $this->getRequest($index);
        $this->assertEquals($method, $request->getMethod());
        $this->assertEquals($path, $request->getUri()->getPath());
    }

    /**
     * Assert that a recorded request was authenticated with the test API token
     * @param int $index
     * @return void
     */
    protected function assertRequestAuthenticated(int $index = 0): void
    {
        $this->assertEquals(static::API_TOKEN, $this->getRequest($index)->getHeaderLine("Authorization"));
    }
}
