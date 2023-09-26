<?php
/**
 * TeamsApi
 * PHP version 7.4
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Labrinth
 *
 * ## Authentication This API uses personal access tokens tied to a user account for authentication. The token is in the `Authorization` header of the request.  Example: ``` Authorization: mrp_RNtLRSPmGj2pd1v1ubi52nX7TJJM9sznrmwhAuj511oe4t1jAqAQ3D6Wc8Ic ```  You do not need a token for most requests. Generally speaking, only the following types of requests require a token: - those which create data (such as version creation) - those which modify data (such as editing a project) - those which access private data (such as draft projects, notifications, emails, and payout data)  Applications interacting with the authenticated API should have the user generate a personal access token from [their user settings](https://modrinth.com/settings/account). Each request requiring authentication has a certain scope. For example, to view the email of the user being requested, the token must have the `USER_READ_EMAIL` scope. You can find the list of available scopes [on GitHub](https://github.com/modrinth/labrinth/blob/master/src/models/pats.rs#L15). Making a request with an invalid scope will return a 401 error.  Please note that certain scopes and requests cannot be completed with a personal access token. For example, deleting a user account can only be done through Modrinth's frontend.  For backwards compatibility purposes, some types of GitHub tokens also work for authenticating a user with Modrinth's API, granting all scopes. **We urge any application still using GitHub tokens to start using personal access tokens for security and reliability purposes.** GitHub tokens will cease to function to authenticate with Modrinth's API as soon as version 3 of the API is made generally available.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/). This allows for cross-domain communication from the browser. All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.  ## Identifiers The majority of items you can interact with in the API have a unique eight-digit base62 ID. Projects, versions, users, threads, teams, and reports all use this same way of identifying themselves. Version files use the sha1 or sha512 file hashes as identifiers.  Each project and user has a friendlier way of identifying them; slugs and usernames, respectively. While unique IDs are constant, slugs and usernames can change at any moment. If you want to store something in the long term, it is recommended to use the unique ID.  ## Ratelimits The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers. - `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute - `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window - `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets  Ratelimits are the same no matter whether you use a token or not. The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:admin@modrinth.com).  ## User Agents To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header. Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic. It is recommended, but not required, to include contact information in your user agent. This allows us to contact you if we would like a change in your application's behavior without having to block your traffic. - Bad: `User-Agent: okhttp/4.9.3` - Good: `User-Agent: project_name` - Better: `User-Agent: github_username/project_name/1.56.0` - Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`  ## Versioning Modrinth follows a simple pattern for its API versioning. In the event of a breaking API change, the API version in the URL path is bumped, and migration steps will be published [on the migrations page](/docs/migrations/information).  When an API is no longer the current one, it will immediately be considered deprecated. No more support will be provided for API versions older than the current one. It will be kept for some time, but this amount of time is not certain.  We will exercise various tactics to get people to update their implementation of our API. One example is by adding something like `STOP USING THIS API` to various data returned by the API.  Once an API version is completely deprecated, it will permanently return a 410 error. Please ensure your application handles these 410 errors.
 *
 * The version of the OpenAPI document: v2.7.0/ec80c2b
 * Contact: support@modrinth.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.0.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\ModrinthApi\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Aternos\ModrinthApi\ApiException;
use Aternos\ModrinthApi\Configuration;
use Aternos\ModrinthApi\HeaderSelector;
use Aternos\ModrinthApi\ObjectSerializer;

/**
 * TeamsApi Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class TeamsApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'addTeamMember' => [
            'application/json',
        ],
        'deleteTeamMember' => [
            'application/json',
        ],
        'getProjectTeamMembers' => [
            'application/json',
        ],
        'getTeamMembers' => [
            'application/json',
        ],
        'getTeams' => [
            'application/json',
        ],
        'joinTeam' => [
            'application/json',
        ],
        'modifyTeamMember' => [
            'application/json',
        ],
        'transferTeamOwnership' => [
            'application/json',
        ],
    ];

/**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation addTeamMember
     *
     * Add a user to a team
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier User to be added (must be the ID, usernames cannot be used here) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addTeamMember'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function addTeamMember($id, $user_identifier = null, string $contentType = self::contentTypes['addTeamMember'][0])
    {
        $this->addTeamMemberWithHttpInfo($id, $user_identifier, $contentType);
    }

    /**
     * Operation addTeamMemberWithHttpInfo
     *
     * Add a user to a team
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier User to be added (must be the ID, usernames cannot be used here) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addTeamMember'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function addTeamMemberWithHttpInfo($id, $user_identifier = null, string $contentType = self::contentTypes['addTeamMember'][0])
    {
        $request = $this->addTeamMemberRequest($id, $user_identifier, $contentType);

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
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation addTeamMemberAsync
     *
     * Add a user to a team
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier User to be added (must be the ID, usernames cannot be used here) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addTeamMemberAsync($id, $user_identifier = null, string $contentType = self::contentTypes['addTeamMember'][0])
    {
        return $this->addTeamMemberAsyncWithHttpInfo($id, $user_identifier, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addTeamMemberAsyncWithHttpInfo
     *
     * Add a user to a team
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier User to be added (must be the ID, usernames cannot be used here) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addTeamMemberAsyncWithHttpInfo($id, $user_identifier = null, string $contentType = self::contentTypes['addTeamMember'][0])
    {
        $returnType = '';
        $request = $this->addTeamMemberRequest($id, $user_identifier, $contentType);

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
     * Create request for operation 'addTeamMember'
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier User to be added (must be the ID, usernames cannot be used here) (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function addTeamMemberRequest($id, $user_identifier = null, string $contentType = self::contentTypes['addTeamMember'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling addTeamMember'
            );
        }



        $resourcePath = '/team/{id}/members';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_identifier)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_identifier));
            } else {
                $httpBody = $user_identifier;
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation deleteTeamMember
     *
     * Remove a member from a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteTeamMember'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteTeamMember($id, $id_username, string $contentType = self::contentTypes['deleteTeamMember'][0])
    {
        $this->deleteTeamMemberWithHttpInfo($id, $id_username, $contentType);
    }

    /**
     * Operation deleteTeamMemberWithHttpInfo
     *
     * Remove a member from a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteTeamMember'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteTeamMemberWithHttpInfo($id, $id_username, string $contentType = self::contentTypes['deleteTeamMember'][0])
    {
        $request = $this->deleteTeamMemberRequest($id, $id_username, $contentType);

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
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation deleteTeamMemberAsync
     *
     * Remove a member from a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteTeamMemberAsync($id, $id_username, string $contentType = self::contentTypes['deleteTeamMember'][0])
    {
        return $this->deleteTeamMemberAsyncWithHttpInfo($id, $id_username, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteTeamMemberAsyncWithHttpInfo
     *
     * Remove a member from a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteTeamMemberAsyncWithHttpInfo($id, $id_username, string $contentType = self::contentTypes['deleteTeamMember'][0])
    {
        $returnType = '';
        $request = $this->deleteTeamMemberRequest($id, $id_username, $contentType);

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
     * Create request for operation 'deleteTeamMember'
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteTeamMemberRequest($id, $id_username, string $contentType = self::contentTypes['deleteTeamMember'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling deleteTeamMember'
            );
        }

        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_username when calling deleteTeamMember'
            );
        }


        $resourcePath = '/team/{id}/members/{id|username}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{' . 'id|username' . '}',
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
        if (count($formParams) > 0) {
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getProjectTeamMembers
     *
     * Get a project&#39;s team members
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectTeamMembers'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\TeamMember[]
     */
    public function getProjectTeamMembers($id_slug, string $contentType = self::contentTypes['getProjectTeamMembers'][0])
    {
        list($response) = $this->getProjectTeamMembersWithHttpInfo($id_slug, $contentType);
        return $response;
    }

    /**
     * Operation getProjectTeamMembersWithHttpInfo
     *
     * Get a project&#39;s team members
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectTeamMembers'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\TeamMember[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectTeamMembersWithHttpInfo($id_slug, string $contentType = self::contentTypes['getProjectTeamMembers'][0])
    {
        $request = $this->getProjectTeamMembersRequest($id_slug, $contentType);

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

            switch($statusCode) {
                case 200:
                    if ('\Aternos\ModrinthApi\Model\TeamMember[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\TeamMember[]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\TeamMember[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\TeamMember[]';
            if ($returnType === '\SplFileObject') {
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

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\TeamMember[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getProjectTeamMembersAsync
     *
     * Get a project&#39;s team members
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectTeamMembers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectTeamMembersAsync($id_slug, string $contentType = self::contentTypes['getProjectTeamMembers'][0])
    {
        return $this->getProjectTeamMembersAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectTeamMembersAsyncWithHttpInfo
     *
     * Get a project&#39;s team members
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectTeamMembers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectTeamMembersAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['getProjectTeamMembers'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\TeamMember[]';
        $request = $this->getProjectTeamMembersRequest($id_slug, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
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
     * Create request for operation 'getProjectTeamMembers'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjectTeamMembers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getProjectTeamMembersRequest($id_slug, string $contentType = self::contentTypes['getProjectTeamMembers'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling getProjectTeamMembers'
            );
        }


        $resourcePath = '/project/{id|slug}/members';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_slug !== null) {
            $resourcePath = str_replace(
                '{' . 'id|slug' . '}',
                ObjectSerializer::toPathValue($id_slug),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
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
     * Operation getTeamMembers
     *
     * Get a team&#39;s members
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeamMembers'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\TeamMember[]
     */
    public function getTeamMembers($id, string $contentType = self::contentTypes['getTeamMembers'][0])
    {
        list($response) = $this->getTeamMembersWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation getTeamMembersWithHttpInfo
     *
     * Get a team&#39;s members
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeamMembers'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\TeamMember[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getTeamMembersWithHttpInfo($id, string $contentType = self::contentTypes['getTeamMembers'][0])
    {
        $request = $this->getTeamMembersRequest($id, $contentType);

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

            switch($statusCode) {
                case 200:
                    if ('\Aternos\ModrinthApi\Model\TeamMember[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\TeamMember[]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\TeamMember[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\TeamMember[]';
            if ($returnType === '\SplFileObject') {
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

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\TeamMember[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTeamMembersAsync
     *
     * Get a team&#39;s members
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeamMembers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTeamMembersAsync($id, string $contentType = self::contentTypes['getTeamMembers'][0])
    {
        return $this->getTeamMembersAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTeamMembersAsyncWithHttpInfo
     *
     * Get a team&#39;s members
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeamMembers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTeamMembersAsyncWithHttpInfo($id, string $contentType = self::contentTypes['getTeamMembers'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\TeamMember[]';
        $request = $this->getTeamMembersRequest($id, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
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
     * Create request for operation 'getTeamMembers'
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeamMembers'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getTeamMembersRequest($id, string $contentType = self::contentTypes['getTeamMembers'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getTeamMembers'
            );
        }


        $resourcePath = '/team/{id}/members';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTeams
     *
     * Get the members of multiple teams
     *
     * @param  string $ids The IDs of the teams (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeams'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\TeamMember[][]
     */
    public function getTeams($ids, string $contentType = self::contentTypes['getTeams'][0])
    {
        list($response) = $this->getTeamsWithHttpInfo($ids, $contentType);
        return $response;
    }

    /**
     * Operation getTeamsWithHttpInfo
     *
     * Get the members of multiple teams
     *
     * @param  string $ids The IDs of the teams (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeams'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\TeamMember[][], HTTP status code, HTTP response headers (array of strings)
     */
    public function getTeamsWithHttpInfo($ids, string $contentType = self::contentTypes['getTeams'][0])
    {
        $request = $this->getTeamsRequest($ids, $contentType);

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

            switch($statusCode) {
                case 200:
                    if ('\Aternos\ModrinthApi\Model\TeamMember[][]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\TeamMember[][]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\TeamMember[][]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\TeamMember[][]';
            if ($returnType === '\SplFileObject') {
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

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\TeamMember[][]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTeamsAsync
     *
     * Get the members of multiple teams
     *
     * @param  string $ids The IDs of the teams (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeams'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTeamsAsync($ids, string $contentType = self::contentTypes['getTeams'][0])
    {
        return $this->getTeamsAsyncWithHttpInfo($ids, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTeamsAsyncWithHttpInfo
     *
     * Get the members of multiple teams
     *
     * @param  string $ids The IDs of the teams (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeams'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getTeamsAsyncWithHttpInfo($ids, string $contentType = self::contentTypes['getTeams'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\TeamMember[][]';
        $request = $this->getTeamsRequest($ids, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
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
     * Create request for operation 'getTeams'
     *
     * @param  string $ids The IDs of the teams (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getTeams'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getTeamsRequest($ids, string $contentType = self::contentTypes['getTeams'][0])
    {

        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ids when calling getTeams'
            );
        }


        $resourcePath = '/teams';
        $formParams = [];
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

        // for model (json/xml)
        if (count($formParams) > 0) {
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
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
     * Operation joinTeam
     *
     * Join a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['joinTeam'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function joinTeam($id, string $contentType = self::contentTypes['joinTeam'][0])
    {
        $this->joinTeamWithHttpInfo($id, $contentType);
    }

    /**
     * Operation joinTeamWithHttpInfo
     *
     * Join a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['joinTeam'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function joinTeamWithHttpInfo($id, string $contentType = self::contentTypes['joinTeam'][0])
    {
        $request = $this->joinTeamRequest($id, $contentType);

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
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation joinTeamAsync
     *
     * Join a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['joinTeam'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function joinTeamAsync($id, string $contentType = self::contentTypes['joinTeam'][0])
    {
        return $this->joinTeamAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation joinTeamAsyncWithHttpInfo
     *
     * Join a team
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['joinTeam'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function joinTeamAsyncWithHttpInfo($id, string $contentType = self::contentTypes['joinTeam'][0])
    {
        $returnType = '';
        $request = $this->joinTeamRequest($id, $contentType);

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
     * Create request for operation 'joinTeam'
     *
     * @param  string $id The ID of the team (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['joinTeam'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function joinTeamRequest($id, string $contentType = self::contentTypes['joinTeam'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling joinTeam'
            );
        }


        $resourcePath = '/team/{id}/join';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation modifyTeamMember
     *
     * Modify a team member&#39;s information
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyTeamMemberBody $modify_team_member_body Contents to be modified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyTeamMember'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function modifyTeamMember($id, $id_username, $modify_team_member_body = null, string $contentType = self::contentTypes['modifyTeamMember'][0])
    {
        $this->modifyTeamMemberWithHttpInfo($id, $id_username, $modify_team_member_body, $contentType);
    }

    /**
     * Operation modifyTeamMemberWithHttpInfo
     *
     * Modify a team member&#39;s information
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyTeamMemberBody $modify_team_member_body Contents to be modified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyTeamMember'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyTeamMemberWithHttpInfo($id, $id_username, $modify_team_member_body = null, string $contentType = self::contentTypes['modifyTeamMember'][0])
    {
        $request = $this->modifyTeamMemberRequest($id, $id_username, $modify_team_member_body, $contentType);

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
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation modifyTeamMemberAsync
     *
     * Modify a team member&#39;s information
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyTeamMemberBody $modify_team_member_body Contents to be modified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyTeamMemberAsync($id, $id_username, $modify_team_member_body = null, string $contentType = self::contentTypes['modifyTeamMember'][0])
    {
        return $this->modifyTeamMemberAsyncWithHttpInfo($id, $id_username, $modify_team_member_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyTeamMemberAsyncWithHttpInfo
     *
     * Modify a team member&#39;s information
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyTeamMemberBody $modify_team_member_body Contents to be modified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyTeamMemberAsyncWithHttpInfo($id, $id_username, $modify_team_member_body = null, string $contentType = self::contentTypes['modifyTeamMember'][0])
    {
        $returnType = '';
        $request = $this->modifyTeamMemberRequest($id, $id_username, $modify_team_member_body, $contentType);

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
     * Create request for operation 'modifyTeamMember'
     *
     * @param  string $id The ID of the team (required)
     * @param  string $id_username The ID or username of the user (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyTeamMemberBody $modify_team_member_body Contents to be modified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyTeamMember'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyTeamMemberRequest($id, $id_username, $modify_team_member_body = null, string $contentType = self::contentTypes['modifyTeamMember'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling modifyTeamMember'
            );
        }

        // verify the required parameter 'id_username' is set
        if ($id_username === null || (is_array($id_username) && count($id_username) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_username when calling modifyTeamMember'
            );
        }



        $resourcePath = '/team/{id}/members/{id|username}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }
        // path params
        if ($id_username !== null) {
            $resourcePath = str_replace(
                '{' . 'id|username' . '}',
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
        if (isset($modify_team_member_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($modify_team_member_body));
            } else {
                $httpBody = $modify_team_member_body;
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Operation transferTeamOwnership
     *
     * Transfer team&#39;s ownership to another user
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier New owner&#39;s ID (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['transferTeamOwnership'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function transferTeamOwnership($id, $user_identifier = null, string $contentType = self::contentTypes['transferTeamOwnership'][0])
    {
        $this->transferTeamOwnershipWithHttpInfo($id, $user_identifier, $contentType);
    }

    /**
     * Operation transferTeamOwnershipWithHttpInfo
     *
     * Transfer team&#39;s ownership to another user
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier New owner&#39;s ID (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['transferTeamOwnership'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function transferTeamOwnershipWithHttpInfo($id, $user_identifier = null, string $contentType = self::contentTypes['transferTeamOwnership'][0])
    {
        $request = $this->transferTeamOwnershipRequest($id, $user_identifier, $contentType);

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
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation transferTeamOwnershipAsync
     *
     * Transfer team&#39;s ownership to another user
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier New owner&#39;s ID (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['transferTeamOwnership'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function transferTeamOwnershipAsync($id, $user_identifier = null, string $contentType = self::contentTypes['transferTeamOwnership'][0])
    {
        return $this->transferTeamOwnershipAsyncWithHttpInfo($id, $user_identifier, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation transferTeamOwnershipAsyncWithHttpInfo
     *
     * Transfer team&#39;s ownership to another user
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier New owner&#39;s ID (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['transferTeamOwnership'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function transferTeamOwnershipAsyncWithHttpInfo($id, $user_identifier = null, string $contentType = self::contentTypes['transferTeamOwnership'][0])
    {
        $returnType = '';
        $request = $this->transferTeamOwnershipRequest($id, $user_identifier, $contentType);

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
     * Create request for operation 'transferTeamOwnership'
     *
     * @param  string $id The ID of the team (required)
     * @param  \Aternos\ModrinthApi\Model\UserIdentifier $user_identifier New owner&#39;s ID (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['transferTeamOwnership'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function transferTeamOwnershipRequest($id, $user_identifier = null, string $contentType = self::contentTypes['transferTeamOwnership'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling transferTeamOwnership'
            );
        }



        $resourcePath = '/team/{id}/owner';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_identifier)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_identifier));
            } else {
                $httpBody = $user_identifier;
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
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
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
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
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
}
