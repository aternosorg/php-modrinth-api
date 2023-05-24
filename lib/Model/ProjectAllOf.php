<?php
/**
 * ProjectAllOf
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
 * **Remember to join our [Discord](https://discord.gg/EUHuJHt) if you need any support!**  ## Authentication This API uses GitHub tokens for authentication. The token is in the `Authorization` header of the request.  Example: ``` Authorization: gho_pJ9dGXVKpfzZp4PUHSxYEq9hjk0h288Gwj4S ```  You do not need a token for most requests. Generally speaking, only the following types of requests require a token: - those which create data (such as version creation) - those which modify data (such as editing a project) - those which access private data (such as draft projects and notifications)  Applications interacting with the authenticated API should either retrieve the Modrinth GitHub token through the site or create a personal app token for use with Modrinth. The API provides a couple routes for auth -- don't implement this flow in your application! Instead, use a personal access token or create your own GitHub OAuth2 application. This system will be revisited and allow easier interaction with the authenticated subset of the API once we roll out our own authentication system.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/). This allows for cross-domain communication from the browser. All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.  ## Ratelimits The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers. - `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute - `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window - `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets  Ratelimits are the same no matter whether you use a token or not. The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:admin@modrinth.com).  ## User Agents To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header. Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic. It is recommended, but not required, to include contact information in your user agent. This allows us to contact you if we would like a change in your application's behavior without having to block your traffic. - Bad: `User-Agent: okhttp/4.9.3` - Good: `User-Agent: project_name` - Better: `User-Agent: github_username/project_name/1.56.0` - Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`
 *
 * The version of the OpenAPI document: v2.7.0/3b22f59
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
 * ProjectAllOf Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ProjectAllOf implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Project_allOf';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'id' => 'string',
        'team' => 'string',
        'body_url' => 'string',
        'moderator_message' => '\Aternos\ModrinthApi\Model\ProjectAllOfModeratorMessage',
        'published' => 'string',
        'updated' => 'string',
        'approved' => 'string',
        'followers' => 'int',
        'status' => 'string',
        'license' => '\Aternos\ModrinthApi\Model\ProjectAllOfLicense',
        'versions' => 'string[]',
        'game_versions' => 'string[]',
        'loaders' => 'string[]',
        'gallery' => '\Aternos\ModrinthApi\Model\ProjectAllOfGallery[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'id' => null,
        'team' => null,
        'body_url' => null,
        'moderator_message' => null,
        'published' => 'ISO-8601',
        'updated' => 'ISO-8601',
        'approved' => 'ISO-8601',
        'followers' => null,
        'status' => null,
        'license' => null,
        'versions' => null,
        'game_versions' => null,
        'loaders' => null,
        'gallery' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'id' => false,
		'team' => false,
		'body_url' => true,
		'moderator_message' => true,
		'published' => false,
		'updated' => false,
		'approved' => true,
		'followers' => false,
		'status' => false,
		'license' => false,
		'versions' => false,
		'game_versions' => false,
		'loaders' => false,
		'gallery' => false
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
        'id' => 'id',
        'team' => 'team',
        'body_url' => 'body_url',
        'moderator_message' => 'moderator_message',
        'published' => 'published',
        'updated' => 'updated',
        'approved' => 'approved',
        'followers' => 'followers',
        'status' => 'status',
        'license' => 'license',
        'versions' => 'versions',
        'game_versions' => 'game_versions',
        'loaders' => 'loaders',
        'gallery' => 'gallery'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'team' => 'setTeam',
        'body_url' => 'setBodyUrl',
        'moderator_message' => 'setModeratorMessage',
        'published' => 'setPublished',
        'updated' => 'setUpdated',
        'approved' => 'setApproved',
        'followers' => 'setFollowers',
        'status' => 'setStatus',
        'license' => 'setLicense',
        'versions' => 'setVersions',
        'game_versions' => 'setGameVersions',
        'loaders' => 'setLoaders',
        'gallery' => 'setGallery'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'team' => 'getTeam',
        'body_url' => 'getBodyUrl',
        'moderator_message' => 'getModeratorMessage',
        'published' => 'getPublished',
        'updated' => 'getUpdated',
        'approved' => 'getApproved',
        'followers' => 'getFollowers',
        'status' => 'getStatus',
        'license' => 'getLicense',
        'versions' => 'getVersions',
        'game_versions' => 'getGameVersions',
        'loaders' => 'getLoaders',
        'gallery' => 'getGallery'
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

    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_UNLISTED = 'unlisted';
    public const STATUS_ARCHIVED = 'archived';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_UNKNOWN = 'unknown';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
            self::STATUS_DRAFT,
            self::STATUS_UNLISTED,
            self::STATUS_ARCHIVED,
            self::STATUS_PROCESSING,
            self::STATUS_UNKNOWN,
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
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('team', $data ?? [], null);
        $this->setIfExists('body_url', $data ?? [], null);
        $this->setIfExists('moderator_message', $data ?? [], null);
        $this->setIfExists('published', $data ?? [], null);
        $this->setIfExists('updated', $data ?? [], null);
        $this->setIfExists('approved', $data ?? [], null);
        $this->setIfExists('followers', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('license', $data ?? [], null);
        $this->setIfExists('versions', $data ?? [], null);
        $this->setIfExists('game_versions', $data ?? [], null);
        $this->setIfExists('loaders', $data ?? [], null);
        $this->setIfExists('gallery', $data ?? [], null);
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

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['team'] === null) {
            $invalidProperties[] = "'team' can't be null";
        }
        if ($this->container['published'] === null) {
            $invalidProperties[] = "'published' can't be null";
        }
        if ($this->container['updated'] === null) {
            $invalidProperties[] = "'updated' can't be null";
        }
        if ($this->container['followers'] === null) {
            $invalidProperties[] = "'followers' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
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
     * @param string $id The ID of the project, encoded as a base62 string
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
     * Gets team
     *
     * @return string
     */
    public function getTeam()
    {
        return $this->container['team'];
    }

    /**
     * Sets team
     *
     * @param string $team The ID of the team that has ownership of this project
     *
     * @return self
     */
    public function setTeam($team)
    {
        if (is_null($team)) {
            throw new \InvalidArgumentException('non-nullable team cannot be null');
        }
        $this->container['team'] = $team;

        return $this;
    }

    /**
     * Gets body_url
     *
     * @return string|null
     * @deprecated
     */
    public function getBodyUrl()
    {
        return $this->container['body_url'];
    }

    /**
     * Sets body_url
     *
     * @param string|null $body_url The link to the long description of the project. Always null, only kept for legacy compatibility.
     *
     * @return self
     * @deprecated
     */
    public function setBodyUrl($body_url)
    {
        if (is_null($body_url)) {
            array_push($this->openAPINullablesSetToNull, 'body_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('body_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['body_url'] = $body_url;

        return $this;
    }

    /**
     * Gets moderator_message
     *
     * @return \Aternos\ModrinthApi\Model\ProjectAllOfModeratorMessage|null
     */
    public function getModeratorMessage()
    {
        return $this->container['moderator_message'];
    }

    /**
     * Sets moderator_message
     *
     * @param \Aternos\ModrinthApi\Model\ProjectAllOfModeratorMessage|null $moderator_message moderator_message
     *
     * @return self
     */
    public function setModeratorMessage($moderator_message)
    {
        if (is_null($moderator_message)) {
            array_push($this->openAPINullablesSetToNull, 'moderator_message');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('moderator_message', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['moderator_message'] = $moderator_message;

        return $this;
    }

    /**
     * Gets published
     *
     * @return string
     */
    public function getPublished()
    {
        return $this->container['published'];
    }

    /**
     * Sets published
     *
     * @param string $published The date the project was published
     *
     * @return self
     */
    public function setPublished($published)
    {
        if (is_null($published)) {
            throw new \InvalidArgumentException('non-nullable published cannot be null');
        }
        $this->container['published'] = $published;

        return $this;
    }

    /**
     * Gets updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->container['updated'];
    }

    /**
     * Sets updated
     *
     * @param string $updated The date the project was last updated
     *
     * @return self
     */
    public function setUpdated($updated)
    {
        if (is_null($updated)) {
            throw new \InvalidArgumentException('non-nullable updated cannot be null');
        }
        $this->container['updated'] = $updated;

        return $this;
    }

    /**
     * Gets approved
     *
     * @return string|null
     */
    public function getApproved()
    {
        return $this->container['approved'];
    }

    /**
     * Sets approved
     *
     * @param string|null $approved The date the project's status was set to approved or unlisted
     *
     * @return self
     */
    public function setApproved($approved)
    {
        if (is_null($approved)) {
            array_push($this->openAPINullablesSetToNull, 'approved');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('approved', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['approved'] = $approved;

        return $this;
    }

    /**
     * Gets followers
     *
     * @return int
     */
    public function getFollowers()
    {
        return $this->container['followers'];
    }

    /**
     * Sets followers
     *
     * @param int $followers The total number of users following the project
     *
     * @return self
     */
    public function setFollowers($followers)
    {
        if (is_null($followers)) {
            throw new \InvalidArgumentException('non-nullable followers cannot be null');
        }
        $this->container['followers'] = $followers;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status The status of the project
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
     * Gets license
     *
     * @return \Aternos\ModrinthApi\Model\ProjectAllOfLicense|null
     */
    public function getLicense()
    {
        return $this->container['license'];
    }

    /**
     * Sets license
     *
     * @param \Aternos\ModrinthApi\Model\ProjectAllOfLicense|null $license license
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
     * Gets versions
     *
     * @return string[]|null
     */
    public function getVersions()
    {
        return $this->container['versions'];
    }

    /**
     * Sets versions
     *
     * @param string[]|null $versions A list of the version IDs of the project (will never be empty unless `draft` status)
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
     * Gets game_versions
     *
     * @return string[]|null
     */
    public function getGameVersions()
    {
        return $this->container['game_versions'];
    }

    /**
     * Sets game_versions
     *
     * @param string[]|null $game_versions A list of all of the game versions supported by the project
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
     * Gets loaders
     *
     * @return string[]|null
     */
    public function getLoaders()
    {
        return $this->container['loaders'];
    }

    /**
     * Sets loaders
     *
     * @param string[]|null $loaders A list of all of the loaders supported by the project
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
     * Gets gallery
     *
     * @return \Aternos\ModrinthApi\Model\ProjectAllOfGallery[]|null
     */
    public function getGallery()
    {
        return $this->container['gallery'];
    }

    /**
     * Sets gallery
     *
     * @param \Aternos\ModrinthApi\Model\ProjectAllOfGallery[]|null $gallery A list of images that have been uploaded to the project's gallery
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

