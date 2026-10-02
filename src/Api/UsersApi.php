<?php
/**
 * UsersApi
 * PHP version 8.1
 *
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Labrinth
 *
 * This documentation doesn't provide a way to test our API. In order to facilitate testing, we recommend the following tools:  - [cURL](https://curl.se/) (recommended, command-line) - [ReqBIN](https://reqbin.com/) (recommended, online) - [Postman](https://www.postman.com/downloads/) - [Insomnia](https://insomnia.rest/) - Your web browser, if you don't need to send headers or a request body  Once you have a working client, you can test that it works by making a `GET` request to `https://staging-api.modrinth.com/`:  ```json {   \"about\": \"Welcome traveler!\",   \"documentation\": \"https://docs.modrinth.com\",   \"name\": \"modrinth-labrinth\",   \"version\": \"2.7.0\" } ```  If you got a response similar to the one above, you can use the Modrinth API! When you want to go live using the production API, use `api.modrinth.com` instead of `staging-api.modrinth.com`.  ## Authentication This API has two options for authentication: personal access tokens and [OAuth2](https://en.wikipedia.org/wiki/OAuth). All tokens are tied to a Modrinth user and use the `Authorization` header of the request.  Example: ``` Authorization: mrp_RNtLRSPmGj2pd1v1ubi52nX7TJJM9sznrmwhAuj511oe4t1jAqAQ3D6Wc8Ic ```  You do not need a token for most requests. Generally speaking, only the following types of requests require a token: - those which create data (such as version creation) - those which modify data (such as editing a project) - those which access private data (such as draft projects, notifications, emails, and payout data)  Each request requiring authentication has a certain scope. For example, to view the email of the user being requested, the token must have the `USER_READ_EMAIL` scope. You can find the list of available scopes [on GitHub](https://github.com/modrinth/labrinth/blob/master/src/models/pats.rs#L15). Making a request with an invalid scope will return a 401 error.  Please note that certain scopes and requests cannot be completed with a personal access token or using OAuth. For example, deleting a user account can only be done through Modrinth's frontend.  A detailed guide on OAuth has been published in [Modrinth's technical documentation](https://docs.modrinth.com/guide/oauth).  ### Personal access tokens Personal access tokens (PATs) can be generated in from [the user settings](https://modrinth.com/settings/account).  ### GitHub tokens For backwards compatibility purposes, some types of GitHub tokens also work for authenticating a user with Modrinth's API, granting all scopes. **We urge any application still using GitHub tokens to start using personal access tokens for security and reliability purposes.** GitHub tokens will cease to function to authenticate with Modrinth's API as soon as version 3 of the API is made generally available.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/). This allows for cross-domain communication from the browser. All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.  ## Identifiers The majority of items you can interact with in the API have a unique eight-digit base62 ID. Projects, versions, users, threads, teams, and reports all use this same way of identifying themselves. Version files use the sha1 or sha512 file hashes as identifiers.  Each project and user has a friendlier way of identifying them; slugs and usernames, respectively. While unique IDs are constant, slugs and usernames can change at any moment. If you want to store something in the long term, it is recommended to use the unique ID.  ## Ratelimits The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers. - `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute - `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window - `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets  Ratelimits are the same no matter whether you use a token or not. The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:support@modrinth.com).  ## User Agents To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header. Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic. It is recommended, but not required, to include contact information in your user agent. This allows us to contact you if we would like a change in your application's behavior without having to block your traffic. - Bad: `User-Agent: okhttp/4.9.3` - Good: `User-Agent: project_name` - Better: `User-Agent: github_username/project_name/1.56.0` - Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`  ## Versioning Modrinth follows a simple pattern for its API versioning. In the event of a breaking API change, the API version in the URL path is bumped, and migration steps will be published below.  When an API is no longer the current one, it will immediately be considered deprecated. No more support will be provided for API versions older than the current one. It will be kept for some time, but this amount of time is not certain.  We will exercise various tactics to get people to update their implementation of our API. One example is by adding something like `STOP USING THIS API` to various data returned by the API.  Once an API version is completely deprecated, it will permanently return a 410 error. Please ensure your application handles these 410 errors.  ### Migrations Inside the following spoiler, you will be able to find all changes between versions of the Modrinth API, accompanied by tips and a guide to migrate applications to newer versions.  Here, you can also find changes for [Minotaur](https://github.com/modrinth/minotaur), Modrinth's official Gradle plugin. Major versions of Minotaur directly correspond to major versions of the Modrinth API.  <details><summary>API v1 to API v2</summary>  These bullet points cover most changes in the v2 API, but please note that fields containing `mod` in most contexts have been shifted to `project`.  For example, in the search route, the field `mod_id` was renamed to `project_id`.  - The search route has been moved from `/api/v1/mod` to `/v2/search` - New project fields: `project_type` (may be `mod` or `modpack`), `moderation_message` (which has a `message` and `body`), `gallery` - New search facet: `project_type` - Alphabetical sort removed (it didn't work and is not possible due to limits in MeiliSearch) - New search fields: `project_type`, `gallery`   - The gallery field is an array of URLs to images that are part of the project's gallery - The gallery is a new feature which allows the user to upload images showcasing their mod to the CDN which will be displayed on their mod page - Internal change: Any project file uploaded to Modrinth is now validated to make sure it's a valid Minecraft mod, Modpack, etc.   - For example, a Forge 1.17 mod with a JAR not containing a mods.toml will not be allowed to be uploaded to Modrinth - In project creation, projects may not upload a mod with no versions to review, however they can be saved as a draft   - Similarly, for version creation, a version may not be uploaded without any files - Donation URLs have been enabled - New project status: `archived`. Projects with this status do not appear in search - Tags (such as categories, loaders) now have icons (SVGs) and specific project types attached - Dependencies have been wiped and replaced with a new system - Notifications now have a `type` field, such as `project_update`  Along with this, project subroutes (such as `/v2/project/{id}/version`) now allow the slug to be used as the ID. This is also the case with user routes.  </details><details><summary>Minotaur v1 to Minotaur v2</summary>  Minotaur 2.x introduced a few breaking changes to how your buildscript is formatted.  First, instead of registering your own `publishModrinth` task, Minotaur now automatically creates a `modrinth` task. As such, you can replace the `task publishModrinth(type: TaskModrinthUpload) {` line with just `modrinth {`.  To declare supported Minecraft versions and mod loaders, the `gameVersions` and `loaders` arrays must now be used. The syntax for these are pretty self-explanatory.  Instead of using `releaseType`, you must now use `versionType`. This was actually changed in v1.2.0, but very few buildscripts have moved on from v1.1.0.  Dependencies have been changed to a special DSL. Create a `dependencies` block within the `modrinth` block, and then use `scope.type(\"project/version\")`. For example, `required.project(\"fabric-api\")` adds a required project dependency on Fabric API.  You may now use the slug anywhere that a project ID was previously required.  </details>
 *
 * The version of the OpenAPI document: v2.7.0/366f528
 * Contact: support@modrinth.com
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.25.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\ModrinthApi\Api;

use InvalidArgumentException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\HeaderSelector;
use Aternos\ModrinthApi\ObjectSerializer;

/**
 * UsersApi Class Doc Comment
 *
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UsersApi
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @var Configuration
     */
    protected Configuration $config;

    /**
     * @var HeaderSelector
     */
    protected HeaderSelector $headerSelector;

    /**
     * @var int Host index
     */
    protected int $hostIndex;

    /** @var array<string,string[]> $contentTypes **/
    public const contentTypes = [
        'changeUserIcon' => [
            'image/png',
            'image/jpeg',
            'image/bmp',
            'image/gif',
            'image/webp',
            'image/svg',
            'image/svgz',
            'image/rgb',
        ],
        'deleteUserIcon' => [
            'application/json',
        ],
        'getFollowedProjects' => [
            'application/json',
        ],
        'getPayoutHistory' => [
            'application/json',
        ],
        'getUser' => [
            'application/json',
        ],
        'getUserFromAuth' => [
            'application/json',
        ],
        'getUserProjects' => [
            'application/json',
        ],
        'getUsers' => [
            'application/json',
        ],
        'modifyUser' => [
            'application/json',
        ],
        'withdrawPayout' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface|null $client
     * @param Configuration|null   $config
     * @param HeaderSelector|null  $selector
     * @param int                  $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex(): int
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig(): Configuration
    {
        return $this->config;
    }

    /**
     * Operation changeUserIcon
     *
     * Change user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \SplFileObject|null $body body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeUserIcon'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\InvalidInputError|null
     */
    public function changeUserIcon(
        string $id_username,
        ?\SplFileObject $body = null,
        string $contentType = self::contentTypes['changeUserIcon'][0]
    ): ?\Aternos\ModrinthApi\Model\InvalidInputError
    {
        list($response) = $this->changeUserIconWithHttpInfo($id_username, $body, $contentType);
        return $response;
    }

    /**
     * Operation changeUserIconWithHttpInfo
     *
     * Change user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \SplFileObject|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeUserIcon'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: null, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function changeUserIconWithHttpInfo(
        string $id_username,
        ?\SplFileObject $body = null,
        string $contentType = self::contentTypes['changeUserIcon'][0]
    ): array
    {
        $request = $this->changeUserIconRequest($id_username, $body, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\InvalidInputError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation changeUserIconAsync
     *
     * Change user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \SplFileObject|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeUserIcon'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function changeUserIconAsync(
        string $id_username,
        ?\SplFileObject $body = null,
        string $contentType = self::contentTypes['changeUserIcon'][0]
    ): PromiseInterface
    {
        return $this->changeUserIconAsyncWithHttpInfo($id_username, $body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation changeUserIconAsyncWithHttpInfo
     *
     * Change user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \SplFileObject|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeUserIcon'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function changeUserIconAsyncWithHttpInfo(
        string $id_username,
        ?\SplFileObject $body = null,
        string $contentType = self::contentTypes['changeUserIcon'][0]
    ): PromiseInterface
    {
        $returnType = '';
        $request = $this->changeUserIconRequest($id_username, $body, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'changeUserIcon'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \SplFileObject|null $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeUserIcon'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function changeUserIconRequest(
        string $id_username,
        ?\SplFileObject $body = null,
        string $contentType = self::contentTypes['changeUserIcon'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling changeUserIcon'
            );
        }

        $resourcePath = '/user/{id|username}/icon';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                try {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($body), JSON_THROW_ON_ERROR);
                } catch (\JsonException $e) {
                    throw new \InvalidArgumentException('json_encode error: ' . $e->getMessage(), 0, $e);
                }
            } else {
                $httpBody = $body;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new \GuzzleHttp\Psr7\MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                try {
                    $httpBody = json_encode($formParams, JSON_THROW_ON_ERROR);
                } catch (\JsonException $e) {
                    throw new \InvalidArgumentException('json_encode error: ' . $e->getMessage(), 0, $e);
                }
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteUserIcon
     *
     * Remove user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteUserIcon'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\InvalidInputError|null
     */
    public function deleteUserIcon(
        string $id_username,
        string $contentType = self::contentTypes['deleteUserIcon'][0]
    ): ?\Aternos\ModrinthApi\Model\InvalidInputError
    {
        list($response) = $this->deleteUserIconWithHttpInfo($id_username, $contentType);
        return $response;
    }

    /**
     * Operation deleteUserIconWithHttpInfo
     *
     * Remove user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteUserIcon'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: null, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function deleteUserIconWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['deleteUserIcon'][0]
    ): array
    {
        $request = $this->deleteUserIconRequest($id_username, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\InvalidInputError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation deleteUserIconAsync
     *
     * Remove user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteUserIcon'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteUserIconAsync(
        string $id_username,
        string $contentType = self::contentTypes['deleteUserIcon'][0]
    ): PromiseInterface
    {
        return $this->deleteUserIconAsyncWithHttpInfo($id_username, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteUserIconAsyncWithHttpInfo
     *
     * Remove user&#39;s avatar
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteUserIcon'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function deleteUserIconAsyncWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['deleteUserIcon'][0]
    ): PromiseInterface
    {
        $returnType = '';
        $request = $this->deleteUserIconRequest($id_username, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'deleteUserIcon'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteUserIcon'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteUserIconRequest(
        string $id_username,
        string $contentType = self::contentTypes['deleteUserIcon'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling deleteUserIcon'
            );
        }

        $resourcePath = '/user/{id|username}/icon';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getFollowedProjects
     *
     * Get user&#39;s followed projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFollowedProjects'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Project[]|\Aternos\ModrinthApi\Model\AuthError
     */
    public function getFollowedProjects(
        string $id_username,
        string $contentType = self::contentTypes['getFollowedProjects'][0]
    ): array|\Aternos\ModrinthApi\Model\AuthError
    {
        list($response) = $this->getFollowedProjectsWithHttpInfo($id_username, $contentType);
        return $response;
    }

    /**
     * Operation getFollowedProjectsWithHttpInfo
     *
     * Get user&#39;s followed projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFollowedProjects'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: \Aternos\ModrinthApi\Model\Project[]|\Aternos\ModrinthApi\Model\AuthError, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function getFollowedProjectsWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getFollowedProjects'][0]
    ): array
    {
        $request = $this->getFollowedProjectsRequest($id_username, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\Project[]',
                        $request,
                        $response,
                    );
                case 401:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Aternos\ModrinthApi\Model\Project[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\Project[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation getFollowedProjectsAsync
     *
     * Get user&#39;s followed projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFollowedProjects'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFollowedProjectsAsync(
        string $id_username,
        string $contentType = self::contentTypes['getFollowedProjects'][0]
    ): PromiseInterface
    {
        return $this->getFollowedProjectsAsyncWithHttpInfo($id_username, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getFollowedProjectsAsyncWithHttpInfo
     *
     * Get user&#39;s followed projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFollowedProjects'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getFollowedProjectsAsyncWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getFollowedProjects'][0]
    ): PromiseInterface
    {
        $returnType = '\Aternos\ModrinthApi\Model\Project[]';
        $request = $this->getFollowedProjectsRequest($id_username, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getFollowedProjects'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getFollowedProjects'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getFollowedProjectsRequest(
        string $id_username,
        string $contentType = self::contentTypes['getFollowedProjects'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling getFollowedProjects'
            );
        }

        $resourcePath = '/user/{id|username}/follows';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getPayoutHistory
     *
     * Get user&#39;s payout history
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPayoutHistory'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\UserPayoutHistory|\Aternos\ModrinthApi\Model\AuthError
     */
    public function getPayoutHistory(
        string $id_username,
        string $contentType = self::contentTypes['getPayoutHistory'][0]
    ): \Aternos\ModrinthApi\Model\UserPayoutHistory|\Aternos\ModrinthApi\Model\AuthError
    {
        list($response) = $this->getPayoutHistoryWithHttpInfo($id_username, $contentType);
        return $response;
    }

    /**
     * Operation getPayoutHistoryWithHttpInfo
     *
     * Get user&#39;s payout history
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPayoutHistory'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: \Aternos\ModrinthApi\Model\UserPayoutHistory|\Aternos\ModrinthApi\Model\AuthError, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function getPayoutHistoryWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getPayoutHistory'][0]
    ): array
    {
        $request = $this->getPayoutHistoryRequest($id_username, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\UserPayoutHistory',
                        $request,
                        $response,
                    );
                case 401:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Aternos\ModrinthApi\Model\UserPayoutHistory',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\UserPayoutHistory',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation getPayoutHistoryAsync
     *
     * Get user&#39;s payout history
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPayoutHistory'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPayoutHistoryAsync(
        string $id_username,
        string $contentType = self::contentTypes['getPayoutHistory'][0]
    ): PromiseInterface
    {
        return $this->getPayoutHistoryAsyncWithHttpInfo($id_username, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getPayoutHistoryAsyncWithHttpInfo
     *
     * Get user&#39;s payout history
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPayoutHistory'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getPayoutHistoryAsyncWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getPayoutHistory'][0]
    ): PromiseInterface
    {
        $returnType = '\Aternos\ModrinthApi\Model\UserPayoutHistory';
        $request = $this->getPayoutHistoryRequest($id_username, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getPayoutHistory'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getPayoutHistory'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getPayoutHistoryRequest(
        string $id_username,
        string $contentType = self::contentTypes['getPayoutHistory'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling getPayoutHistory'
            );
        }

        $resourcePath = '/user/{id|username}/payouts';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUser
     *
     * Get a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUser'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\User
     */
    public function getUser(
        string $id_username,
        string $contentType = self::contentTypes['getUser'][0]
    ): \Aternos\ModrinthApi\Model\User
    {
        list($response) = $this->getUserWithHttpInfo($id_username, $contentType);
        return $response;
    }

    /**
     * Operation getUserWithHttpInfo
     *
     * Get a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUser'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: \Aternos\ModrinthApi\Model\User, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function getUserWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getUser'][0]
    ): array
    {
        $request = $this->getUserRequest($id_username, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\User',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Aternos\ModrinthApi\Model\User',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\User',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation getUserAsync
     *
     * Get a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUser'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserAsync(
        string $id_username,
        string $contentType = self::contentTypes['getUser'][0]
    ): PromiseInterface
    {
        return $this->getUserAsyncWithHttpInfo($id_username, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserAsyncWithHttpInfo
     *
     * Get a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUser'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserAsyncWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getUser'][0]
    ): PromiseInterface
    {
        $returnType = '\Aternos\ModrinthApi\Model\User';
        $request = $this->getUserRequest($id_username, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUser'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUser'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUserRequest(
        string $id_username,
        string $contentType = self::contentTypes['getUser'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling getUser'
            );
        }

        $resourcePath = '/user/{id|username}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUserFromAuth
     *
     * Get user from authorization header
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserFromAuth'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\User|\Aternos\ModrinthApi\Model\AuthError
     */
    public function getUserFromAuth(
        string $contentType = self::contentTypes['getUserFromAuth'][0]
    ): \Aternos\ModrinthApi\Model\User|\Aternos\ModrinthApi\Model\AuthError
    {
        list($response) = $this->getUserFromAuthWithHttpInfo($contentType);
        return $response;
    }

    /**
     * Operation getUserFromAuthWithHttpInfo
     *
     * Get user from authorization header
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserFromAuth'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: \Aternos\ModrinthApi\Model\User|\Aternos\ModrinthApi\Model\AuthError, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function getUserFromAuthWithHttpInfo(
        string $contentType = self::contentTypes['getUserFromAuth'][0]
    ): array
    {
        $request = $this->getUserFromAuthRequest($contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\User',
                        $request,
                        $response,
                    );
                case 401:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Aternos\ModrinthApi\Model\User',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\User',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation getUserFromAuthAsync
     *
     * Get user from authorization header
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserFromAuth'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserFromAuthAsync(
        string $contentType = self::contentTypes['getUserFromAuth'][0]
    ): PromiseInterface
    {
        return $this->getUserFromAuthAsyncWithHttpInfo($contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserFromAuthAsyncWithHttpInfo
     *
     * Get user from authorization header
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserFromAuth'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserFromAuthAsyncWithHttpInfo(
        string $contentType = self::contentTypes['getUserFromAuth'][0]
    ): PromiseInterface
    {
        $returnType = '\Aternos\ModrinthApi\Model\User';
        $request = $this->getUserFromAuthRequest($contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUserFromAuth'
     *
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserFromAuth'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUserFromAuthRequest(
        string $contentType = self::contentTypes['getUserFromAuth'][0]
    ): Request
    {

        $resourcePath = '/user';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUserProjects
     *
     * Get user&#39;s projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserProjects'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Project[]
     */
    public function getUserProjects(
        string $id_username,
        string $contentType = self::contentTypes['getUserProjects'][0]
    ): array
    {
        list($response) = $this->getUserProjectsWithHttpInfo($id_username, $contentType);
        return $response;
    }

    /**
     * Operation getUserProjectsWithHttpInfo
     *
     * Get user&#39;s projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserProjects'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: \Aternos\ModrinthApi\Model\Project[], 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function getUserProjectsWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getUserProjects'][0]
    ): array
    {
        $request = $this->getUserProjectsRequest($id_username, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\Project[]',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Aternos\ModrinthApi\Model\Project[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\Project[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation getUserProjectsAsync
     *
     * Get user&#39;s projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserProjects'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserProjectsAsync(
        string $id_username,
        string $contentType = self::contentTypes['getUserProjects'][0]
    ): PromiseInterface
    {
        return $this->getUserProjectsAsyncWithHttpInfo($id_username, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUserProjectsAsyncWithHttpInfo
     *
     * Get user&#39;s projects
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserProjects'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUserProjectsAsyncWithHttpInfo(
        string $id_username,
        string $contentType = self::contentTypes['getUserProjects'][0]
    ): PromiseInterface
    {
        $returnType = '\Aternos\ModrinthApi\Model\Project[]';
        $request = $this->getUserProjectsRequest($id_username, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUserProjects'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUserProjects'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUserProjectsRequest(
        string $id_username,
        string $contentType = self::contentTypes['getUserProjects'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling getUserProjects'
            );
        }

        $resourcePath = '/user/{id|username}/projects';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getUsers
     *
     * Get multiple users
     *
     * @param  string $ids The IDs of the users (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUsers'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\User[]
     */
    public function getUsers(
        string $ids,
        string $contentType = self::contentTypes['getUsers'][0]
    ): array
    {
        list($response) = $this->getUsersWithHttpInfo($ids, $contentType);
        return $response;
    }

    /**
     * Operation getUsersWithHttpInfo
     *
     * Get multiple users
     *
     * @param  string $ids The IDs of the users (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUsers'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: \Aternos\ModrinthApi\Model\User[], 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function getUsersWithHttpInfo(
        string $ids,
        string $contentType = self::contentTypes['getUsers'][0]
    ): array
    {
        $request = $this->getUsersRequest($ids, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\Aternos\ModrinthApi\Model\User[]',
                        $request,
                        $response,
                    );
            }

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\Aternos\ModrinthApi\Model\User[]',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\User[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation getUsersAsync
     *
     * Get multiple users
     *
     * @param  string $ids The IDs of the users (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUsers'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUsersAsync(
        string $ids,
        string $contentType = self::contentTypes['getUsers'][0]
    ): PromiseInterface
    {
        return $this->getUsersAsyncWithHttpInfo($ids, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getUsersAsyncWithHttpInfo
     *
     * Get multiple users
     *
     * @param  string $ids The IDs of the users (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUsers'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function getUsersAsyncWithHttpInfo(
        string $ids,
        string $contentType = self::contentTypes['getUsers'][0]
    ): PromiseInterface
    {
        $returnType = '\Aternos\ModrinthApi\Model\User[]';
        $request = $this->getUsersRequest($ids, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if (in_array($returnType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getUsers'
     *
     * @param  string $ids The IDs of the users (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getUsers'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getUsersRequest(
        string $ids,
        string $contentType = self::contentTypes['getUsers'][0]
    ): Request
    {
        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $ids when calling getUsers'
            );
        }

        $resourcePath = '/users';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ids,
            'ids', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation modifyUser
     *
     * Modify a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\EditableUser|null $editable_user Modified user fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyUser'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\AuthError|null
     */
    public function modifyUser(
        string $id_username,
        ?\Aternos\ModrinthApi\Model\EditableUser $editable_user = null,
        string $contentType = self::contentTypes['modifyUser'][0]
    ): ?\Aternos\ModrinthApi\Model\AuthError
    {
        list($response) = $this->modifyUserWithHttpInfo($id_username, $editable_user, $contentType);
        return $response;
    }

    /**
     * Operation modifyUserWithHttpInfo
     *
     * Modify a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\EditableUser|null $editable_user Modified user fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyUser'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: null, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function modifyUserWithHttpInfo(
        string $id_username,
        ?\Aternos\ModrinthApi\Model\EditableUser $editable_user = null,
        string $contentType = self::contentTypes['modifyUser'][0]
    ): array
    {
        $request = $this->modifyUserRequest($id_username, $editable_user, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation modifyUserAsync
     *
     * Modify a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\EditableUser|null $editable_user Modified user fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyUser'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function modifyUserAsync(
        string $id_username,
        ?\Aternos\ModrinthApi\Model\EditableUser $editable_user = null,
        string $contentType = self::contentTypes['modifyUser'][0]
    ): PromiseInterface
    {
        return $this->modifyUserAsyncWithHttpInfo($id_username, $editable_user, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyUserAsyncWithHttpInfo
     *
     * Modify a user
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\EditableUser|null $editable_user Modified user fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyUser'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function modifyUserAsyncWithHttpInfo(
        string $id_username,
        ?\Aternos\ModrinthApi\Model\EditableUser $editable_user = null,
        string $contentType = self::contentTypes['modifyUser'][0]
    ): PromiseInterface
    {
        $returnType = '';
        $request = $this->modifyUserRequest($id_username, $editable_user, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'modifyUser'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\EditableUser|null $editable_user Modified user fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyUser'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyUserRequest(
        string $id_username,
        ?\Aternos\ModrinthApi\Model\EditableUser $editable_user = null,
        string $contentType = self::contentTypes['modifyUser'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling modifyUser'
            );
        }

        $resourcePath = '/user/{id|username}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($editable_user)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                try {
                    $httpBody = json_encode(ObjectSerializer::sanitizeForSerialization($editable_user), JSON_THROW_ON_ERROR);
                } catch (\JsonException $e) {
                    throw new \InvalidArgumentException('json_encode error: ' . $e->getMessage(), 0, $e);
                }
            } else {
                $httpBody = $editable_user;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new \GuzzleHttp\Psr7\MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                try {
                    $httpBody = json_encode($formParams, JSON_THROW_ON_ERROR);
                } catch (\JsonException $e) {
                    throw new \InvalidArgumentException('json_encode error: ' . $e->getMessage(), 0, $e);
                }
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PATCH',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation withdrawPayout
     *
     * Withdraw payout balance to PayPal or Venmo
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  int $amount Amount to withdraw (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['withdrawPayout'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\AuthError|null
     */
    public function withdrawPayout(
        string $id_username,
        int $amount,
        string $contentType = self::contentTypes['withdrawPayout'][0]
    ): ?\Aternos\ModrinthApi\Model\AuthError
    {
        list($response) = $this->withdrawPayoutWithHttpInfo($id_username, $amount, $contentType);
        return $response;
    }

    /**
     * Operation withdrawPayoutWithHttpInfo
     *
     * Withdraw payout balance to PayPal or Venmo
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  int $amount Amount to withdraw (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['withdrawPayout'] to see the possible values for this operation
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException
     * @return array{0: null, 1: int, 2: array<string, string[]>} [response data, HTTP status code, HTTP response headers]
     */
    public function withdrawPayoutWithHttpInfo(
        string $id_username,
        int $amount,
        string $contentType = self::contentTypes['withdrawPayout'][0]
    ): array
    {
        $request = $this->withdrawPayoutRequest($id_username, $amount, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\AuthError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        
            throw $e;
        }
    }

    /**
     * Operation withdrawPayoutAsync
     *
     * Withdraw payout balance to PayPal or Venmo
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  int $amount Amount to withdraw (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['withdrawPayout'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function withdrawPayoutAsync(
        string $id_username,
        int $amount,
        string $contentType = self::contentTypes['withdrawPayout'][0]
    ): PromiseInterface
    {
        return $this->withdrawPayoutAsyncWithHttpInfo($id_username, $amount, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation withdrawPayoutAsyncWithHttpInfo
     *
     * Withdraw payout balance to PayPal or Venmo
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  int $amount Amount to withdraw (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['withdrawPayout'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return PromiseInterface
     */
    public function withdrawPayoutAsyncWithHttpInfo(
        string $id_username,
        int $amount,
        string $contentType = self::contentTypes['withdrawPayout'][0]
    ): PromiseInterface
    {
        $returnType = '';
        $request = $this->withdrawPayoutRequest($id_username, $amount, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'withdrawPayout'
     *
     * @param  string $id_username The ID or username of the user (required)
     * @param  int $amount Amount to withdraw (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['withdrawPayout'] to see the possible values for this operation
     *
     * @throws InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function withdrawPayoutRequest(
        string $id_username,
        int $amount,
        string $contentType = self::contentTypes['withdrawPayout'][0]
    ): Request
    {
        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $id_username when calling withdrawPayout'
            );
        }
        // verify the required parameter 'amount' is set
        if ($amount === null || (is_array($amount) && count($amount) === 0)) {
            throw new InvalidArgumentException(
                'Missing the required parameter $amount when calling withdrawPayout'
            );
        }

        $resourcePath = '/user/{id|username}/payouts';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $amount,
            'amount', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);


        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{id|username}',
                ObjectSerializer::toPathValue($id_username),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );


        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption(): array
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    private function handleResponseWithDataType(
        string $dataType,
        RequestInterface $request,
        ResponseInterface $response,
    ): array {
        if (in_array($dataType, ['\SplFileObject', '\Psr\Http\Message\StreamInterface'])) {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string) $response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                        $content
                    );
                }
            }
        }

        return [
            ObjectSerializer::deserialize($content, $dataType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    private function responseWithinRangeCode(
        string $rangeCode,
        int $statusCode,
    ): bool {
        $left = (int) ($rangeCode[0].'00');
        $right = (int) ($rangeCode[0].'99');

        return $statusCode >= $left && $statusCode <= $right;
    }
}
