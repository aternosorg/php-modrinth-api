<?php
/**
 * ThreadMessageBody
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

namespace Aternos\ModrinthApi\Model;

use \ArrayAccess;
use \Aternos\ModrinthApi\ObjectSerializer;

/**
 * ThreadMessageBody Class Doc Comment
 *
 * @category Class
 * @description The contents of the message. **Fields will vary depending on message type.**
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ThreadMessageBody implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ThreadMessageBody';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'type' => 'string',
        'body' => 'string',
        'private' => 'bool',
        'replying_to' => 'string',
        'old_status' => 'string',
        'new_status' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'type' => null,
        'body' => null,
        'private' => null,
        'replying_to' => null,
        'old_status' => null,
        'new_status' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'type' => false,
        'body' => false,
        'private' => false,
        'replying_to' => true,
        'old_status' => false,
        'new_status' => false
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
        'type' => 'type',
        'body' => 'body',
        'private' => 'private',
        'replying_to' => 'replying_to',
        'old_status' => 'old_status',
        'new_status' => 'new_status'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'body' => 'setBody',
        'private' => 'setPrivate',
        'replying_to' => 'setReplyingTo',
        'old_status' => 'setOldStatus',
        'new_status' => 'setNewStatus'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'body' => 'getBody',
        'private' => 'getPrivate',
        'replying_to' => 'getReplyingTo',
        'old_status' => 'getOldStatus',
        'new_status' => 'getNewStatus'
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

    public const TYPE_STATUS_CHANGE = 'status_change';
    public const TYPE_TEXT = 'text';
    public const TYPE_THREAD_CLOSURE = 'thread_closure';
    public const TYPE_DELETED = 'deleted';
    public const OLD_STATUS_APPROVED = 'approved';
    public const OLD_STATUS_ARCHIVED = 'archived';
    public const OLD_STATUS_REJECTED = 'rejected';
    public const OLD_STATUS_DRAFT = 'draft';
    public const OLD_STATUS_UNLISTED = 'unlisted';
    public const OLD_STATUS_PROCESSING = 'processing';
    public const OLD_STATUS_WITHHELD = 'withheld';
    public const OLD_STATUS_SCHEDULED = 'scheduled';
    public const OLD_STATUS__PRIVATE = 'private';
    public const OLD_STATUS_UNKNOWN = 'unknown';
    public const NEW_STATUS_APPROVED = 'approved';
    public const NEW_STATUS_ARCHIVED = 'archived';
    public const NEW_STATUS_REJECTED = 'rejected';
    public const NEW_STATUS_DRAFT = 'draft';
    public const NEW_STATUS_UNLISTED = 'unlisted';
    public const NEW_STATUS_PROCESSING = 'processing';
    public const NEW_STATUS_WITHHELD = 'withheld';
    public const NEW_STATUS_SCHEDULED = 'scheduled';
    public const NEW_STATUS__PRIVATE = 'private';
    public const NEW_STATUS_UNKNOWN = 'unknown';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_STATUS_CHANGE,
            self::TYPE_TEXT,
            self::TYPE_THREAD_CLOSURE,
            self::TYPE_DELETED,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getOldStatusAllowableValues()
    {
        return [
            self::OLD_STATUS_APPROVED,
            self::OLD_STATUS_ARCHIVED,
            self::OLD_STATUS_REJECTED,
            self::OLD_STATUS_DRAFT,
            self::OLD_STATUS_UNLISTED,
            self::OLD_STATUS_PROCESSING,
            self::OLD_STATUS_WITHHELD,
            self::OLD_STATUS_SCHEDULED,
            self::OLD_STATUS__PRIVATE,
            self::OLD_STATUS_UNKNOWN,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getNewStatusAllowableValues()
    {
        return [
            self::NEW_STATUS_APPROVED,
            self::NEW_STATUS_ARCHIVED,
            self::NEW_STATUS_REJECTED,
            self::NEW_STATUS_DRAFT,
            self::NEW_STATUS_UNLISTED,
            self::NEW_STATUS_PROCESSING,
            self::NEW_STATUS_WITHHELD,
            self::NEW_STATUS_SCHEDULED,
            self::NEW_STATUS__PRIVATE,
            self::NEW_STATUS_UNKNOWN,
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
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('body', $data ?? [], null);
        $this->setIfExists('private', $data ?? [], null);
        $this->setIfExists('replying_to', $data ?? [], null);
        $this->setIfExists('old_status', $data ?? [], null);
        $this->setIfExists('new_status', $data ?? [], null);
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

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getOldStatusAllowableValues();
        if (!is_null($this->container['old_status']) && !in_array($this->container['old_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'old_status', must be one of '%s'",
                $this->container['old_status'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getNewStatusAllowableValues();
        if (!is_null($this->container['new_status']) && !in_array($this->container['new_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'new_status', must be one of '%s'",
                $this->container['new_status'],
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
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type The type of message
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

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
     * @param string|null $body The actual message text. **Only present for `text` message type**
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
     * Gets private
     *
     * @return bool|null
     */
    public function getPrivate()
    {
        return $this->container['private'];
    }

    /**
     * Sets private
     *
     * @param bool|null $private Whether the message is only visible to moderators. **Only present for `text` message type**
     *
     * @return self
     */
    public function setPrivate($private)
    {
        if (is_null($private)) {
            throw new \InvalidArgumentException('non-nullable private cannot be null');
        }
        $this->container['private'] = $private;

        return $this;
    }

    /**
     * Gets replying_to
     *
     * @return string|null
     */
    public function getReplyingTo()
    {
        return $this->container['replying_to'];
    }

    /**
     * Sets replying_to
     *
     * @param string|null $replying_to The ID of the message being replied to by this message. **Only present for `text` message type**
     *
     * @return self
     */
    public function setReplyingTo($replying_to)
    {
        if (is_null($replying_to)) {
            array_push($this->openAPINullablesSetToNull, 'replying_to');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('replying_to', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['replying_to'] = $replying_to;

        return $this;
    }

    /**
     * Gets old_status
     *
     * @return string|null
     */
    public function getOldStatus()
    {
        return $this->container['old_status'];
    }

    /**
     * Sets old_status
     *
     * @param string|null $old_status The old status of the project. **Only present for `status_change` message type**
     *
     * @return self
     */
    public function setOldStatus($old_status)
    {
        if (is_null($old_status)) {
            throw new \InvalidArgumentException('non-nullable old_status cannot be null');
        }
        $allowedValues = $this->getOldStatusAllowableValues();
        if (!in_array($old_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'old_status', must be one of '%s'",
                    $old_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['old_status'] = $old_status;

        return $this;
    }

    /**
     * Gets new_status
     *
     * @return string|null
     */
    public function getNewStatus()
    {
        return $this->container['new_status'];
    }

    /**
     * Sets new_status
     *
     * @param string|null $new_status The new status of the project. **Only present for `status_change` message type**
     *
     * @return self
     */
    public function setNewStatus($new_status)
    {
        if (is_null($new_status)) {
            throw new \InvalidArgumentException('non-nullable new_status cannot be null');
        }
        $allowedValues = $this->getNewStatusAllowableValues();
        if (!in_array($new_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'new_status', must be one of '%s'",
                    $new_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['new_status'] = $new_status;

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


