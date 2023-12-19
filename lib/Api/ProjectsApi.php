<?php
/**
 * ProjectsApi
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
 * OpenAPI Generator version: 7.1.0
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
 * ProjectsApi Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ProjectsApi
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
        'addGalleryImage' => [
            'image/png',
            'image/jpeg',
            'image/bmp',
            'image/gif',
            'image/webp',
            'image/svg',
            'image/svgz',
            'image/rgb',
        ],
        'changeProjectIcon' => [
            'image/png',
            'image/jpeg',
            'image/bmp',
            'image/gif',
            'image/webp',
            'image/svg',
            'image/svgz',
            'image/rgb',
        ],
        'checkProjectValidity' => [
            'application/json',
        ],
        'createProject' => [
            'multipart/form-data',
        ],
        'deleteGalleryImage' => [
            'application/json',
        ],
        'deleteProject' => [
            'application/json',
        ],
        'deleteProjectIcon' => [
            'application/json',
        ],
        'followProject' => [
            'application/json',
        ],
        'getDependencies' => [
            'application/json',
        ],
        'getProject' => [
            'application/json',
        ],
        'getProjects' => [
            'application/json',
        ],
        'modifyGalleryImage' => [
            'application/json',
        ],
        'modifyProject' => [
            'application/json',
        ],
        'patchProjects' => [
            'application/json',
        ],
        'randomProjects' => [
            'application/json',
        ],
        'scheduleProject' => [
            'application/json',
        ],
        'searchProjects' => [
            'application/json',
        ],
        'unfollowProject' => [
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
     * Operation addGalleryImage
     *
     * Add a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  bool $featured Whether an image is featured (required)
     * @param  string $title Title of the image (optional)
     * @param  string $description Description of the image (optional)
     * @param  int $ordering Ordering of the image (optional)
     * @param  \SplFileObject $body body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addGalleryImage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function addGalleryImage($id_slug, $ext, $featured, $title = null, $description = null, $ordering = null, $body = null, string $contentType = self::contentTypes['addGalleryImage'][0])
    {
        $this->addGalleryImageWithHttpInfo($id_slug, $ext, $featured, $title, $description, $ordering, $body, $contentType);
    }

    /**
     * Operation addGalleryImageWithHttpInfo
     *
     * Add a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  bool $featured Whether an image is featured (required)
     * @param  string $title Title of the image (optional)
     * @param  string $description Description of the image (optional)
     * @param  int $ordering Ordering of the image (optional)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addGalleryImage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function addGalleryImageWithHttpInfo($id_slug, $ext, $featured, $title = null, $description = null, $ordering = null, $body = null, string $contentType = self::contentTypes['addGalleryImage'][0])
    {
        $request = $this->addGalleryImageRequest($id_slug, $ext, $featured, $title, $description, $ordering, $body, $contentType);

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
     * Operation addGalleryImageAsync
     *
     * Add a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  bool $featured Whether an image is featured (required)
     * @param  string $title Title of the image (optional)
     * @param  string $description Description of the image (optional)
     * @param  int $ordering Ordering of the image (optional)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addGalleryImageAsync($id_slug, $ext, $featured, $title = null, $description = null, $ordering = null, $body = null, string $contentType = self::contentTypes['addGalleryImage'][0])
    {
        return $this->addGalleryImageAsyncWithHttpInfo($id_slug, $ext, $featured, $title, $description, $ordering, $body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation addGalleryImageAsyncWithHttpInfo
     *
     * Add a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  bool $featured Whether an image is featured (required)
     * @param  string $title Title of the image (optional)
     * @param  string $description Description of the image (optional)
     * @param  int $ordering Ordering of the image (optional)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function addGalleryImageAsyncWithHttpInfo($id_slug, $ext, $featured, $title = null, $description = null, $ordering = null, $body = null, string $contentType = self::contentTypes['addGalleryImage'][0])
    {
        $returnType = '';
        $request = $this->addGalleryImageRequest($id_slug, $ext, $featured, $title, $description, $ordering, $body, $contentType);

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
     * Create request for operation 'addGalleryImage'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  bool $featured Whether an image is featured (required)
     * @param  string $title Title of the image (optional)
     * @param  string $description Description of the image (optional)
     * @param  int $ordering Ordering of the image (optional)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['addGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function addGalleryImageRequest($id_slug, $ext, $featured, $title = null, $description = null, $ordering = null, $body = null, string $contentType = self::contentTypes['addGalleryImage'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling addGalleryImage'
            );
        }

        // verify the required parameter 'ext' is set
        if ($ext === null || (is_array($ext) && count($ext) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ext when calling addGalleryImage'
            );
        }

        // verify the required parameter 'featured' is set
        if ($featured === null || (is_array($featured) && count($featured) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $featured when calling addGalleryImage'
            );
        }






        $resourcePath = '/project/{id|slug}/gallery';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ext,
            'ext', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $featured,
            'featured', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $title,
            'title', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $description,
            'description', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ordering,
            'ordering', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


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
        if (isset($body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($body));
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
     * Operation changeProjectIcon
     *
     * Change project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  \SplFileObject $body body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeProjectIcon'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function changeProjectIcon($id_slug, $ext, $body = null, string $contentType = self::contentTypes['changeProjectIcon'][0])
    {
        $this->changeProjectIconWithHttpInfo($id_slug, $ext, $body, $contentType);
    }

    /**
     * Operation changeProjectIconWithHttpInfo
     *
     * Change project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeProjectIcon'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function changeProjectIconWithHttpInfo($id_slug, $ext, $body = null, string $contentType = self::contentTypes['changeProjectIcon'][0])
    {
        $request = $this->changeProjectIconRequest($id_slug, $ext, $body, $contentType);

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
            }
            throw $e;
        }
    }

    /**
     * Operation changeProjectIconAsync
     *
     * Change project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeProjectIcon'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function changeProjectIconAsync($id_slug, $ext, $body = null, string $contentType = self::contentTypes['changeProjectIcon'][0])
    {
        return $this->changeProjectIconAsyncWithHttpInfo($id_slug, $ext, $body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation changeProjectIconAsyncWithHttpInfo
     *
     * Change project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeProjectIcon'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function changeProjectIconAsyncWithHttpInfo($id_slug, $ext, $body = null, string $contentType = self::contentTypes['changeProjectIcon'][0])
    {
        $returnType = '';
        $request = $this->changeProjectIconRequest($id_slug, $ext, $body, $contentType);

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
     * Create request for operation 'changeProjectIcon'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $ext Image extension (required)
     * @param  \SplFileObject $body (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['changeProjectIcon'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function changeProjectIconRequest($id_slug, $ext, $body = null, string $contentType = self::contentTypes['changeProjectIcon'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling changeProjectIcon'
            );
        }

        // verify the required parameter 'ext' is set
        if ($ext === null || (is_array($ext) && count($ext) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ext when calling changeProjectIcon'
            );
        }



        $resourcePath = '/project/{id|slug}/icon';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ext,
            'ext', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);


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
        if (isset($body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($body));
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
     * Operation checkProjectValidity
     *
     * Check project slug/ID validity
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checkProjectValidity'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\ProjectIdentifier
     */
    public function checkProjectValidity($id_slug, string $contentType = self::contentTypes['checkProjectValidity'][0])
    {
        list($response) = $this->checkProjectValidityWithHttpInfo($id_slug, $contentType);
        return $response;
    }

    /**
     * Operation checkProjectValidityWithHttpInfo
     *
     * Check project slug/ID validity
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checkProjectValidity'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\ProjectIdentifier, HTTP status code, HTTP response headers (array of strings)
     */
    public function checkProjectValidityWithHttpInfo($id_slug, string $contentType = self::contentTypes['checkProjectValidity'][0])
    {
        $request = $this->checkProjectValidityRequest($id_slug, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\ProjectIdentifier' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\ProjectIdentifier' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\ProjectIdentifier', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\ProjectIdentifier';
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
                        '\Aternos\ModrinthApi\Model\ProjectIdentifier',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation checkProjectValidityAsync
     *
     * Check project slug/ID validity
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checkProjectValidity'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function checkProjectValidityAsync($id_slug, string $contentType = self::contentTypes['checkProjectValidity'][0])
    {
        return $this->checkProjectValidityAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation checkProjectValidityAsyncWithHttpInfo
     *
     * Check project slug/ID validity
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checkProjectValidity'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function checkProjectValidityAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['checkProjectValidity'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\ProjectIdentifier';
        $request = $this->checkProjectValidityRequest($id_slug, $contentType);

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
     * Create request for operation 'checkProjectValidity'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['checkProjectValidity'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function checkProjectValidityRequest($id_slug, string $contentType = self::contentTypes['checkProjectValidity'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling checkProjectValidity'
            );
        }


        $resourcePath = '/project/{id|slug}/check';
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
     * Operation createProject
     *
     * Create a project
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableProject $data data (required)
     * @param  \SplFileObject $icon Project icon file (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Project|\Aternos\ModrinthApi\Model\InvalidInputError|\Aternos\ModrinthApi\Model\AuthError
     */
    public function createProject($data, $icon = null, string $contentType = self::contentTypes['createProject'][0])
    {
        list($response) = $this->createProjectWithHttpInfo($data, $icon, $contentType);
        return $response;
    }

    /**
     * Operation createProjectWithHttpInfo
     *
     * Create a project
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableProject $data (required)
     * @param  \SplFileObject $icon Project icon file (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Project|\Aternos\ModrinthApi\Model\InvalidInputError|\Aternos\ModrinthApi\Model\AuthError, HTTP status code, HTTP response headers (array of strings)
     */
    public function createProjectWithHttpInfo($data, $icon = null, string $contentType = self::contentTypes['createProject'][0])
    {
        $request = $this->createProjectRequest($data, $icon, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Project' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Project' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Project', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Aternos\ModrinthApi\Model\InvalidInputError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\InvalidInputError' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\AuthError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Project';
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
                        '\Aternos\ModrinthApi\Model\Project',
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
     * Operation createProjectAsync
     *
     * Create a project
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableProject $data (required)
     * @param  \SplFileObject $icon Project icon file (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectAsync($data, $icon = null, string $contentType = self::contentTypes['createProject'][0])
    {
        return $this->createProjectAsyncWithHttpInfo($data, $icon, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createProjectAsyncWithHttpInfo
     *
     * Create a project
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableProject $data (required)
     * @param  \SplFileObject $icon Project icon file (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function createProjectAsyncWithHttpInfo($data, $icon = null, string $contentType = self::contentTypes['createProject'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Project';
        $request = $this->createProjectRequest($data, $icon, $contentType);

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
     * Create request for operation 'createProject'
     *
     * @param  \Aternos\ModrinthApi\Model\CreatableProject $data (required)
     * @param  \SplFileObject $icon Project icon file (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['createProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function createProjectRequest($data, $icon = null, string $contentType = self::contentTypes['createProject'][0])
    {

        // verify the required parameter 'data' is set
        if ($data === null || (is_array($data) && count($data) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $data when calling createProject'
            );
        }



        $resourcePath = '/project';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        if ($data !== null) {
            $formParams['data'] = ObjectSerializer::toFormValue($data);
        }
        // form params
        if ($icon !== null) {
            $multipart = true;
            $formParams['icon'] = [];
            $paramFiles = is_array($icon) ? $icon : [$icon];
            foreach ($paramFiles as $paramFile) {
                $formParams['icon'][] = \GuzzleHttp\Psr7\Utils::tryFopen(
                    ObjectSerializer::toFormValue($paramFile),
                    'rb'
                );
            }
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
     * Operation deleteGalleryImage
     *
     * Delete a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to delete (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteGalleryImage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteGalleryImage($id_slug, $url, string $contentType = self::contentTypes['deleteGalleryImage'][0])
    {
        $this->deleteGalleryImageWithHttpInfo($id_slug, $url, $contentType);
    }

    /**
     * Operation deleteGalleryImageWithHttpInfo
     *
     * Delete a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to delete (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteGalleryImage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteGalleryImageWithHttpInfo($id_slug, $url, string $contentType = self::contentTypes['deleteGalleryImage'][0])
    {
        $request = $this->deleteGalleryImageRequest($id_slug, $url, $contentType);

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
     * Operation deleteGalleryImageAsync
     *
     * Delete a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to delete (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteGalleryImageAsync($id_slug, $url, string $contentType = self::contentTypes['deleteGalleryImage'][0])
    {
        return $this->deleteGalleryImageAsyncWithHttpInfo($id_slug, $url, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteGalleryImageAsyncWithHttpInfo
     *
     * Delete a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to delete (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteGalleryImageAsyncWithHttpInfo($id_slug, $url, string $contentType = self::contentTypes['deleteGalleryImage'][0])
    {
        $returnType = '';
        $request = $this->deleteGalleryImageRequest($id_slug, $url, $contentType);

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
     * Create request for operation 'deleteGalleryImage'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to delete (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteGalleryImageRequest($id_slug, $url, string $contentType = self::contentTypes['deleteGalleryImage'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling deleteGalleryImage'
            );
        }

        // verify the required parameter 'url' is set
        if ($url === null || (is_array($url) && count($url) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $url when calling deleteGalleryImage'
            );
        }


        $resourcePath = '/project/{id|slug}/gallery';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $url,
            'url', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);


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
     * Operation deleteProject
     *
     * Delete a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteProject($id_slug, string $contentType = self::contentTypes['deleteProject'][0])
    {
        $this->deleteProjectWithHttpInfo($id_slug, $contentType);
    }

    /**
     * Operation deleteProjectWithHttpInfo
     *
     * Delete a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProjectWithHttpInfo($id_slug, string $contentType = self::contentTypes['deleteProject'][0])
    {
        $request = $this->deleteProjectRequest($id_slug, $contentType);

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
     * Operation deleteProjectAsync
     *
     * Delete a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectAsync($id_slug, string $contentType = self::contentTypes['deleteProject'][0])
    {
        return $this->deleteProjectAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteProjectAsyncWithHttpInfo
     *
     * Delete a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['deleteProject'][0])
    {
        $returnType = '';
        $request = $this->deleteProjectRequest($id_slug, $contentType);

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
     * Create request for operation 'deleteProject'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteProjectRequest($id_slug, string $contentType = self::contentTypes['deleteProject'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling deleteProject'
            );
        }


        $resourcePath = '/project/{id|slug}';
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
     * Operation deleteProjectIcon
     *
     * Delete project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectIcon'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function deleteProjectIcon($id_slug, string $contentType = self::contentTypes['deleteProjectIcon'][0])
    {
        $this->deleteProjectIconWithHttpInfo($id_slug, $contentType);
    }

    /**
     * Operation deleteProjectIconWithHttpInfo
     *
     * Delete project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectIcon'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProjectIconWithHttpInfo($id_slug, string $contentType = self::contentTypes['deleteProjectIcon'][0])
    {
        $request = $this->deleteProjectIconRequest($id_slug, $contentType);

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
     * Operation deleteProjectIconAsync
     *
     * Delete project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectIcon'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectIconAsync($id_slug, string $contentType = self::contentTypes['deleteProjectIcon'][0])
    {
        return $this->deleteProjectIconAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation deleteProjectIconAsyncWithHttpInfo
     *
     * Delete project&#39;s icon
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectIcon'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function deleteProjectIconAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['deleteProjectIcon'][0])
    {
        $returnType = '';
        $request = $this->deleteProjectIconRequest($id_slug, $contentType);

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
     * Create request for operation 'deleteProjectIcon'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['deleteProjectIcon'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function deleteProjectIconRequest($id_slug, string $contentType = self::contentTypes['deleteProjectIcon'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling deleteProjectIcon'
            );
        }


        $resourcePath = '/project/{id|slug}/icon';
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
     * Operation followProject
     *
     * Follow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['followProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function followProject($id_slug, string $contentType = self::contentTypes['followProject'][0])
    {
        $this->followProjectWithHttpInfo($id_slug, $contentType);
    }

    /**
     * Operation followProjectWithHttpInfo
     *
     * Follow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['followProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function followProjectWithHttpInfo($id_slug, string $contentType = self::contentTypes['followProject'][0])
    {
        $request = $this->followProjectRequest($id_slug, $contentType);

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
     * Operation followProjectAsync
     *
     * Follow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['followProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function followProjectAsync($id_slug, string $contentType = self::contentTypes['followProject'][0])
    {
        return $this->followProjectAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation followProjectAsyncWithHttpInfo
     *
     * Follow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['followProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function followProjectAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['followProject'][0])
    {
        $returnType = '';
        $request = $this->followProjectRequest($id_slug, $contentType);

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
     * Create request for operation 'followProject'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['followProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function followProjectRequest($id_slug, string $contentType = self::contentTypes['followProject'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling followProject'
            );
        }


        $resourcePath = '/project/{id|slug}/follow';
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
     * Operation getDependencies
     *
     * Get all of a project&#39;s dependencies
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDependencies'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\ProjectDependencyList
     */
    public function getDependencies($id_slug, string $contentType = self::contentTypes['getDependencies'][0])
    {
        list($response) = $this->getDependenciesWithHttpInfo($id_slug, $contentType);
        return $response;
    }

    /**
     * Operation getDependenciesWithHttpInfo
     *
     * Get all of a project&#39;s dependencies
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDependencies'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\ProjectDependencyList, HTTP status code, HTTP response headers (array of strings)
     */
    public function getDependenciesWithHttpInfo($id_slug, string $contentType = self::contentTypes['getDependencies'][0])
    {
        $request = $this->getDependenciesRequest($id_slug, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\ProjectDependencyList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\ProjectDependencyList' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\ProjectDependencyList', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\ProjectDependencyList';
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
                        '\Aternos\ModrinthApi\Model\ProjectDependencyList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getDependenciesAsync
     *
     * Get all of a project&#39;s dependencies
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDependencies'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDependenciesAsync($id_slug, string $contentType = self::contentTypes['getDependencies'][0])
    {
        return $this->getDependenciesAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getDependenciesAsyncWithHttpInfo
     *
     * Get all of a project&#39;s dependencies
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDependencies'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getDependenciesAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['getDependencies'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\ProjectDependencyList';
        $request = $this->getDependenciesRequest($id_slug, $contentType);

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
     * Create request for operation 'getDependencies'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getDependencies'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getDependenciesRequest($id_slug, string $contentType = self::contentTypes['getDependencies'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling getDependencies'
            );
        }


        $resourcePath = '/project/{id|slug}/dependencies';
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
     * Operation getProject
     *
     * Get a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Project
     */
    public function getProject($id_slug, string $contentType = self::contentTypes['getProject'][0])
    {
        list($response) = $this->getProjectWithHttpInfo($id_slug, $contentType);
        return $response;
    }

    /**
     * Operation getProjectWithHttpInfo
     *
     * Get a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Project, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectWithHttpInfo($id_slug, string $contentType = self::contentTypes['getProject'][0])
    {
        $request = $this->getProjectRequest($id_slug, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Project' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Project' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Project', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Project';
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
                        '\Aternos\ModrinthApi\Model\Project',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getProjectAsync
     *
     * Get a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectAsync($id_slug, string $contentType = self::contentTypes['getProject'][0])
    {
        return $this->getProjectAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectAsyncWithHttpInfo
     *
     * Get a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['getProject'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Project';
        $request = $this->getProjectRequest($id_slug, $contentType);

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
     * Create request for operation 'getProject'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getProjectRequest($id_slug, string $contentType = self::contentTypes['getProject'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling getProject'
            );
        }


        $resourcePath = '/project/{id|slug}';
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
     * Operation getProjects
     *
     * Get multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Project[]
     */
    public function getProjects($ids, string $contentType = self::contentTypes['getProjects'][0])
    {
        list($response) = $this->getProjectsWithHttpInfo($ids, $contentType);
        return $response;
    }

    /**
     * Operation getProjectsWithHttpInfo
     *
     * Get multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Project[], HTTP status code, HTTP response headers (array of strings)
     */
    public function getProjectsWithHttpInfo($ids, string $contentType = self::contentTypes['getProjects'][0])
    {
        $request = $this->getProjectsRequest($ids, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Project[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Project[]' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Project[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Project[]';
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
                        '\Aternos\ModrinthApi\Model\Project[]',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getProjectsAsync
     *
     * Get multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsAsync($ids, string $contentType = self::contentTypes['getProjects'][0])
    {
        return $this->getProjectsAsyncWithHttpInfo($ids, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getProjectsAsyncWithHttpInfo
     *
     * Get multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getProjectsAsyncWithHttpInfo($ids, string $contentType = self::contentTypes['getProjects'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Project[]';
        $request = $this->getProjectsRequest($ids, $contentType);

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
     * Create request for operation 'getProjects'
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['getProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function getProjectsRequest($ids, string $contentType = self::contentTypes['getProjects'][0])
    {

        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ids when calling getProjects'
            );
        }


        $resourcePath = '/projects';
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
     * Operation modifyGalleryImage
     *
     * Modify a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to modify (required)
     * @param  bool $featured Whether the image is featured (optional)
     * @param  string $title New title of the image (optional)
     * @param  string $description New description of the image (optional)
     * @param  int $ordering New ordering of the image (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyGalleryImage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function modifyGalleryImage($id_slug, $url, $featured = null, $title = null, $description = null, $ordering = null, string $contentType = self::contentTypes['modifyGalleryImage'][0])
    {
        $this->modifyGalleryImageWithHttpInfo($id_slug, $url, $featured, $title, $description, $ordering, $contentType);
    }

    /**
     * Operation modifyGalleryImageWithHttpInfo
     *
     * Modify a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to modify (required)
     * @param  bool $featured Whether the image is featured (optional)
     * @param  string $title New title of the image (optional)
     * @param  string $description New description of the image (optional)
     * @param  int $ordering New ordering of the image (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyGalleryImage'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyGalleryImageWithHttpInfo($id_slug, $url, $featured = null, $title = null, $description = null, $ordering = null, string $contentType = self::contentTypes['modifyGalleryImage'][0])
    {
        $request = $this->modifyGalleryImageRequest($id_slug, $url, $featured, $title, $description, $ordering, $contentType);

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
     * Operation modifyGalleryImageAsync
     *
     * Modify a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to modify (required)
     * @param  bool $featured Whether the image is featured (optional)
     * @param  string $title New title of the image (optional)
     * @param  string $description New description of the image (optional)
     * @param  int $ordering New ordering of the image (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyGalleryImageAsync($id_slug, $url, $featured = null, $title = null, $description = null, $ordering = null, string $contentType = self::contentTypes['modifyGalleryImage'][0])
    {
        return $this->modifyGalleryImageAsyncWithHttpInfo($id_slug, $url, $featured, $title, $description, $ordering, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyGalleryImageAsyncWithHttpInfo
     *
     * Modify a gallery image
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to modify (required)
     * @param  bool $featured Whether the image is featured (optional)
     * @param  string $title New title of the image (optional)
     * @param  string $description New description of the image (optional)
     * @param  int $ordering New ordering of the image (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyGalleryImageAsyncWithHttpInfo($id_slug, $url, $featured = null, $title = null, $description = null, $ordering = null, string $contentType = self::contentTypes['modifyGalleryImage'][0])
    {
        $returnType = '';
        $request = $this->modifyGalleryImageRequest($id_slug, $url, $featured, $title, $description, $ordering, $contentType);

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
     * Create request for operation 'modifyGalleryImage'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $url URL link of the image to modify (required)
     * @param  bool $featured Whether the image is featured (optional)
     * @param  string $title New title of the image (optional)
     * @param  string $description New description of the image (optional)
     * @param  int $ordering New ordering of the image (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyGalleryImage'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyGalleryImageRequest($id_slug, $url, $featured = null, $title = null, $description = null, $ordering = null, string $contentType = self::contentTypes['modifyGalleryImage'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling modifyGalleryImage'
            );
        }

        // verify the required parameter 'url' is set
        if ($url === null || (is_array($url) && count($url) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $url when calling modifyGalleryImage'
            );
        }






        $resourcePath = '/project/{id|slug}/gallery';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $url,
            'url', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $featured,
            'featured', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $title,
            'title', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $description,
            'description', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ordering,
            'ordering', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


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
     * Operation modifyProject
     *
     * Modify a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\EditableProject $editable_project Modified project fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function modifyProject($id_slug, $editable_project = null, string $contentType = self::contentTypes['modifyProject'][0])
    {
        $this->modifyProjectWithHttpInfo($id_slug, $editable_project, $contentType);
    }

    /**
     * Operation modifyProjectWithHttpInfo
     *
     * Modify a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\EditableProject $editable_project Modified project fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function modifyProjectWithHttpInfo($id_slug, $editable_project = null, string $contentType = self::contentTypes['modifyProject'][0])
    {
        $request = $this->modifyProjectRequest($id_slug, $editable_project, $contentType);

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
     * Operation modifyProjectAsync
     *
     * Modify a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\EditableProject $editable_project Modified project fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyProjectAsync($id_slug, $editable_project = null, string $contentType = self::contentTypes['modifyProject'][0])
    {
        return $this->modifyProjectAsyncWithHttpInfo($id_slug, $editable_project, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation modifyProjectAsyncWithHttpInfo
     *
     * Modify a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\EditableProject $editable_project Modified project fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function modifyProjectAsyncWithHttpInfo($id_slug, $editable_project = null, string $contentType = self::contentTypes['modifyProject'][0])
    {
        $returnType = '';
        $request = $this->modifyProjectRequest($id_slug, $editable_project, $contentType);

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
     * Create request for operation 'modifyProject'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\EditableProject $editable_project Modified project fields (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['modifyProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function modifyProjectRequest($id_slug, $editable_project = null, string $contentType = self::contentTypes['modifyProject'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling modifyProject'
            );
        }



        $resourcePath = '/project/{id|slug}';
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
        if (isset($editable_project)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($editable_project));
            } else {
                $httpBody = $editable_project;
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
     * Operation patchProjects
     *
     * Bulk-edit multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  \Aternos\ModrinthApi\Model\PatchProjectsBody $patch_projects_body Fields to edit on all projects specified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function patchProjects($ids, $patch_projects_body = null, string $contentType = self::contentTypes['patchProjects'][0])
    {
        $this->patchProjectsWithHttpInfo($ids, $patch_projects_body, $contentType);
    }

    /**
     * Operation patchProjectsWithHttpInfo
     *
     * Bulk-edit multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  \Aternos\ModrinthApi\Model\PatchProjectsBody $patch_projects_body Fields to edit on all projects specified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function patchProjectsWithHttpInfo($ids, $patch_projects_body = null, string $contentType = self::contentTypes['patchProjects'][0])
    {
        $request = $this->patchProjectsRequest($ids, $patch_projects_body, $contentType);

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
     * Operation patchProjectsAsync
     *
     * Bulk-edit multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  \Aternos\ModrinthApi\Model\PatchProjectsBody $patch_projects_body Fields to edit on all projects specified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchProjectsAsync($ids, $patch_projects_body = null, string $contentType = self::contentTypes['patchProjects'][0])
    {
        return $this->patchProjectsAsyncWithHttpInfo($ids, $patch_projects_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation patchProjectsAsyncWithHttpInfo
     *
     * Bulk-edit multiple projects
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  \Aternos\ModrinthApi\Model\PatchProjectsBody $patch_projects_body Fields to edit on all projects specified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function patchProjectsAsyncWithHttpInfo($ids, $patch_projects_body = null, string $contentType = self::contentTypes['patchProjects'][0])
    {
        $returnType = '';
        $request = $this->patchProjectsRequest($ids, $patch_projects_body, $contentType);

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
     * Create request for operation 'patchProjects'
     *
     * @param  string $ids The IDs of the projects (required)
     * @param  \Aternos\ModrinthApi\Model\PatchProjectsBody $patch_projects_body Fields to edit on all projects specified (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['patchProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function patchProjectsRequest($ids, $patch_projects_body = null, string $contentType = self::contentTypes['patchProjects'][0])
    {

        // verify the required parameter 'ids' is set
        if ($ids === null || (is_array($ids) && count($ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $ids when calling patchProjects'
            );
        }



        $resourcePath = '/projects';
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
        if (isset($patch_projects_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($patch_projects_body));
            } else {
                $httpBody = $patch_projects_body;
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
     * Operation randomProjects
     *
     * Get a list of random projects
     *
     * @param  int $count The number of random projects to return (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['randomProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\Project[]|\Aternos\ModrinthApi\Model\InvalidInputError
     */
    public function randomProjects($count, string $contentType = self::contentTypes['randomProjects'][0])
    {
        list($response) = $this->randomProjectsWithHttpInfo($count, $contentType);
        return $response;
    }

    /**
     * Operation randomProjectsWithHttpInfo
     *
     * Get a list of random projects
     *
     * @param  int $count The number of random projects to return (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['randomProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\Project[]|\Aternos\ModrinthApi\Model\InvalidInputError, HTTP status code, HTTP response headers (array of strings)
     */
    public function randomProjectsWithHttpInfo($count, string $contentType = self::contentTypes['randomProjects'][0])
    {
        $request = $this->randomProjectsRequest($count, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\Project[]' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\Project[]' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\Project[]', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Aternos\ModrinthApi\Model\InvalidInputError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\InvalidInputError' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\InvalidInputError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\Project[]';
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
                        '\Aternos\ModrinthApi\Model\Project[]',
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
     * Operation randomProjectsAsync
     *
     * Get a list of random projects
     *
     * @param  int $count The number of random projects to return (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['randomProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function randomProjectsAsync($count, string $contentType = self::contentTypes['randomProjects'][0])
    {
        return $this->randomProjectsAsyncWithHttpInfo($count, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation randomProjectsAsyncWithHttpInfo
     *
     * Get a list of random projects
     *
     * @param  int $count The number of random projects to return (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['randomProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function randomProjectsAsyncWithHttpInfo($count, string $contentType = self::contentTypes['randomProjects'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\Project[]';
        $request = $this->randomProjectsRequest($count, $contentType);

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
     * Create request for operation 'randomProjects'
     *
     * @param  int $count The number of random projects to return (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['randomProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function randomProjectsRequest($count, string $contentType = self::contentTypes['randomProjects'][0])
    {

        // verify the required parameter 'count' is set
        if ($count === null || (is_array($count) && count($count) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $count when calling randomProjects'
            );
        }
        if ($count > 100) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling ProjectsApi.randomProjects, must be smaller than or equal to 100.');
        }
        if ($count < 0) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling ProjectsApi.randomProjects, must be bigger than or equal to 0.');
        }
        

        $resourcePath = '/projects_random';
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
     * Operation scheduleProject
     *
     * Schedule a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\Schedule $schedule Information about date and requested status (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['scheduleProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function scheduleProject($id_slug, $schedule = null, string $contentType = self::contentTypes['scheduleProject'][0])
    {
        $this->scheduleProjectWithHttpInfo($id_slug, $schedule, $contentType);
    }

    /**
     * Operation scheduleProjectWithHttpInfo
     *
     * Schedule a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\Schedule $schedule Information about date and requested status (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['scheduleProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function scheduleProjectWithHttpInfo($id_slug, $schedule = null, string $contentType = self::contentTypes['scheduleProject'][0])
    {
        $request = $this->scheduleProjectRequest($id_slug, $schedule, $contentType);

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
     * Operation scheduleProjectAsync
     *
     * Schedule a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\Schedule $schedule Information about date and requested status (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['scheduleProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function scheduleProjectAsync($id_slug, $schedule = null, string $contentType = self::contentTypes['scheduleProject'][0])
    {
        return $this->scheduleProjectAsyncWithHttpInfo($id_slug, $schedule, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation scheduleProjectAsyncWithHttpInfo
     *
     * Schedule a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\Schedule $schedule Information about date and requested status (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['scheduleProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function scheduleProjectAsyncWithHttpInfo($id_slug, $schedule = null, string $contentType = self::contentTypes['scheduleProject'][0])
    {
        $returnType = '';
        $request = $this->scheduleProjectRequest($id_slug, $schedule, $contentType);

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
     * Create request for operation 'scheduleProject'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  \Aternos\ModrinthApi\Model\Schedule $schedule Information about date and requested status (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['scheduleProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function scheduleProjectRequest($id_slug, $schedule = null, string $contentType = self::contentTypes['scheduleProject'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling scheduleProject'
            );
        }



        $resourcePath = '/project/{id|slug}/schedule';
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
        if (isset($schedule)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($schedule));
            } else {
                $httpBody = $schedule;
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
     * Operation searchProjects
     *
     * Search projects
     *
     * @param  string $query The query to search for (optional)
     * @param  string $facets Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - &#x60;project_type&#x60; - &#x60;categories&#x60; (loaders are lumped in with categories in search) - &#x60;versions&#x60; - &#x60;client_side&#x60; - &#x60;server_side&#x60; - &#x60;open_source&#x60;  Several others are also available for use, though these should not be used outside very specific use cases. - &#x60;title&#x60; - &#x60;author&#x60; - &#x60;follows&#x60; - &#x60;project_id&#x60; - &#x60;license&#x60; - &#x60;downloads&#x60; - &#x60;color&#x60; - &#x60;created_timestamp&#x60; - &#x60;modified_timestamp&#x60;  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is &#x60;:&#x60; (same as &#x60;&#x3D;&#x60;), though you can also use &#x60;!&#x3D;&#x60;, &#x60;&gt;&#x3D;&#x60;, &#x60;&gt;&#x60;, &#x60;&lt;&#x3D;&#x60;, and &#x60;&lt;&#x60;. Join together the type, operation, and value, and you&#39;ve got your string. &#x60;&#x60;&#x60; {type} {operation} {value} &#x60;&#x60;&#x60;  Examples: &#x60;&#x60;&#x60; categories &#x3D; adventure versions !&#x3D; 1.20.1 downloads &lt;&#x3D; 100 &#x60;&#x60;&#x60;  You then join these strings together in arrays to signal &#x60;AND&#x60; and &#x60;OR&#x60; operators.  ##### OR All elements in a single array are considered to be joined by OR statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;, \&quot;versions:1.17.1\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 OR 1.17.1&#x60;.  ##### AND Separate arrays are considered to be joined by AND statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;], [\&quot;project_type:modpack\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 AND are modpacks&#x60;. (optional)
     * @param  string $index The sorting method used for sorting search results (optional, default to 'relevance')
     * @param  int $offset The offset into the search. Skips this number of results (optional, default to 0)
     * @param  int $limit The number of results returned by the search (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['searchProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Aternos\ModrinthApi\Model\SearchResults|\Aternos\ModrinthApi\Model\InvalidInputError
     */
    public function searchProjects($query = null, $facets = null, $index = 'relevance', $offset = 0, $limit = 10, string $contentType = self::contentTypes['searchProjects'][0])
    {
        list($response) = $this->searchProjectsWithHttpInfo($query, $facets, $index, $offset, $limit, $contentType);
        return $response;
    }

    /**
     * Operation searchProjectsWithHttpInfo
     *
     * Search projects
     *
     * @param  string $query The query to search for (optional)
     * @param  string $facets Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - &#x60;project_type&#x60; - &#x60;categories&#x60; (loaders are lumped in with categories in search) - &#x60;versions&#x60; - &#x60;client_side&#x60; - &#x60;server_side&#x60; - &#x60;open_source&#x60;  Several others are also available for use, though these should not be used outside very specific use cases. - &#x60;title&#x60; - &#x60;author&#x60; - &#x60;follows&#x60; - &#x60;project_id&#x60; - &#x60;license&#x60; - &#x60;downloads&#x60; - &#x60;color&#x60; - &#x60;created_timestamp&#x60; - &#x60;modified_timestamp&#x60;  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is &#x60;:&#x60; (same as &#x60;&#x3D;&#x60;), though you can also use &#x60;!&#x3D;&#x60;, &#x60;&gt;&#x3D;&#x60;, &#x60;&gt;&#x60;, &#x60;&lt;&#x3D;&#x60;, and &#x60;&lt;&#x60;. Join together the type, operation, and value, and you&#39;ve got your string. &#x60;&#x60;&#x60; {type} {operation} {value} &#x60;&#x60;&#x60;  Examples: &#x60;&#x60;&#x60; categories &#x3D; adventure versions !&#x3D; 1.20.1 downloads &lt;&#x3D; 100 &#x60;&#x60;&#x60;  You then join these strings together in arrays to signal &#x60;AND&#x60; and &#x60;OR&#x60; operators.  ##### OR All elements in a single array are considered to be joined by OR statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;, \&quot;versions:1.17.1\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 OR 1.17.1&#x60;.  ##### AND Separate arrays are considered to be joined by AND statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;], [\&quot;project_type:modpack\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 AND are modpacks&#x60;. (optional)
     * @param  string $index The sorting method used for sorting search results (optional, default to 'relevance')
     * @param  int $offset The offset into the search. Skips this number of results (optional, default to 0)
     * @param  int $limit The number of results returned by the search (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['searchProjects'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Aternos\ModrinthApi\Model\SearchResults|\Aternos\ModrinthApi\Model\InvalidInputError, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchProjectsWithHttpInfo($query = null, $facets = null, $index = 'relevance', $offset = 0, $limit = 10, string $contentType = self::contentTypes['searchProjects'][0])
    {
        $request = $this->searchProjectsRequest($query, $facets, $index, $offset, $limit, $contentType);

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
                    if ('\Aternos\ModrinthApi\Model\SearchResults' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\SearchResults' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\SearchResults', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 400:
                    if ('\Aternos\ModrinthApi\Model\InvalidInputError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Aternos\ModrinthApi\Model\InvalidInputError' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Aternos\ModrinthApi\Model\InvalidInputError', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Aternos\ModrinthApi\Model\SearchResults';
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
                        '\Aternos\ModrinthApi\Model\SearchResults',
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
     * Operation searchProjectsAsync
     *
     * Search projects
     *
     * @param  string $query The query to search for (optional)
     * @param  string $facets Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - &#x60;project_type&#x60; - &#x60;categories&#x60; (loaders are lumped in with categories in search) - &#x60;versions&#x60; - &#x60;client_side&#x60; - &#x60;server_side&#x60; - &#x60;open_source&#x60;  Several others are also available for use, though these should not be used outside very specific use cases. - &#x60;title&#x60; - &#x60;author&#x60; - &#x60;follows&#x60; - &#x60;project_id&#x60; - &#x60;license&#x60; - &#x60;downloads&#x60; - &#x60;color&#x60; - &#x60;created_timestamp&#x60; - &#x60;modified_timestamp&#x60;  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is &#x60;:&#x60; (same as &#x60;&#x3D;&#x60;), though you can also use &#x60;!&#x3D;&#x60;, &#x60;&gt;&#x3D;&#x60;, &#x60;&gt;&#x60;, &#x60;&lt;&#x3D;&#x60;, and &#x60;&lt;&#x60;. Join together the type, operation, and value, and you&#39;ve got your string. &#x60;&#x60;&#x60; {type} {operation} {value} &#x60;&#x60;&#x60;  Examples: &#x60;&#x60;&#x60; categories &#x3D; adventure versions !&#x3D; 1.20.1 downloads &lt;&#x3D; 100 &#x60;&#x60;&#x60;  You then join these strings together in arrays to signal &#x60;AND&#x60; and &#x60;OR&#x60; operators.  ##### OR All elements in a single array are considered to be joined by OR statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;, \&quot;versions:1.17.1\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 OR 1.17.1&#x60;.  ##### AND Separate arrays are considered to be joined by AND statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;], [\&quot;project_type:modpack\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 AND are modpacks&#x60;. (optional)
     * @param  string $index The sorting method used for sorting search results (optional, default to 'relevance')
     * @param  int $offset The offset into the search. Skips this number of results (optional, default to 0)
     * @param  int $limit The number of results returned by the search (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['searchProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchProjectsAsync($query = null, $facets = null, $index = 'relevance', $offset = 0, $limit = 10, string $contentType = self::contentTypes['searchProjects'][0])
    {
        return $this->searchProjectsAsyncWithHttpInfo($query, $facets, $index, $offset, $limit, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation searchProjectsAsyncWithHttpInfo
     *
     * Search projects
     *
     * @param  string $query The query to search for (optional)
     * @param  string $facets Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - &#x60;project_type&#x60; - &#x60;categories&#x60; (loaders are lumped in with categories in search) - &#x60;versions&#x60; - &#x60;client_side&#x60; - &#x60;server_side&#x60; - &#x60;open_source&#x60;  Several others are also available for use, though these should not be used outside very specific use cases. - &#x60;title&#x60; - &#x60;author&#x60; - &#x60;follows&#x60; - &#x60;project_id&#x60; - &#x60;license&#x60; - &#x60;downloads&#x60; - &#x60;color&#x60; - &#x60;created_timestamp&#x60; - &#x60;modified_timestamp&#x60;  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is &#x60;:&#x60; (same as &#x60;&#x3D;&#x60;), though you can also use &#x60;!&#x3D;&#x60;, &#x60;&gt;&#x3D;&#x60;, &#x60;&gt;&#x60;, &#x60;&lt;&#x3D;&#x60;, and &#x60;&lt;&#x60;. Join together the type, operation, and value, and you&#39;ve got your string. &#x60;&#x60;&#x60; {type} {operation} {value} &#x60;&#x60;&#x60;  Examples: &#x60;&#x60;&#x60; categories &#x3D; adventure versions !&#x3D; 1.20.1 downloads &lt;&#x3D; 100 &#x60;&#x60;&#x60;  You then join these strings together in arrays to signal &#x60;AND&#x60; and &#x60;OR&#x60; operators.  ##### OR All elements in a single array are considered to be joined by OR statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;, \&quot;versions:1.17.1\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 OR 1.17.1&#x60;.  ##### AND Separate arrays are considered to be joined by AND statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;], [\&quot;project_type:modpack\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 AND are modpacks&#x60;. (optional)
     * @param  string $index The sorting method used for sorting search results (optional, default to 'relevance')
     * @param  int $offset The offset into the search. Skips this number of results (optional, default to 0)
     * @param  int $limit The number of results returned by the search (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['searchProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function searchProjectsAsyncWithHttpInfo($query = null, $facets = null, $index = 'relevance', $offset = 0, $limit = 10, string $contentType = self::contentTypes['searchProjects'][0])
    {
        $returnType = '\Aternos\ModrinthApi\Model\SearchResults';
        $request = $this->searchProjectsRequest($query, $facets, $index, $offset, $limit, $contentType);

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
     * Create request for operation 'searchProjects'
     *
     * @param  string $query The query to search for (optional)
     * @param  string $facets Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - &#x60;project_type&#x60; - &#x60;categories&#x60; (loaders are lumped in with categories in search) - &#x60;versions&#x60; - &#x60;client_side&#x60; - &#x60;server_side&#x60; - &#x60;open_source&#x60;  Several others are also available for use, though these should not be used outside very specific use cases. - &#x60;title&#x60; - &#x60;author&#x60; - &#x60;follows&#x60; - &#x60;project_id&#x60; - &#x60;license&#x60; - &#x60;downloads&#x60; - &#x60;color&#x60; - &#x60;created_timestamp&#x60; - &#x60;modified_timestamp&#x60;  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is &#x60;:&#x60; (same as &#x60;&#x3D;&#x60;), though you can also use &#x60;!&#x3D;&#x60;, &#x60;&gt;&#x3D;&#x60;, &#x60;&gt;&#x60;, &#x60;&lt;&#x3D;&#x60;, and &#x60;&lt;&#x60;. Join together the type, operation, and value, and you&#39;ve got your string. &#x60;&#x60;&#x60; {type} {operation} {value} &#x60;&#x60;&#x60;  Examples: &#x60;&#x60;&#x60; categories &#x3D; adventure versions !&#x3D; 1.20.1 downloads &lt;&#x3D; 100 &#x60;&#x60;&#x60;  You then join these strings together in arrays to signal &#x60;AND&#x60; and &#x60;OR&#x60; operators.  ##### OR All elements in a single array are considered to be joined by OR statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;, \&quot;versions:1.17.1\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 OR 1.17.1&#x60;.  ##### AND Separate arrays are considered to be joined by AND statements.   For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;], [\&quot;project_type:modpack\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 AND are modpacks&#x60;. (optional)
     * @param  string $index The sorting method used for sorting search results (optional, default to 'relevance')
     * @param  int $offset The offset into the search. Skips this number of results (optional, default to 0)
     * @param  int $limit The number of results returned by the search (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['searchProjects'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function searchProjectsRequest($query = null, $facets = null, $index = 'relevance', $offset = 0, $limit = 10, string $contentType = self::contentTypes['searchProjects'][0])
    {





        if ($limit !== null && $limit > 100) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ProjectsApi.searchProjects, must be smaller than or equal to 100.');
        }
        if ($limit !== null && $limit < 0) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ProjectsApi.searchProjects, must be bigger than or equal to 0.');
        }
        

        $resourcePath = '/search';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $query,
            'query', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $facets,
            'facets', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $index,
            'index', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $offset,
            'offset', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $limit,
            'limit', // param base name
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
     * Operation unfollowProject
     *
     * Unfollow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unfollowProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return void
     */
    public function unfollowProject($id_slug, string $contentType = self::contentTypes['unfollowProject'][0])
    {
        $this->unfollowProjectWithHttpInfo($id_slug, $contentType);
    }

    /**
     * Operation unfollowProjectWithHttpInfo
     *
     * Unfollow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unfollowProject'] to see the possible values for this operation
     *
     * @throws \Aternos\ModrinthApi\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function unfollowProjectWithHttpInfo($id_slug, string $contentType = self::contentTypes['unfollowProject'][0])
    {
        $request = $this->unfollowProjectRequest($id_slug, $contentType);

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
     * Operation unfollowProjectAsync
     *
     * Unfollow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unfollowProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unfollowProjectAsync($id_slug, string $contentType = self::contentTypes['unfollowProject'][0])
    {
        return $this->unfollowProjectAsyncWithHttpInfo($id_slug, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation unfollowProjectAsyncWithHttpInfo
     *
     * Unfollow a project
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unfollowProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function unfollowProjectAsyncWithHttpInfo($id_slug, string $contentType = self::contentTypes['unfollowProject'][0])
    {
        $returnType = '';
        $request = $this->unfollowProjectRequest($id_slug, $contentType);

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
     * Create request for operation 'unfollowProject'
     *
     * @param  string $id_slug The ID or slug of the project (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['unfollowProject'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function unfollowProjectRequest($id_slug, string $contentType = self::contentTypes['unfollowProject'][0])
    {

        // verify the required parameter 'id_slug' is set
        if ($id_slug === null || (is_array($id_slug) && count($id_slug) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_slug when calling unfollowProject'
            );
        }


        $resourcePath = '/project/{id|slug}/follow';
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
