<?php
/**
 * ProjectResultAllOf
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
 * ProjectResultAllOf Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProjectResultAllOf implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ProjectResult_allOf';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'project_id' => 'string',
        'author' => 'string',
        'display_categories' => 'string[]',
        'versions' => 'string[]',
        'follows' => 'int',
        'date_created' => 'string',
        'date_modified' => 'string',
        'latest_version' => 'string',
        'license' => 'string',
        'gallery' => 'string[]',
        'featured_gallery' => 'string',
        'dependencies' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'project_id' => null,
        'author' => null,
        'display_categories' => null,
        'versions' => null,
        'follows' => null,
        'date_created' => 'ISO-8601',
        'date_modified' => 'ISO-8601',
        'latest_version' => null,
        'license' => null,
        'gallery' => null,
        'featured_gallery' => null,
        'dependencies' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'project_id' => false,
		'author' => false,
		'display_categories' => false,
		'versions' => false,
		'follows' => false,
		'date_created' => false,
		'date_modified' => false,
		'latest_version' => false,
		'license' => false,
		'gallery' => false,
		'featured_gallery' => true,
		'dependencies' => false
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
        'project_id' => 'project_id',
        'author' => 'author',
        'display_categories' => 'display_categories',
        'versions' => 'versions',
        'follows' => 'follows',
        'date_created' => 'date_created',
        'date_modified' => 'date_modified',
        'latest_version' => 'latest_version',
        'license' => 'license',
        'gallery' => 'gallery',
        'featured_gallery' => 'featured_gallery',
        'dependencies' => 'dependencies'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'project_id' => 'setProjectId',
        'author' => 'setAuthor',
        'display_categories' => 'setDisplayCategories',
        'versions' => 'setVersions',
        'follows' => 'setFollows',
        'date_created' => 'setDateCreated',
        'date_modified' => 'setDateModified',
        'latest_version' => 'setLatestVersion',
        'license' => 'setLicense',
        'gallery' => 'setGallery',
        'featured_gallery' => 'setFeaturedGallery',
        'dependencies' => 'setDependencies'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'project_id' => 'getProjectId',
        'author' => 'getAuthor',
        'display_categories' => 'getDisplayCategories',
        'versions' => 'getVersions',
        'follows' => 'getFollows',
        'date_created' => 'getDateCreated',
        'date_modified' => 'getDateModified',
        'latest_version' => 'getLatestVersion',
        'license' => 'getLicense',
        'gallery' => 'getGallery',
        'featured_gallery' => 'getFeaturedGallery',
        'dependencies' => 'getDependencies'
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
        $this->setIfExists('project_id', $data ?? [], null);
        $this->setIfExists('author', $data ?? [], null);
        $this->setIfExists('display_categories', $data ?? [], null);
        $this->setIfExists('versions', $data ?? [], null);
        $this->setIfExists('follows', $data ?? [], null);
        $this->setIfExists('date_created', $data ?? [], null);
        $this->setIfExists('date_modified', $data ?? [], null);
        $this->setIfExists('latest_version', $data ?? [], null);
        $this->setIfExists('license', $data ?? [], null);
        $this->setIfExists('gallery', $data ?? [], null);
        $this->setIfExists('featured_gallery', $data ?? [], null);
        $this->setIfExists('dependencies', $data ?? [], null);
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

        if ($this->container['project_id'] === null) {
            $invalidProperties[] = "'project_id' can't be null";
        }
        if ($this->container['author'] === null) {
            $invalidProperties[] = "'author' can't be null";
        }
        if ($this->container['versions'] === null) {
            $invalidProperties[] = "'versions' can't be null";
        }
        if ($this->container['follows'] === null) {
            $invalidProperties[] = "'follows' can't be null";
        }
        if ($this->container['date_created'] === null) {
            $invalidProperties[] = "'date_created' can't be null";
        }
        if ($this->container['date_modified'] === null) {
            $invalidProperties[] = "'date_modified' can't be null";
        }
        if ($this->container['license'] === null) {
            $invalidProperties[] = "'license' can't be null";
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
     * @param string $project_id The ID of the project
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
     * Gets author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->container['author'];
    }

    /**
     * Sets author
     *
     * @param string $author The username of the project's author
     *
     * @return self
     */
    public function setAuthor($author)
    {
        if (is_null($author)) {
            throw new \InvalidArgumentException('non-nullable author cannot be null');
        }
        $this->container['author'] = $author;

        return $this;
    }

    /**
     * Gets display_categories
     *
     * @return string[]|null
     */
    public function getDisplayCategories()
    {
        return $this->container['display_categories'];
    }

    /**
     * Sets display_categories
     *
     * @param string[]|null $display_categories A list of the categories that the project has which are not secondary
     *
     * @return self
     */
    public function setDisplayCategories($display_categories)
    {
        if (is_null($display_categories)) {
            throw new \InvalidArgumentException('non-nullable display_categories cannot be null');
        }
        $this->container['display_categories'] = $display_categories;

        return $this;
    }

    /**
     * Gets versions
     *
     * @return string[]
     */
    public function getVersions()
    {
        return $this->container['versions'];
    }

    /**
     * Sets versions
     *
     * @param string[] $versions A list of the minecraft versions supported by the project
     *
     * @return self
     */
    public function setVersions($versions)
    {
        if (is_null($versions)) {
            throw new \InvalidArgumentException('non-nullable versions cannot be null');
        }
        $this->container['versions'] = $versions;

        return $this;
    }

    /**
     * Gets follows
     *
     * @return int
     */
    public function getFollows()
    {
        return $this->container['follows'];
    }

    /**
     * Sets follows
     *
     * @param int $follows The total number of users following the project
     *
     * @return self
     */
    public function setFollows($follows)
    {
        if (is_null($follows)) {
            throw new \InvalidArgumentException('non-nullable follows cannot be null');
        }
        $this->container['follows'] = $follows;

        return $this;
    }

    /**
     * Gets date_created
     *
     * @return string
     */
    public function getDateCreated()
    {
        return $this->container['date_created'];
    }

    /**
     * Sets date_created
     *
     * @param string $date_created The date the project was added to search
     *
     * @return self
     */
    public function setDateCreated($date_created)
    {
        if (is_null($date_created)) {
            throw new \InvalidArgumentException('non-nullable date_created cannot be null');
        }
        $this->container['date_created'] = $date_created;

        return $this;
    }

    /**
     * Gets date_modified
     *
     * @return string
     */
    public function getDateModified()
    {
        return $this->container['date_modified'];
    }

    /**
     * Sets date_modified
     *
     * @param string $date_modified The date the project was last modified
     *
     * @return self
     */
    public function setDateModified($date_modified)
    {
        if (is_null($date_modified)) {
            throw new \InvalidArgumentException('non-nullable date_modified cannot be null');
        }
        $this->container['date_modified'] = $date_modified;

        return $this;
    }

    /**
     * Gets latest_version
     *
     * @return string|null
     */
    public function getLatestVersion()
    {
        return $this->container['latest_version'];
    }

    /**
     * Sets latest_version
     *
     * @param string|null $latest_version The latest version of minecraft that this project supports
     *
     * @return self
     */
    public function setLatestVersion($latest_version)
    {
        if (is_null($latest_version)) {
            throw new \InvalidArgumentException('non-nullable latest_version cannot be null');
        }
        $this->container['latest_version'] = $latest_version;

        return $this;
    }

    /**
     * Gets license
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->container['license'];
    }

    /**
     * Sets license
     *
     * @param string $license The SPDX license ID of a project
     *
     * @return self
     */
    public function setLicense($license)
    {
        if (is_null($license)) {
            throw new \InvalidArgumentException('non-nullable license cannot be null');
        }
        $this->container['license'] = $license;

        return $this;
    }

    /**
     * Gets gallery
     *
     * @return string[]|null
     */
    public function getGallery()
    {
        return $this->container['gallery'];
    }

    /**
     * Sets gallery
     *
     * @param string[]|null $gallery All gallery images attached to the project
     *
     * @return self
     */
    public function setGallery($gallery)
    {
        if (is_null($gallery)) {
            throw new \InvalidArgumentException('non-nullable gallery cannot be null');
        }
        $this->container['gallery'] = $gallery;

        return $this;
    }

    /**
     * Gets featured_gallery
     *
     * @return string|null
     */
    public function getFeaturedGallery()
    {
        return $this->container['featured_gallery'];
    }

    /**
     * Sets featured_gallery
     *
     * @param string|null $featured_gallery The featured gallery image of the project
     *
     * @return self
     */
    public function setFeaturedGallery($featured_gallery)
    {
        if (is_null($featured_gallery)) {
            array_push($this->openAPINullablesSetToNull, 'featured_gallery');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('featured_gallery', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['featured_gallery'] = $featured_gallery;

        return $this;
    }

    /**
     * Gets dependencies
     *
     * @return string[]|null
     */
    public function getDependencies()
    {
        return $this->container['dependencies'];
    }

    /**
     * Sets dependencies
     *
     * @param string[]|null $dependencies A list of this project's dependencies, in the format of `{project_id}-{dep_type}`
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


