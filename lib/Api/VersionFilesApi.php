<?php
/**
 * VersionFilesApi
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
 * The version of the OpenAPI document: v2.7.0/15cf3fc
 * Contact: support@modrinth.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.2.0
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
 * VersionFilesApi Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class VersionFilesApi
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
        'deleteFileFromHash' => [
            'application/json',
        ],
        'getLatestVersionFromHash' => [
            'application/json',
        ],
        'getLatestVersionsFromHashes' => [
            'application/json',
        ],
        'versionFromHash' => [
            'application/json',
        ],
        'versionsFromHashes' => [
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
     * Operation deleteFileFromHash
     *
     * Delete a file from its hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  string $version_id Version ID to delete the version from, if multiple files of the same hash exist (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFileFromHash'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteFileFromHash($hash, $algorithm, $version_id = null, string $contentType = self::contentTypes['deleteFileFromHash'][0])
    {
        $this->deleteFileFromHashWithHttpInfo($hash, $algorithm, $version_id, $contentType);
    }

    /**
     * Operation deleteFileFromHashWithHttpInfo
     *
     * Delete a file from its hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  string $version_id Version ID to delete the version from, if multiple files of the same hash exist (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFileFromHash'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteFileFromHashWithHttpInfo($hash, $algorithm, $version_id = null, string $contentType = self::contentTypes['deleteFileFromHash'][0])
    {
        $request = $this->deleteFileFromHashRequest($hash, $algorithm, $version_id, $contentType);

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
     * Operation deleteFileFromHashAsync
     *
     * Delete a file from its hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  string $version_id Version ID to delete the version from, if multiple files of the same hash exist (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFileFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFileFromHashAsync($hash, $algorithm, $version_id = null, string $contentType = self::contentTypes['deleteFileFromHash'][0])
    {
        return $this->deleteFileFromHashAsyncWithHttpInfo($hash, $algorithm, $version_id, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteFileFromHashAsyncWithHttpInfo
     *
     * Delete a file from its hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  string $version_id Version ID to delete the version from, if multiple files of the same hash exist (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFileFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteFileFromHashAsyncWithHttpInfo($hash, $algorithm, $version_id = null, string $contentType = self::contentTypes['deleteFileFromHash'][0])
    {
        $returnType = '';
        $request = $this->deleteFileFromHashRequest($hash, $algorithm, $version_id, $contentType);

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
     * Create request for operation 'deleteFileFromHash'
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  string $version_id Version ID to delete the version from, if multiple files of the same hash exist (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteFileFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteFileFromHashRequest($hash, $algorithm, $version_id = null, string $contentType = self::contentTypes['deleteFileFromHash'][0])
    {

        // verify the required parameter 'hash' is set
        if ($hash === null || (is_array($hash) && count($hash) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $hash when calling deleteFileFromHash'
            );
        }

        // verify the required parameter 'algorithm' is set
        if ($algorithm === null || (is_array($algorithm) && count($algorithm) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $algorithm when calling deleteFileFromHash'
            );
        }



        $resourcePath = '/version_file/{hash}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $algorithm,
            'algorithm', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $version_id,
            'version_id', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($hash !== null) {
            $resourcePath = str_replace(
                '{' . 'hash' . '}',
                ObjectSerializer::toPathValue($hash),
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
     * Operation getLatestVersionFromHash
     *
     * Latest version of a project from a hash, loader(s), and game version(s)
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody $get_latest_version_from_hash_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionFromHash'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Version
     */
    public function getLatestVersionFromHash($hash, $algorithm, $get_latest_version_from_hash_body = null, string $contentType = self::contentTypes['getLatestVersionFromHash'][0])
    {
        list($response) = $this->getLatestVersionFromHashWithHttpInfo($hash, $algorithm, $get_latest_version_from_hash_body, $contentType);
        return $response;
    }

    /**
     * Operation getLatestVersionFromHashWithHttpInfo
     *
     * Latest version of a project from a hash, loader(s), and game version(s)
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody $get_latest_version_from_hash_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionFromHash'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Version, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLatestVersionFromHashWithHttpInfo($hash, $algorithm, $get_latest_version_from_hash_body = null, string $contentType = self::contentTypes['getLatestVersionFromHash'][0])
    {
        $request = $this->getLatestVersionFromHashRequest($hash, $algorithm, $get_latest_version_from_hash_body, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Version' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Version' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Version', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Version';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
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
                        '\Aternos\ModrinthApi\Model\Version',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLatestVersionFromHashAsync
     *
     * Latest version of a project from a hash, loader(s), and game version(s)
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody $get_latest_version_from_hash_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLatestVersionFromHashAsync($hash, $algorithm, $get_latest_version_from_hash_body = null, string $contentType = self::contentTypes['getLatestVersionFromHash'][0])
    {
        return $this->getLatestVersionFromHashAsyncWithHttpInfo($hash, $algorithm, $get_latest_version_from_hash_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLatestVersionFromHashAsyncWithHttpInfo
     *
     * Latest version of a project from a hash, loader(s), and game version(s)
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody $get_latest_version_from_hash_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLatestVersionFromHashAsyncWithHttpInfo($hash, $algorithm, $get_latest_version_from_hash_body = null, string $contentType = self::contentTypes['getLatestVersionFromHash'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Version';
        $request = $this->getLatestVersionFromHashRequest($hash, $algorithm, $get_latest_version_from_hash_body, $contentType);

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
     * Create request for operation 'getLatestVersionFromHash'
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody $get_latest_version_from_hash_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLatestVersionFromHashRequest($hash, $algorithm, $get_latest_version_from_hash_body = null, string $contentType = self::contentTypes['getLatestVersionFromHash'][0])
    {

        // verify the required parameter 'hash' is set
        if ($hash === null || (is_array($hash) && count($hash) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $hash when calling getLatestVersionFromHash'
            );
        }

        // verify the required parameter 'algorithm' is set
        if ($algorithm === null || (is_array($algorithm) && count($algorithm) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $algorithm when calling getLatestVersionFromHash'
            );
        }



        $resourcePath = '/version_file/{hash}/update';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $algorithm,
            'algorithm', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);


        // path params
        if ($hash !== null) {
            $resourcePath = str_replace(
                '{' . 'hash' . '}',
                ObjectSerializer::toPathValue($hash),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($get_latest_version_from_hash_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($get_latest_version_from_hash_body));
            } else {
                $httpBody = $get_latest_version_from_hash_body;
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
     * Operation getLatestVersionsFromHashes
     *
     * Latest versions of multiple project from hashes, loader(s), and game version(s)
     *
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody $get_latest_versions_from_hashes_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionsFromHashes'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<string,\Aternos\ModrinthApi\Model\Version>
     */
    public function getLatestVersionsFromHashes($get_latest_versions_from_hashes_body = null, string $contentType = self::contentTypes['getLatestVersionsFromHashes'][0])
    {
        list($response) = $this->getLatestVersionsFromHashesWithHttpInfo($get_latest_versions_from_hashes_body, $contentType);
        return $response;
    }

    /**
     * Operation getLatestVersionsFromHashesWithHttpInfo
     *
     * Latest versions of multiple project from hashes, loader(s), and game version(s)
     *
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody $get_latest_versions_from_hashes_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionsFromHashes'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of array<string,\Aternos\ModrinthApi\Model\Version>, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLatestVersionsFromHashesWithHttpInfo($get_latest_versions_from_hashes_body = null, string $contentType = self::contentTypes['getLatestVersionsFromHashes'][0])
    {
        $request = $this->getLatestVersionsFromHashesRequest($get_latest_versions_from_hashes_body, $contentType);

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
                    if ('array<string,\Aternos\ModrinthApi\Model\Version>' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('array<string,\Aternos\ModrinthApi\Model\Version>' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'array<string,\Aternos\ModrinthApi\Model\Version>', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'array<string,\Aternos\ModrinthApi\Model\Version>';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
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
                        'array<string,\Aternos\ModrinthApi\Model\Version>',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getLatestVersionsFromHashesAsync
     *
     * Latest versions of multiple project from hashes, loader(s), and game version(s)
     *
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody $get_latest_versions_from_hashes_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionsFromHashes'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLatestVersionsFromHashesAsync($get_latest_versions_from_hashes_body = null, string $contentType = self::contentTypes['getLatestVersionsFromHashes'][0])
    {
        return $this->getLatestVersionsFromHashesAsyncWithHttpInfo($get_latest_versions_from_hashes_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getLatestVersionsFromHashesAsyncWithHttpInfo
     *
     * Latest versions of multiple project from hashes, loader(s), and game version(s)
     *
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody $get_latest_versions_from_hashes_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionsFromHashes'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getLatestVersionsFromHashesAsyncWithHttpInfo($get_latest_versions_from_hashes_body = null, string $contentType = self::contentTypes['getLatestVersionsFromHashes'][0])
    {
        $returnType = 'array<string,\Aternos\ModrinthApi\Model\Version>';
        $request = $this->getLatestVersionsFromHashesRequest($get_latest_versions_from_hashes_body, $contentType);

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
     * Create request for operation 'getLatestVersionsFromHashes'
     *
     * @param  \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody $get_latest_versions_from_hashes_body Parameters of the updated version requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getLatestVersionsFromHashes'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getLatestVersionsFromHashesRequest($get_latest_versions_from_hashes_body = null, string $contentType = self::contentTypes['getLatestVersionsFromHashes'][0])
    {



        $resourcePath = '/version_files/update';
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
        if (isset($get_latest_versions_from_hashes_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($get_latest_versions_from_hashes_body));
            } else {
                $httpBody = $get_latest_versions_from_hashes_body;
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
     * Operation versionFromHash
     *
     * Get version from hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  bool $multiple Whether to return multiple results when looking for this hash (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionFromHash'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Version
     */
    public function versionFromHash($hash, $algorithm, $multiple = false, string $contentType = self::contentTypes['versionFromHash'][0])
    {
        list($response) = $this->versionFromHashWithHttpInfo($hash, $algorithm, $multiple, $contentType);
        return $response;
    }

    /**
     * Operation versionFromHashWithHttpInfo
     *
     * Get version from hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  bool $multiple Whether to return multiple results when looking for this hash (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionFromHash'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Version, HTTP status code, HTTP response headers (array of strings)
     */
    public function versionFromHashWithHttpInfo($hash, $algorithm, $multiple = false, string $contentType = self::contentTypes['versionFromHash'][0])
    {
        $request = $this->versionFromHashRequest($hash, $algorithm, $multiple, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Version' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Version' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Version', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Version';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
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
                        '\Aternos\ModrinthApi\Model\Version',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation versionFromHashAsync
     *
     * Get version from hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  bool $multiple Whether to return multiple results when looking for this hash (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function versionFromHashAsync($hash, $algorithm, $multiple = false, string $contentType = self::contentTypes['versionFromHash'][0])
    {
        return $this->versionFromHashAsyncWithHttpInfo($hash, $algorithm, $multiple, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation versionFromHashAsyncWithHttpInfo
     *
     * Get version from hash
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  bool $multiple Whether to return multiple results when looking for this hash (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function versionFromHashAsyncWithHttpInfo($hash, $algorithm, $multiple = false, string $contentType = self::contentTypes['versionFromHash'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Version';
        $request = $this->versionFromHashRequest($hash, $algorithm, $multiple, $contentType);

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
     * Create request for operation 'versionFromHash'
     *
     * @param  string $hash The hash of the file, considering its byte content, and encoded in hexadecimal (required)
     * @param  string $algorithm The algorithm of the hash (required)
     * @param  bool $multiple Whether to return multiple results when looking for this hash (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionFromHash'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function versionFromHashRequest($hash, $algorithm, $multiple = false, string $contentType = self::contentTypes['versionFromHash'][0])
    {

        // verify the required parameter 'hash' is set
        if ($hash === null || (is_array($hash) && count($hash) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $hash when calling versionFromHash'
            );
        }

        // verify the required parameter 'algorithm' is set
        if ($algorithm === null || (is_array($algorithm) && count($algorithm) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $algorithm when calling versionFromHash'
            );
        }



        $resourcePath = '/version_file/{hash}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $algorithm,
            'algorithm', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $multiple,
            'multiple', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($hash !== null) {
            $resourcePath = str_replace(
                '{' . 'hash' . '}',
                ObjectSerializer::toPathValue($hash),
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
     * Operation versionsFromHashes
     *
     * Get versions from hashes
     *
     * @param  \Aternos\ModrinthApi\Model\HashList $hash_list Hashes and algorithm of the versions requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionsFromHashes'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array<string,\Aternos\ModrinthApi\Model\Version>
     */
    public function versionsFromHashes($hash_list = null, string $contentType = self::contentTypes['versionsFromHashes'][0])
    {
        list($response) = $this->versionsFromHashesWithHttpInfo($hash_list, $contentType);
        return $response;
    }

    /**
     * Operation versionsFromHashesWithHttpInfo
     *
     * Get versions from hashes
     *
     * @param  \Aternos\ModrinthApi\Model\HashList $hash_list Hashes and algorithm of the versions requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionsFromHashes'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of array<string,\Aternos\ModrinthApi\Model\Version>, HTTP status code, HTTP response headers (array of strings)
     */
    public function versionsFromHashesWithHttpInfo($hash_list = null, string $contentType = self::contentTypes['versionsFromHashes'][0])
    {
        $request = $this->versionsFromHashesRequest($hash_list, $contentType);

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
                    if ('array<string,\Aternos\ModrinthApi\Model\Version>' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('array<string,\Aternos\ModrinthApi\Model\Version>' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'array<string,\Aternos\ModrinthApi\Model\Version>', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = 'array<string,\Aternos\ModrinthApi\Model\Version>';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
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
                        'array<string,\Aternos\ModrinthApi\Model\Version>',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation versionsFromHashesAsync
     *
     * Get versions from hashes
     *
     * @param  \Aternos\ModrinthApi\Model\HashList $hash_list Hashes and algorithm of the versions requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionsFromHashes'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function versionsFromHashesAsync($hash_list = null, string $contentType = self::contentTypes['versionsFromHashes'][0])
    {
        return $this->versionsFromHashesAsyncWithHttpInfo($hash_list, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation versionsFromHashesAsyncWithHttpInfo
     *
     * Get versions from hashes
     *
     * @param  \Aternos\ModrinthApi\Model\HashList $hash_list Hashes and algorithm of the versions requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionsFromHashes'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function versionsFromHashesAsyncWithHttpInfo($hash_list = null, string $contentType = self::contentTypes['versionsFromHashes'][0])
    {
        $returnType = 'array<string,\Aternos\ModrinthApi\Model\Version>';
        $request = $this->versionsFromHashesRequest($hash_list, $contentType);

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
     * Create request for operation 'versionsFromHashes'
     *
     * @param  \Aternos\ModrinthApi\Model\HashList $hash_list Hashes and algorithm of the versions requested (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['versionsFromHashes'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function versionsFromHashesRequest($hash_list = null, string $contentType = self::contentTypes['versionsFromHashes'][0])
    {



        $resourcePath = '/version_files';
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
        if (isset($hash_list)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($hash_list));
            } else {
                $httpBody = $hash_list;
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
