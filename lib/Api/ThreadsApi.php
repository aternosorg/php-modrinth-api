<?php
/**
 * ThreadsApi
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
 * OpenAPI Generator version: 7.0.0
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
 * ThreadsApi Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ThreadsApi
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
        'deleteThreadMessage' => [
            'application/json',
        ],
        'getOpenReports' => [
            'application/json',
        ],
        'getReport' => [
            'application/json',
        ],
        'getReports' => [
            'application/json',
        ],
        'getThread' => [
            'application/json',
        ],
        'getThreads' => [
            'application/json',
        ],
        'modifyReport' => [
            'application/json',
        ],
        'sendThreadMessage' => [
            'application/json',
        ],
        'submitReport' => [
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
     * Operation deleteThreadMessage
     *
     * Delete a thread message
     *
     * @param  string $id The ID of the message (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteThreadMessage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteThreadMessage($id, string $contentType = self::contentTypes['deleteThreadMessage'][0])
    {
        $this->deleteThreadMessageWithHttpInfo($id, $contentType);
    }

    /**
     * Operation deleteThreadMessageWithHttpInfo
     *
     * Delete a thread message
     *
     * @param  string $id The ID of the message (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteThreadMessage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteThreadMessageWithHttpInfo($id, string $contentType = self::contentTypes['deleteThreadMessage'][0])
    {
        $request = $this->deleteThreadMessageRequest($id, $contentType);

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
     * Operation deleteThreadMessageAsync
     *
     * Delete a thread message
     *
     * @param  string $id The ID of the message (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteThreadMessage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteThreadMessageAsync($id, string $contentType = self::contentTypes['deleteThreadMessage'][0])
    {
        return $this->deleteThreadMessageAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteThreadMessageAsyncWithHttpInfo
     *
     * Delete a thread message
     *
     * @param  string $id The ID of the message (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteThreadMessage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteThreadMessageAsyncWithHttpInfo($id, string $contentType = self::contentTypes['deleteThreadMessage'][0])
    {
        $returnType = '';
        $request = $this->deleteThreadMessageRequest($id, $contentType);

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
     * Create request for operation 'deleteThreadMessage'
     *
     * @param  string $id The ID of the message (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteThreadMessage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteThreadMessageRequest($id, string $contentType = self::contentTypes['deleteThreadMessage'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling deleteThreadMessage'
            );
        }


        $resourcePath = '/message/{id}';
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
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getOpenReports
     *
     * Get your open reports
     *
     * @param  int $count count (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOpenReports'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Report[]|\Aternos\ModrinthApi\Model\AuthError
     */
    public function getOpenReports($count = null, string $contentType = self::contentTypes['getOpenReports'][0])
    {
        list($response) = $this->getOpenReportsWithHttpInfo($count, $contentType);
        return $response;
    }

    /**
     * Operation getOpenReportsWithHttpInfo
     *
     * Get your open reports
     *
     * @param  int $count (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOpenReports'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Report[]|\Aternos\ModrinthApi\Model\AuthError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getOpenReportsWithHttpInfo($count = null, string $contentType = self::contentTypes['getOpenReports'][0])
    {
        $request = $this->getOpenReportsRequest($count, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Report[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Report[]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Report[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\Aternos\ModrinthApi\Model\AuthError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\AuthError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\AuthError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Report[]';
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
                        '\Aternos\ModrinthApi\Model\Report[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation getOpenReportsAsync
     *
     * Get your open reports
     *
     * @param  int $count (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOpenReports'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOpenReportsAsync($count = null, string $contentType = self::contentTypes['getOpenReports'][0])
    {
        return $this->getOpenReportsAsyncWithHttpInfo($count, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getOpenReportsAsyncWithHttpInfo
     *
     * Get your open reports
     *
     * @param  int $count (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOpenReports'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getOpenReportsAsyncWithHttpInfo($count = null, string $contentType = self::contentTypes['getOpenReports'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Report[]';
        $request = $this->getOpenReportsRequest($count, $contentType);

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
     * Create request for operation 'getOpenReports'
     *
     * @param  int $count (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getOpenReports'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getOpenReportsRequest($count = null, string $contentType = self::contentTypes['getOpenReports'][0])
    {



        $resourcePath = '/report';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $count,
            'count', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
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
     * Operation getReport
     *
     * Get report from ID
     *
     * @param  string $id The ID of the report (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReport'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Report|\Aternos\ModrinthApi\Model\AuthError
     */
    public function getReport($id, string $contentType = self::contentTypes['getReport'][0])
    {
        list($response) = $this->getReportWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation getReportWithHttpInfo
     *
     * Get report from ID
     *
     * @param  string $id The ID of the report (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReport'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Report|\Aternos\ModrinthApi\Model\AuthError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getReportWithHttpInfo($id, string $contentType = self::contentTypes['getReport'][0])
    {
        $request = $this->getReportRequest($id, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Report' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Report' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Report', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\Aternos\ModrinthApi\Model\AuthError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\AuthError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\AuthError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Report';
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
                        '\Aternos\ModrinthApi\Model\Report',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation getReportAsync
     *
     * Get report from ID
     *
     * @param  string $id The ID of the report (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getReportAsync($id, string $contentType = self::contentTypes['getReport'][0])
    {
        return $this->getReportAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getReportAsyncWithHttpInfo
     *
     * Get report from ID
     *
     * @param  string $id The ID of the report (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getReportAsyncWithHttpInfo($id, string $contentType = self::contentTypes['getReport'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Report';
        $request = $this->getReportRequest($id, $contentType);

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
     * Create request for operation 'getReport'
     *
     * @param  string $id The ID of the report (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getReportRequest($id, string $contentType = self::contentTypes['getReport'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getReport'
            );
        }


        $resourcePath = '/report/{id}';
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
     * Operation getReports
     *
     * Get multiple reports
     *
     * @param  string $ids The IDs of the reports (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReports'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Report[]|\Aternos\ModrinthApi\Model\AuthError
     */
    public function getReports($ids, string $contentType = self::contentTypes['getReports'][0])
    {
        list($response) = $this->getReportsWithHttpInfo($ids, $contentType);
        return $response;
    }

    /**
     * Operation getReportsWithHttpInfo
     *
     * Get multiple reports
     *
     * @param  string $ids The IDs of the reports (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReports'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Report[]|\Aternos\ModrinthApi\Model\AuthError, HTTP status code, HTTP response headers (array of strings)
     */
    public function getReportsWithHttpInfo($ids, string $contentType = self::contentTypes['getReports'][0])
    {
        $request = $this->getReportsRequest($ids, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Report[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Report[]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Report[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\Aternos\ModrinthApi\Model\AuthError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\AuthError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\AuthError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Report[]';
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
                        '\Aternos\ModrinthApi\Model\Report[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation getReportsAsync
     *
     * Get multiple reports
     *
     * @param  string $ids The IDs of the reports (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReports'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getReportsAsync($ids, string $contentType = self::contentTypes['getReports'][0])
    {
        return $this->getReportsAsyncWithHttpInfo($ids, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getReportsAsyncWithHttpInfo
     *
     * Get multiple reports
     *
     * @param  string $ids The IDs of the reports (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReports'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getReportsAsyncWithHttpInfo($ids, string $contentType = self::contentTypes['getReports'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Report[]';
        $request = $this->getReportsRequest($ids, $contentType);

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
     * Create request for operation 'getReports'
     *
     * @param  string $ids The IDs of the reports (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getReports'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getReportsRequest($ids, string $contentType = self::contentTypes['getReports'][0])
    {

        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ids when calling getReports'
            );
        }


        $resourcePath = '/reports';
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
     * Operation getThread
     *
     * Get a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThread'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Thread
     */
    public function getThread($id, string $contentType = self::contentTypes['getThread'][0])
    {
        list($response) = $this->getThreadWithHttpInfo($id, $contentType);
        return $response;
    }

    /**
     * Operation getThreadWithHttpInfo
     *
     * Get a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThread'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Thread, HTTP status code, HTTP response headers (array of strings)
     */
    public function getThreadWithHttpInfo($id, string $contentType = self::contentTypes['getThread'][0])
    {
        $request = $this->getThreadRequest($id, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Thread' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Thread' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Thread', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Thread';
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
                        '\Aternos\ModrinthApi\Model\Thread',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getThreadAsync
     *
     * Get a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThread'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getThreadAsync($id, string $contentType = self::contentTypes['getThread'][0])
    {
        return $this->getThreadAsyncWithHttpInfo($id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getThreadAsyncWithHttpInfo
     *
     * Get a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThread'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getThreadAsyncWithHttpInfo($id, string $contentType = self::contentTypes['getThread'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Thread';
        $request = $this->getThreadRequest($id, $contentType);

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
     * Create request for operation 'getThread'
     *
     * @param  string $id The ID of the thread (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThread'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getThreadRequest($id, string $contentType = self::contentTypes['getThread'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getThread'
            );
        }


        $resourcePath = '/thread/{id}';
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
     * Operation getThreads
     *
     * Get multiple threads
     *
     * @param  string $ids The IDs of the threads (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThreads'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Thread[]
     */
    public function getThreads($ids, string $contentType = self::contentTypes['getThreads'][0])
    {
        list($response) = $this->getThreadsWithHttpInfo($ids, $contentType);
        return $response;
    }

    /**
     * Operation getThreadsWithHttpInfo
     *
     * Get multiple threads
     *
     * @param  string $ids The IDs of the threads (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThreads'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Thread[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getThreadsWithHttpInfo($ids, string $contentType = self::contentTypes['getThreads'][0])
    {
        $request = $this->getThreadsRequest($ids, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Thread[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Thread[]' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Thread[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Thread[]';
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
                        '\Aternos\ModrinthApi\Model\Thread[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getThreadsAsync
     *
     * Get multiple threads
     *
     * @param  string $ids The IDs of the threads (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThreads'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getThreadsAsync($ids, string $contentType = self::contentTypes['getThreads'][0])
    {
        return $this->getThreadsAsyncWithHttpInfo($ids, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getThreadsAsyncWithHttpInfo
     *
     * Get multiple threads
     *
     * @param  string $ids The IDs of the threads (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThreads'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getThreadsAsyncWithHttpInfo($ids, string $contentType = self::contentTypes['getThreads'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Thread[]';
        $request = $this->getThreadsRequest($ids, $contentType);

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
     * Create request for operation 'getThreads'
     *
     * @param  string $ids The IDs of the threads (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getThreads'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getThreadsRequest($ids, string $contentType = self::contentTypes['getThreads'][0])
    {

        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ids when calling getThreads'
            );
        }


        $resourcePath = '/threads';
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
     * Operation modifyReport
     *
     * Modify a report
     *
     * @param  string $id The ID of the report (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyReportRequest $modify_report_request What to modify about the report (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyReport'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function modifyReport($id, $modify_report_request = null, string $contentType = self::contentTypes['modifyReport'][0])
    {
        $this->modifyReportWithHttpInfo($id, $modify_report_request, $contentType);
    }

    /**
     * Operation modifyReportWithHttpInfo
     *
     * Modify a report
     *
     * @param  string $id The ID of the report (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyReportRequest $modify_report_request What to modify about the report (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyReport'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyReportWithHttpInfo($id, $modify_report_request = null, string $contentType = self::contentTypes['modifyReport'][0])
    {
        $request = $this->modifyReportRequest($id, $modify_report_request, $contentType);

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
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\InvalidInputError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation modifyReportAsync
     *
     * Modify a report
     *
     * @param  string $id The ID of the report (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyReportRequest $modify_report_request What to modify about the report (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyReportAsync($id, $modify_report_request = null, string $contentType = self::contentTypes['modifyReport'][0])
    {
        return $this->modifyReportAsyncWithHttpInfo($id, $modify_report_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyReportAsyncWithHttpInfo
     *
     * Modify a report
     *
     * @param  string $id The ID of the report (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyReportRequest $modify_report_request What to modify about the report (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyReportAsyncWithHttpInfo($id, $modify_report_request = null, string $contentType = self::contentTypes['modifyReport'][0])
    {
        $returnType = '';
        $request = $this->modifyReportRequest($id, $modify_report_request, $contentType);

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
     * Create request for operation 'modifyReport'
     *
     * @param  string $id The ID of the report (required)
     * @param  \Aternos\ModrinthApi\Model\ModifyReportRequest $modify_report_request What to modify about the report (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyReportRequest($id, $modify_report_request = null, string $contentType = self::contentTypes['modifyReport'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling modifyReport'
            );
        }



        $resourcePath = '/report/{id}';
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
        if (isset($modify_report_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($modify_report_request));
            } else {
                $httpBody = $modify_report_request;
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
     * Operation sendThreadMessage
     *
     * Send a text message to a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  \Aternos\ModrinthApi\Model\ThreadMessageBody $thread_message_body The message to be sent. Note that you only need the fields applicable for the &#x60;text&#x60; type. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendThreadMessage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Thread|\Aternos\ModrinthApi\Model\InvalidInputError
     */
    public function sendThreadMessage($id, $thread_message_body = null, string $contentType = self::contentTypes['sendThreadMessage'][0])
    {
        list($response) = $this->sendThreadMessageWithHttpInfo($id, $thread_message_body, $contentType);
        return $response;
    }

    /**
     * Operation sendThreadMessageWithHttpInfo
     *
     * Send a text message to a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  \Aternos\ModrinthApi\Model\ThreadMessageBody $thread_message_body The message to be sent. Note that you only need the fields applicable for the &#x60;text&#x60; type. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendThreadMessage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Thread|\Aternos\ModrinthApi\Model\InvalidInputError, HTTP status code, HTTP response headers (array of strings)
     */
    public function sendThreadMessageWithHttpInfo($id, $thread_message_body = null, string $contentType = self::contentTypes['sendThreadMessage'][0])
    {
        $request = $this->sendThreadMessageRequest($id, $thread_message_body, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Thread' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Thread' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Thread', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Aternos\ModrinthApi\Model\InvalidInputError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\InvalidInputError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\InvalidInputError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Thread';
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
                        '\Aternos\ModrinthApi\Model\Thread',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\InvalidInputError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation sendThreadMessageAsync
     *
     * Send a text message to a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  \Aternos\ModrinthApi\Model\ThreadMessageBody $thread_message_body The message to be sent. Note that you only need the fields applicable for the &#x60;text&#x60; type. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendThreadMessage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendThreadMessageAsync($id, $thread_message_body = null, string $contentType = self::contentTypes['sendThreadMessage'][0])
    {
        return $this->sendThreadMessageAsyncWithHttpInfo($id, $thread_message_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation sendThreadMessageAsyncWithHttpInfo
     *
     * Send a text message to a thread
     *
     * @param  string $id The ID of the thread (required)
     * @param  \Aternos\ModrinthApi\Model\ThreadMessageBody $thread_message_body The message to be sent. Note that you only need the fields applicable for the &#x60;text&#x60; type. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendThreadMessage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendThreadMessageAsyncWithHttpInfo($id, $thread_message_body = null, string $contentType = self::contentTypes['sendThreadMessage'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Thread';
        $request = $this->sendThreadMessageRequest($id, $thread_message_body, $contentType);

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
     * Create request for operation 'sendThreadMessage'
     *
     * @param  string $id The ID of the thread (required)
     * @param  \Aternos\ModrinthApi\Model\ThreadMessageBody $thread_message_body The message to be sent. Note that you only need the fields applicable for the &#x60;text&#x60; type. (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['sendThreadMessage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function sendThreadMessageRequest($id, $thread_message_body = null, string $contentType = self::contentTypes['sendThreadMessage'][0])
    {

        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling sendThreadMessage'
            );
        }



        $resourcePath = '/thread/{id}';
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
        if (isset($thread_message_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($thread_message_body));
            } else {
                $httpBody = $thread_message_body;
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
     * Operation submitReport
     *
     * Report a project, user, or version
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableReport $creatable_report The report to be sent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['submitReport'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Report|\Aternos\ModrinthApi\Model\InvalidInputError|\Aternos\ModrinthApi\Model\AuthError
     */
    public function submitReport($creatable_report = null, string $contentType = self::contentTypes['submitReport'][0])
    {
        list($response) = $this->submitReportWithHttpInfo($creatable_report, $contentType);
        return $response;
    }

    /**
     * Operation submitReportWithHttpInfo
     *
     * Report a project, user, or version
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableReport $creatable_report The report to be sent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['submitReport'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Report|\Aternos\ModrinthApi\Model\InvalidInputError|\Aternos\ModrinthApi\Model\AuthError, HTTP status code, HTTP response headers (array of strings)
     */
    public function submitReportWithHttpInfo($creatable_report = null, string $contentType = self::contentTypes['submitReport'][0])
    {
        $request = $this->submitReportRequest($creatable_report, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Report' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Report' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Report', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Aternos\ModrinthApi\Model\InvalidInputError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\InvalidInputError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\InvalidInputError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 401:
                    if ('\Aternos\ModrinthApi\Model\AuthError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\AuthError' !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\AuthError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Report';
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
                        '\Aternos\ModrinthApi\Model\Report',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Aternos\ModrinthApi\Model\InvalidInputError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
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
     * Operation submitReportAsync
     *
     * Report a project, user, or version
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableReport $creatable_report The report to be sent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['submitReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function submitReportAsync($creatable_report = null, string $contentType = self::contentTypes['submitReport'][0])
    {
        return $this->submitReportAsyncWithHttpInfo($creatable_report, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation submitReportAsyncWithHttpInfo
     *
     * Report a project, user, or version
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableReport $creatable_report The report to be sent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['submitReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function submitReportAsyncWithHttpInfo($creatable_report = null, string $contentType = self::contentTypes['submitReport'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Report';
        $request = $this->submitReportRequest($creatable_report, $contentType);

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
     * Create request for operation 'submitReport'
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableReport $creatable_report The report to be sent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['submitReport'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function submitReportRequest($creatable_report = null, string $contentType = self::contentTypes['submitReport'][0])
    {



        $resourcePath = '/report';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($creatable_report)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($creatable_report));
            } else {
                $httpBody = $creatable_report;
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
