<?php
/**
 * EditableProject
 *
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
 * OpenAPI Generator version: 6.6.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\ModrinthApi\Model;

use \ArrayAccess;
use \Aternos\ModrinthApi\ObjectSerializer;

/**
 * EditableProject Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class EditableProject implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'EditableProject';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'slug' => 'string',
        'title' => 'string',
        'description' => 'string',
        'categories' => 'string[]',
        'client_side' => 'string',
        'server_side' => 'string',
        'body' => 'string',
        'status' => 'string',
        'requested_status' => 'string',
        'additional_categories' => 'string[]',
        'issues_url' => 'string',
        'source_url' => 'string',
        'wiki_url' => 'string',
        'discord_url' => 'string',
        'donation_urls' => '\Aternos\ModrinthApi\Model\ProjectDonationURL[]',
        'license_id' => 'string',
        'license_url' => 'string',
        'moderation_message' => 'string',
        'moderation_message_body' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'slug' => null,
        'title' => null,
        'description' => null,
        'categories' => null,
        'client_side' => null,
        'server_side' => null,
        'body' => null,
        'status' => null,
        'requested_status' => null,
        'additional_categories' => null,
        'issues_url' => null,
        'source_url' => null,
        'wiki_url' => null,
        'discord_url' => null,
        'donation_urls' => null,
        'license_id' => null,
        'license_url' => null,
        'moderation_message' => null,
        'moderation_message_body' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'slug' => false,
		'title' => false,
		'description' => false,
		'categories' => false,
		'client_side' => false,
		'server_side' => false,
		'body' => false,
		'status' => false,
		'requested_status' => true,
		'additional_categories' => false,
		'issues_url' => true,
		'source_url' => true,
		'wiki_url' => true,
		'discord_url' => true,
		'donation_urls' => false,
		'license_id' => false,
		'license_url' => true,
		'moderation_message' => true,
		'moderation_message_body' => true
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'slug' => 'slug',
        'title' => 'title',
        'description' => 'description',
        'categories' => 'categories',
        'client_side' => 'client_side',
        'server_side' => 'server_side',
        'body' => 'body',
        'status' => 'status',
        'requested_status' => 'requested_status',
        'additional_categories' => 'additional_categories',
        'issues_url' => 'issues_url',
        'source_url' => 'source_url',
        'wiki_url' => 'wiki_url',
        'discord_url' => 'discord_url',
        'donation_urls' => 'donation_urls',
        'license_id' => 'license_id',
        'license_url' => 'license_url',
        'moderation_message' => 'moderation_message',
        'moderation_message_body' => 'moderation_message_body'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'slug' => 'setSlug',
        'title' => 'setTitle',
        'description' => 'setDescription',
        'categories' => 'setCategories',
        'client_side' => 'setClientSide',
        'server_side' => 'setServerSide',
        'body' => 'setBody',
        'status' => 'setStatus',
        'requested_status' => 'setRequestedStatus',
        'additional_categories' => 'setAdditionalCategories',
        'issues_url' => 'setIssuesUrl',
        'source_url' => 'setSourceUrl',
        'wiki_url' => 'setWikiUrl',
        'discord_url' => 'setDiscordUrl',
        'donation_urls' => 'setDonationUrls',
        'license_id' => 'setLicenseId',
        'license_url' => 'setLicenseUrl',
        'moderation_message' => 'setModerationMessage',
        'moderation_message_body' => 'setModerationMessageBody'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'slug' => 'getSlug',
        'title' => 'getTitle',
        'description' => 'getDescription',
        'categories' => 'getCategories',
        'client_side' => 'getClientSide',
        'server_side' => 'getServerSide',
        'body' => 'getBody',
        'status' => 'getStatus',
        'requested_status' => 'getRequestedStatus',
        'additional_categories' => 'getAdditionalCategories',
        'issues_url' => 'getIssuesUrl',
        'source_url' => 'getSourceUrl',
        'wiki_url' => 'getWikiUrl',
        'discord_url' => 'getDiscordUrl',
        'donation_urls' => 'getDonationUrls',
        'license_id' => 'getLicenseId',
        'license_url' => 'getLicenseUrl',
        'moderation_message' => 'getModerationMessage',
        'moderation_message_body' => 'getModerationMessageBody'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    public const CLIENT_SIDE_REQUIRED = 'required';
    public const CLIENT_SIDE_OPTIONAL = 'optional';
    public const CLIENT_SIDE_UNSUPPORTED = 'unsupported';
    public const SERVER_SIDE_REQUIRED = 'required';
    public const SERVER_SIDE_OPTIONAL = 'optional';
    public const SERVER_SIDE_UNSUPPORTED = 'unsupported';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_ARCHIVED = 'archived';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_UNLISTED = 'unlisted';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_WITHHELD = 'withheld';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS__PRIVATE = 'private';
    public const STATUS_UNKNOWN = 'unknown';
    public const REQUESTED_STATUS_APPROVED = 'approved';
    public const REQUESTED_STATUS_ARCHIVED = 'archived';
    public const REQUESTED_STATUS_UNLISTED = 'unlisted';
    public const REQUESTED_STATUS__PRIVATE = 'private';
    public const REQUESTED_STATUS_DRAFT = 'draft';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getClientSideAllowableValues()
    {
        return [
            self::CLIENT_SIDE_REQUIRED,
            self::CLIENT_SIDE_OPTIONAL,
            self::CLIENT_SIDE_UNSUPPORTED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getServerSideAllowableValues()
    {
        return [
            self::SERVER_SIDE_REQUIRED,
            self::SERVER_SIDE_OPTIONAL,
            self::SERVER_SIDE_UNSUPPORTED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_APPROVED,
            self::STATUS_ARCHIVED,
            self::STATUS_REJECTED,
            self::STATUS_DRAFT,
            self::STATUS_UNLISTED,
            self::STATUS_PROCESSING,
            self::STATUS_WITHHELD,
            self::STATUS_SCHEDULED,
            self::STATUS__PRIVATE,
            self::STATUS_UNKNOWN,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getRequestedStatusAllowableValues()
    {
        return [
            self::REQUESTED_STATUS_APPROVED,
            self::REQUESTED_STATUS_ARCHIVED,
            self::REQUESTED_STATUS_UNLISTED,
            self::REQUESTED_STATUS__PRIVATE,
            self::REQUESTED_STATUS_DRAFT,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('slug', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('categories', $data ?? [], null);
        $this->setIfExists('client_side', $data ?? [], null);
        $this->setIfExists('server_side', $data ?? [], null);
        $this->setIfExists('body', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('requested_status', $data ?? [], null);
        $this->setIfExists('additional_categories', $data ?? [], null);
        $this->setIfExists('issues_url', $data ?? [], null);
        $this->setIfExists('source_url', $data ?? [], null);
        $this->setIfExists('wiki_url', $data ?? [], null);
        $this->setIfExists('discord_url', $data ?? [], null);
        $this->setIfExists('donation_urls', $data ?? [], null);
        $this->setIfExists('license_id', $data ?? [], null);
        $this->setIfExists('license_url', $data ?? [], null);
        $this->setIfExists('moderation_message', $data ?? [], null);
        $this->setIfExists('moderation_message_body', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getClientSideAllowableValues();
        if (!is_null($this->container['client_side']) && !in_array($this->container['client_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'client_side', must be one of '%s'",
                $this->container['client_side'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getServerSideAllowableValues();
        if (!is_null($this->container['server_side']) && !in_array($this->container['server_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'server_side', must be one of '%s'",
                $this->container['server_side'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getRequestedStatusAllowableValues();
        if (!is_null($this->container['requested_status']) && !in_array($this->container['requested_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'requested_status', must be one of '%s'",
                $this->container['requested_status'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets slug
     *
     * @return string|null
     */
    public function getSlug()
    {
        return $this->container['slug'];
    }

    /**
     * Sets slug
     *
     * @param string|null $slug The slug of a project, used for vanity URLs. Regex: ```^[\\w!@$()`.+,\"\\-']{3,64}$```
     *
     * @return self
     */
    public function setSlug($slug)
    {
        if (is_null($slug)) {
            throw new \InvalidArgumentException('non-nullable slug cannot be null');
        }
        $this->container['slug'] = $slug;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title The title or name of the project
     *
     * @return self
     */
    public function setTitle($title)
    {
        if (is_null($title)) {
            throw new \InvalidArgumentException('non-nullable title cannot be null');
        }
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description A short description of the project
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets categories
     *
     * @return string[]|null
     */
    public function getCategories()
    {
        return $this->container['categories'];
    }

    /**
     * Sets categories
     *
     * @param string[]|null $categories A list of the categories that the project has
     *
     * @return self
     */
    public function setCategories($categories)
    {
        if (is_null($categories)) {
            throw new \InvalidArgumentException('non-nullable categories cannot be null');
        }
        $this->container['categories'] = $categories;

        return $this;
    }

    /**
     * Gets client_side
     *
     * @return string|null
     */
    public function getClientSide()
    {
        return $this->container['client_side'];
    }

    /**
     * Sets client_side
     *
     * @param string|null $client_side The client side support of the project
     *
     * @return self
     */
    public function setClientSide($client_side)
    {
        if (is_null($client_side)) {
            throw new \InvalidArgumentException('non-nullable client_side cannot be null');
        }
        $allowedValues = $this->getClientSideAllowableValues();
        if (!in_array($client_side, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'client_side', must be one of '%s'",
                    $client_side,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['client_side'] = $client_side;

        return $this;
    }

    /**
     * Gets server_side
     *
     * @return string|null
     */
    public function getServerSide()
    {
        return $this->container['server_side'];
    }

    /**
     * Sets server_side
     *
     * @param string|null $server_side The server side support of the project
     *
     * @return self
     */
    public function setServerSide($server_side)
    {
        if (is_null($server_side)) {
            throw new \InvalidArgumentException('non-nullable server_side cannot be null');
        }
        $allowedValues = $this->getServerSideAllowableValues();
        if (!in_array($server_side, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'server_side', must be one of '%s'",
                    $server_side,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['server_side'] = $server_side;

        return $this;
    }

    /**
     * Gets body
     *
     * @return string|null
     */
    public function getBody()
    {
        return $this->container['body'];
    }

    /**
     * Sets body
     *
     * @param string|null $body A long form description of the project
     *
     * @return self
     */
    public function setBody($body)
    {
        if (is_null($body)) {
            throw new \InvalidArgumentException('non-nullable body cannot be null');
        }
        $this->container['body'] = $body;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status The status of the project
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets requested_status
     *
     * @return string|null
     */
    public function getRequestedStatus()
    {
        return $this->container['requested_status'];
    }

    /**
     * Sets requested_status
     *
     * @param string|null $requested_status The requested status when submitting for review or scheduling the project for release
     *
     * @return self
     */
    public function setRequestedStatus($requested_status)
    {
        if (is_null($requested_status)) {
            array_push($this->openAPINullablesSetToNull, 'requested_status');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('requested_status', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $allowedValues = $this->getRequestedStatusAllowableValues();
        if (!is_null($requested_status) && !in_array($requested_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'requested_status', must be one of '%s'",
                    $requested_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['requested_status'] = $requested_status;

        return $this;
    }

    /**
     * Gets additional_categories
     *
     * @return string[]|null
     */
    public function getAdditionalCategories()
    {
        return $this->container['additional_categories'];
    }

    /**
     * Sets additional_categories
     *
     * @param string[]|null $additional_categories A list of categories which are searchable but non-primary
     *
     * @return self
     */
    public function setAdditionalCategories($additional_categories)
    {
        if (is_null($additional_categories)) {
            throw new \InvalidArgumentException('non-nullable additional_categories cannot be null');
        }
        $this->container['additional_categories'] = $additional_categories;

        return $this;
    }

    /**
     * Gets issues_url
     *
     * @return string|null
     */
    public function getIssuesUrl()
    {
        return $this->container['issues_url'];
    }

    /**
     * Sets issues_url
     *
     * @param string|null $issues_url An optional link to where to submit bugs or issues with the project
     *
     * @return self
     */
    public function setIssuesUrl($issues_url)
    {
        if (is_null($issues_url)) {
            array_push($this->openAPINullablesSetToNull, 'issues_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('issues_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['issues_url'] = $issues_url;

        return $this;
    }

    /**
     * Gets source_url
     *
     * @return string|null
     */
    public function getSourceUrl()
    {
        return $this->container['source_url'];
    }

    /**
     * Sets source_url
     *
     * @param string|null $source_url An optional link to the source code of the project
     *
     * @return self
     */
    public function setSourceUrl($source_url)
    {
        if (is_null($source_url)) {
            array_push($this->openAPINullablesSetToNull, 'source_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('source_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['source_url'] = $source_url;

        return $this;
    }

    /**
     * Gets wiki_url
     *
     * @return string|null
     */
    public function getWikiUrl()
    {
        return $this->container['wiki_url'];
    }

    /**
     * Sets wiki_url
     *
     * @param string|null $wiki_url An optional link to the project's wiki page or other relevant information
     *
     * @return self
     */
    public function setWikiUrl($wiki_url)
    {
        if (is_null($wiki_url)) {
            array_push($this->openAPINullablesSetToNull, 'wiki_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('wiki_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['wiki_url'] = $wiki_url;

        return $this;
    }

    /**
     * Gets discord_url
     *
     * @return string|null
     */
    public function getDiscordUrl()
    {
        return $this->container['discord_url'];
    }

    /**
     * Sets discord_url
     *
     * @param string|null $discord_url An optional invite link to the project's discord
     *
     * @return self
     */
    public function setDiscordUrl($discord_url)
    {
        if (is_null($discord_url)) {
            array_push($this->openAPINullablesSetToNull, 'discord_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('discord_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['discord_url'] = $discord_url;

        return $this;
    }

    /**
     * Gets donation_urls
     *
     * @return \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null
     */
    public function getDonationUrls()
    {
        return $this->container['donation_urls'];
    }

    /**
     * Sets donation_urls
     *
     * @param \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null $donation_urls A list of donation links for the project
     *
     * @return self
     */
    public function setDonationUrls($donation_urls)
    {
        if (is_null($donation_urls)) {
            throw new \InvalidArgumentException('non-nullable donation_urls cannot be null');
        }
        $this->container['donation_urls'] = $donation_urls;

        return $this;
    }

    /**
     * Gets license_id
     *
     * @return string|null
     */
    public function getLicenseId()
    {
        return $this->container['license_id'];
    }

    /**
     * Sets license_id
     *
     * @param string|null $license_id The SPDX license ID of a project
     *
     * @return self
     */
    public function setLicenseId($license_id)
    {
        if (is_null($license_id)) {
            throw new \InvalidArgumentException('non-nullable license_id cannot be null');
        }
        $this->container['license_id'] = $license_id;

        return $this;
    }

    /**
     * Gets license_url
     *
     * @return string|null
     */
    public function getLicenseUrl()
    {
        return $this->container['license_url'];
    }

    /**
     * Sets license_url
     *
     * @param string|null $license_url The URL to this license
     *
     * @return self
     */
    public function setLicenseUrl($license_url)
    {
        if (is_null($license_url)) {
            array_push($this->openAPINullablesSetToNull, 'license_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('license_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['license_url'] = $license_url;

        return $this;
    }

    /**
     * Gets moderation_message
     *
     * @return string|null
     */
    public function getModerationMessage()
    {
        return $this->container['moderation_message'];
    }

    /**
     * Sets moderation_message
     *
     * @param string|null $moderation_message The title of the moderators' message for the project
     *
     * @return self
     */
    public function setModerationMessage($moderation_message)
    {
        if (is_null($moderation_message)) {
            array_push($this->openAPINullablesSetToNull, 'moderation_message');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('moderation_message', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['moderation_message'] = $moderation_message;

        return $this;
    }

    /**
     * Gets moderation_message_body
     *
     * @return string|null
     */
    public function getModerationMessageBody()
    {
        return $this->container['moderation_message_body'];
    }

    /**
     * Sets moderation_message_body
     *
     * @param string|null $moderation_message_body The body of the moderators' message for the project
     *
     * @return self
     */
    public function setModerationMessageBody($moderation_message_body)
    {
        if (is_null($moderation_message_body)) {
            array_push($this->openAPINullablesSetToNull, 'moderation_message_body');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('moderation_message_body', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['moderation_message_body'] = $moderation_message_body;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


