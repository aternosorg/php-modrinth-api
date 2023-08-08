<?php
/**
 * Version
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
 * Version Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Version implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Version';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'name' => 'string',
        'version_number' => 'string',
        'changelog' => 'string',
        'dependencies' => '\Aternos\ModrinthApi\Model\VersionDependency[]',
        'game_versions' => 'string[]',
        'version_type' => 'string',
        'loaders' => 'string[]',
        'featured' => 'bool',
        'status' => 'string',
        'requested_status' => 'string',
        'id' => 'string',
        'project_id' => 'string',
        'author_id' => 'string',
        'date_published' => 'string',
        'downloads' => 'int',
        'changelog_url' => 'string',
        'files' => '\Aternos\ModrinthApi\Model\VersionFile[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'name' => null,
        'version_number' => null,
        'changelog' => null,
        'dependencies' => null,
        'game_versions' => null,
        'version_type' => null,
        'loaders' => null,
        'featured' => null,
        'status' => null,
        'requested_status' => null,
        'id' => null,
        'project_id' => null,
        'author_id' => null,
        'date_published' => 'ISO-8601',
        'downloads' => null,
        'changelog_url' => null,
        'files' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'name' => false,
		'version_number' => false,
		'changelog' => true,
		'dependencies' => false,
		'game_versions' => false,
		'version_type' => false,
		'loaders' => false,
		'featured' => false,
		'status' => false,
		'requested_status' => true,
		'id' => false,
		'project_id' => false,
		'author_id' => false,
		'date_published' => false,
		'downloads' => false,
		'changelog_url' => true,
		'files' => false
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
        'name' => 'name',
        'version_number' => 'version_number',
        'changelog' => 'changelog',
        'dependencies' => 'dependencies',
        'game_versions' => 'game_versions',
        'version_type' => 'version_type',
        'loaders' => 'loaders',
        'featured' => 'featured',
        'status' => 'status',
        'requested_status' => 'requested_status',
        'id' => 'id',
        'project_id' => 'project_id',
        'author_id' => 'author_id',
        'date_published' => 'date_published',
        'downloads' => 'downloads',
        'changelog_url' => 'changelog_url',
        'files' => 'files'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'version_number' => 'setVersionNumber',
        'changelog' => 'setChangelog',
        'dependencies' => 'setDependencies',
        'game_versions' => 'setGameVersions',
        'version_type' => 'setVersionType',
        'loaders' => 'setLoaders',
        'featured' => 'setFeatured',
        'status' => 'setStatus',
        'requested_status' => 'setRequestedStatus',
        'id' => 'setId',
        'project_id' => 'setProjectId',
        'author_id' => 'setAuthorId',
        'date_published' => 'setDatePublished',
        'downloads' => 'setDownloads',
        'changelog_url' => 'setChangelogUrl',
        'files' => 'setFiles'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'version_number' => 'getVersionNumber',
        'changelog' => 'getChangelog',
        'dependencies' => 'getDependencies',
        'game_versions' => 'getGameVersions',
        'version_type' => 'getVersionType',
        'loaders' => 'getLoaders',
        'featured' => 'getFeatured',
        'status' => 'getStatus',
        'requested_status' => 'getRequestedStatus',
        'id' => 'getId',
        'project_id' => 'getProjectId',
        'author_id' => 'getAuthorId',
        'date_published' => 'getDatePublished',
        'downloads' => 'getDownloads',
        'changelog_url' => 'getChangelogUrl',
        'files' => 'getFiles'
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

    public const VERSION_TYPE_RELEASE = 'release';
    public const VERSION_TYPE_BETA = 'beta';
    public const VERSION_TYPE_ALPHA = 'alpha';
    public const STATUS_LISTED = 'listed';
    public const STATUS_ARCHIVED = 'archived';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_UNLISTED = 'unlisted';
    public const STATUS_SCHEDULED = 'scheduled';
    public const STATUS_UNKNOWN = 'unknown';
    public const REQUESTED_STATUS_LISTED = 'listed';
    public const REQUESTED_STATUS_ARCHIVED = 'archived';
    public const REQUESTED_STATUS_DRAFT = 'draft';
    public const REQUESTED_STATUS_UNLISTED = 'unlisted';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVersionTypeAllowableValues()
    {
        return [
            self::VERSION_TYPE_RELEASE,
            self::VERSION_TYPE_BETA,
            self::VERSION_TYPE_ALPHA,
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
            self::STATUS_LISTED,
            self::STATUS_ARCHIVED,
            self::STATUS_DRAFT,
            self::STATUS_UNLISTED,
            self::STATUS_SCHEDULED,
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
            self::REQUESTED_STATUS_LISTED,
            self::REQUESTED_STATUS_ARCHIVED,
            self::REQUESTED_STATUS_DRAFT,
            self::REQUESTED_STATUS_UNLISTED,
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('version_number', $data ?? [], null);
        $this->setIfExists('changelog', $data ?? [], null);
        $this->setIfExists('dependencies', $data ?? [], null);
        $this->setIfExists('game_versions', $data ?? [], null);
        $this->setIfExists('version_type', $data ?? [], null);
        $this->setIfExists('loaders', $data ?? [], null);
        $this->setIfExists('featured', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('requested_status', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('project_id', $data ?? [], null);
        $this->setIfExists('author_id', $data ?? [], null);
        $this->setIfExists('date_published', $data ?? [], null);
        $this->setIfExists('downloads', $data ?? [], null);
        $this->setIfExists('changelog_url', $data ?? [], null);
        $this->setIfExists('files', $data ?? [], null);
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

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['version_number'] === null) {
            $invalidProperties[] = "'version_number' can't be null";
        }
        if ($this->container['game_versions'] === null) {
            $invalidProperties[] = "'game_versions' can't be null";
        }
        if ($this->container['version_type'] === null) {
            $invalidProperties[] = "'version_type' can't be null";
        }
        $allowedValues = $this->getVersionTypeAllowableValues();
        if (!is_null($this->container['version_type']) && !in_array($this->container['version_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'version_type', must be one of '%s'",
                $this->container['version_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['loaders'] === null) {
            $invalidProperties[] = "'loaders' can't be null";
        }
        if ($this->container['featured'] === null) {
            $invalidProperties[] = "'featured' can't be null";
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['project_id'] === null) {
            $invalidProperties[] = "'project_id' can't be null";
        }
        if ($this->container['author_id'] === null) {
            $invalidProperties[] = "'author_id' can't be null";
        }
        if ($this->container['date_published'] === null) {
            $invalidProperties[] = "'date_published' can't be null";
        }
        if ($this->container['downloads'] === null) {
            $invalidProperties[] = "'downloads' can't be null";
        }
        if ($this->container['files'] === null) {
            $invalidProperties[] = "'files' can't be null";
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name The name of this version
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets version_number
     *
     * @return string
     */
    public function getVersionNumber()
    {
        return $this->container['version_number'];
    }

    /**
     * Sets version_number
     *
     * @param string $version_number The version number. Ideally will follow semantic versioning
     *
     * @return self
     */
    public function setVersionNumber($version_number)
    {
        if (is_null($version_number)) {
            throw new \InvalidArgumentException('non-nullable version_number cannot be null');
        }
        $this->container['version_number'] = $version_number;

        return $this;
    }

    /**
     * Gets changelog
     *
     * @return string|null
     */
    public function getChangelog()
    {
        return $this->container['changelog'];
    }

    /**
     * Sets changelog
     *
     * @param string|null $changelog The changelog for this version
     *
     * @return self
     */
    public function setChangelog($changelog)
    {
        if (is_null($changelog)) {
            array_push($this->openAPINullablesSetToNull, 'changelog');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('changelog', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['changelog'] = $changelog;

        return $this;
    }

    /**
     * Gets dependencies
     *
     * @return \Aternos\ModrinthApi\Model\VersionDependency[]|null
     */
    public function getDependencies()
    {
        return $this->container['dependencies'];
    }

    /**
     * Sets dependencies
     *
     * @param \Aternos\ModrinthApi\Model\VersionDependency[]|null $dependencies A list of specific versions of projects that this version depends on
     *
     * @return self
     */
    public function setDependencies($dependencies)
    {
        if (is_null($dependencies)) {
            throw new \InvalidArgumentException('non-nullable dependencies cannot be null');
        }
        $this->container['dependencies'] = $dependencies;

        return $this;
    }

    /**
     * Gets game_versions
     *
     * @return string[]
     */
    public function getGameVersions()
    {
        return $this->container['game_versions'];
    }

    /**
     * Sets game_versions
     *
     * @param string[] $game_versions A list of versions of Minecraft that this version supports
     *
     * @return self
     */
    public function setGameVersions($game_versions)
    {
        if (is_null($game_versions)) {
            throw new \InvalidArgumentException('non-nullable game_versions cannot be null');
        }
        $this->container['game_versions'] = $game_versions;

        return $this;
    }

    /**
     * Gets version_type
     *
     * @return string
     */
    public function getVersionType()
    {
        return $this->container['version_type'];
    }

    /**
     * Sets version_type
     *
     * @param string $version_type The release channel for this version
     *
     * @return self
     */
    public function setVersionType($version_type)
    {
        if (is_null($version_type)) {
            throw new \InvalidArgumentException('non-nullable version_type cannot be null');
        }
        $allowedValues = $this->getVersionTypeAllowableValues();
        if (!in_array($version_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'version_type', must be one of '%s'",
                    $version_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['version_type'] = $version_type;

        return $this;
    }

    /**
     * Gets loaders
     *
     * @return string[]
     */
    public function getLoaders()
    {
        return $this->container['loaders'];
    }

    /**
     * Sets loaders
     *
     * @param string[] $loaders The mod loaders that this version supports
     *
     * @return self
     */
    public function setLoaders($loaders)
    {
        if (is_null($loaders)) {
            throw new \InvalidArgumentException('non-nullable loaders cannot be null');
        }
        $this->container['loaders'] = $loaders;

        return $this;
    }

    /**
     * Gets featured
     *
     * @return bool
     */
    public function getFeatured()
    {
        return $this->container['featured'];
    }

    /**
     * Sets featured
     *
     * @param bool $featured Whether the version is featured or not
     *
     * @return self
     */
    public function setFeatured($featured)
    {
        if (is_null($featured)) {
            throw new \InvalidArgumentException('non-nullable featured cannot be null');
        }
        $this->container['featured'] = $featured;

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
     * @param string|null $status status
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
     * @param string|null $requested_status requested_status
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
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id The ID of the version, encoded as a base62 string
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets project_id
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->container['project_id'];
    }

    /**
     * Sets project_id
     *
     * @param string $project_id The ID of the project this version is for
     *
     * @return self
     */
    public function setProjectId($project_id)
    {
        if (is_null($project_id)) {
            throw new \InvalidArgumentException('non-nullable project_id cannot be null');
        }
        $this->container['project_id'] = $project_id;

        return $this;
    }

    /**
     * Gets author_id
     *
     * @return string
     */
    public function getAuthorId()
    {
        return $this->container['author_id'];
    }

    /**
     * Sets author_id
     *
     * @param string $author_id The ID of the author who published this version
     *
     * @return self
     */
    public function setAuthorId($author_id)
    {
        if (is_null($author_id)) {
            throw new \InvalidArgumentException('non-nullable author_id cannot be null');
        }
        $this->container['author_id'] = $author_id;

        return $this;
    }

    /**
     * Gets date_published
     *
     * @return string
     */
    public function getDatePublished()
    {
        return $this->container['date_published'];
    }

    /**
     * Sets date_published
     *
     * @param string $date_published date_published
     *
     * @return self
     */
    public function setDatePublished($date_published)
    {
        if (is_null($date_published)) {
            throw new \InvalidArgumentException('non-nullable date_published cannot be null');
        }
        $this->container['date_published'] = $date_published;

        return $this;
    }

    /**
     * Gets downloads
     *
     * @return int
     */
    public function getDownloads()
    {
        return $this->container['downloads'];
    }

    /**
     * Sets downloads
     *
     * @param int $downloads The number of times this version has been downloaded
     *
     * @return self
     */
    public function setDownloads($downloads)
    {
        if (is_null($downloads)) {
            throw new \InvalidArgumentException('non-nullable downloads cannot be null');
        }
        $this->container['downloads'] = $downloads;

        return $this;
    }

    /**
     * Gets changelog_url
     *
     * @return string|null
     * @deprecated
     */
    public function getChangelogUrl()
    {
        return $this->container['changelog_url'];
    }

    /**
     * Sets changelog_url
     *
     * @param string|null $changelog_url A link to the changelog for this version. Always null, only kept for legacy compatibility.
     *
     * @return self
     * @deprecated
     */
    public function setChangelogUrl($changelog_url)
    {
        if (is_null($changelog_url)) {
            array_push($this->openAPINullablesSetToNull, 'changelog_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('changelog_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['changelog_url'] = $changelog_url;

        return $this;
    }

    /**
     * Gets files
     *
     * @return \Aternos\ModrinthApi\Model\VersionFile[]
     */
    public function getFiles()
    {
        return $this->container['files'];
    }

    /**
     * Sets files
     *
     * @param \Aternos\ModrinthApi\Model\VersionFile[] $files A list of files available for download for this version
     *
     * @return self
     */
    public function setFiles($files)
    {
        if (is_null($files)) {
            throw new \InvalidArgumentException('non-nullable files cannot be null');
        }
        $this->container['files'] = $files;

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


