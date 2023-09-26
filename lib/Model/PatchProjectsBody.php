<?php
/**
 * PatchProjectsBody
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
 * OpenAPI Generator version: 7.0.1
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
 * PatchProjectsBody Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PatchProjectsBody implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PatchProjectsBody';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'categories' => 'string[]',
        'add_categories' => 'string[]',
        'remove_categories' => 'string[]',
        'additional_categories' => 'string[]',
        'add_additional_categories' => 'string[]',
        'remove_additional_categories' => 'string[]',
        'donation_urls' => '\Aternos\ModrinthApi\Model\ProjectDonationURL[]',
        'add_donation_urls' => '\Aternos\ModrinthApi\Model\ProjectDonationURL[]',
        'remove_donation_urls' => '\Aternos\ModrinthApi\Model\ProjectDonationURL[]',
        'issues_url' => 'string',
        'source_url' => 'string',
        'wiki_url' => 'string',
        'discord_url' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'categories' => null,
        'add_categories' => null,
        'remove_categories' => null,
        'additional_categories' => null,
        'add_additional_categories' => null,
        'remove_additional_categories' => null,
        'donation_urls' => null,
        'add_donation_urls' => null,
        'remove_donation_urls' => null,
        'issues_url' => null,
        'source_url' => null,
        'wiki_url' => null,
        'discord_url' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'categories' => false,
		'add_categories' => false,
		'remove_categories' => false,
		'additional_categories' => false,
		'add_additional_categories' => false,
		'remove_additional_categories' => false,
		'donation_urls' => false,
		'add_donation_urls' => false,
		'remove_donation_urls' => false,
		'issues_url' => true,
		'source_url' => true,
		'wiki_url' => true,
		'discord_url' => true
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
        'categories' => 'categories',
        'add_categories' => 'add_categories',
        'remove_categories' => 'remove_categories',
        'additional_categories' => 'additional_categories',
        'add_additional_categories' => 'add_additional_categories',
        'remove_additional_categories' => 'remove_additional_categories',
        'donation_urls' => 'donation_urls',
        'add_donation_urls' => 'add_donation_urls',
        'remove_donation_urls' => 'remove_donation_urls',
        'issues_url' => 'issues_url',
        'source_url' => 'source_url',
        'wiki_url' => 'wiki_url',
        'discord_url' => 'discord_url'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'categories' => 'setCategories',
        'add_categories' => 'setAddCategories',
        'remove_categories' => 'setRemoveCategories',
        'additional_categories' => 'setAdditionalCategories',
        'add_additional_categories' => 'setAddAdditionalCategories',
        'remove_additional_categories' => 'setRemoveAdditionalCategories',
        'donation_urls' => 'setDonationUrls',
        'add_donation_urls' => 'setAddDonationUrls',
        'remove_donation_urls' => 'setRemoveDonationUrls',
        'issues_url' => 'setIssuesUrl',
        'source_url' => 'setSourceUrl',
        'wiki_url' => 'setWikiUrl',
        'discord_url' => 'setDiscordUrl'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'categories' => 'getCategories',
        'add_categories' => 'getAddCategories',
        'remove_categories' => 'getRemoveCategories',
        'additional_categories' => 'getAdditionalCategories',
        'add_additional_categories' => 'getAddAdditionalCategories',
        'remove_additional_categories' => 'getRemoveAdditionalCategories',
        'donation_urls' => 'getDonationUrls',
        'add_donation_urls' => 'getAddDonationUrls',
        'remove_donation_urls' => 'getRemoveDonationUrls',
        'issues_url' => 'getIssuesUrl',
        'source_url' => 'getSourceUrl',
        'wiki_url' => 'getWikiUrl',
        'discord_url' => 'getDiscordUrl'
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
        $this->setIfExists('categories', $data ?? [], null);
        $this->setIfExists('add_categories', $data ?? [], null);
        $this->setIfExists('remove_categories', $data ?? [], null);
        $this->setIfExists('additional_categories', $data ?? [], null);
        $this->setIfExists('add_additional_categories', $data ?? [], null);
        $this->setIfExists('remove_additional_categories', $data ?? [], null);
        $this->setIfExists('donation_urls', $data ?? [], null);
        $this->setIfExists('add_donation_urls', $data ?? [], null);
        $this->setIfExists('remove_donation_urls', $data ?? [], null);
        $this->setIfExists('issues_url', $data ?? [], null);
        $this->setIfExists('source_url', $data ?? [], null);
        $this->setIfExists('wiki_url', $data ?? [], null);
        $this->setIfExists('discord_url', $data ?? [], null);
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
     * @param string[]|null $categories Set all of the categories to the categories specified here
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
     * Gets add_categories
     *
     * @return string[]|null
     */
    public function getAddCategories()
    {
        return $this->container['add_categories'];
    }

    /**
     * Sets add_categories
     *
     * @param string[]|null $add_categories Add all of the categories specified here
     *
     * @return self
     */
    public function setAddCategories($add_categories)
    {
        if (is_null($add_categories)) {
            throw new \InvalidArgumentException('non-nullable add_categories cannot be null');
        }
        $this->container['add_categories'] = $add_categories;

        return $this;
    }

    /**
     * Gets remove_categories
     *
     * @return string[]|null
     */
    public function getRemoveCategories()
    {
        return $this->container['remove_categories'];
    }

    /**
     * Sets remove_categories
     *
     * @param string[]|null $remove_categories Remove all of the categories specified here
     *
     * @return self
     */
    public function setRemoveCategories($remove_categories)
    {
        if (is_null($remove_categories)) {
            throw new \InvalidArgumentException('non-nullable remove_categories cannot be null');
        }
        $this->container['remove_categories'] = $remove_categories;

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
     * @param string[]|null $additional_categories Set all of the additional categories to the categories specified here
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
     * Gets add_additional_categories
     *
     * @return string[]|null
     */
    public function getAddAdditionalCategories()
    {
        return $this->container['add_additional_categories'];
    }

    /**
     * Sets add_additional_categories
     *
     * @param string[]|null $add_additional_categories Add all of the additional categories specified here
     *
     * @return self
     */
    public function setAddAdditionalCategories($add_additional_categories)
    {
        if (is_null($add_additional_categories)) {
            throw new \InvalidArgumentException('non-nullable add_additional_categories cannot be null');
        }
        $this->container['add_additional_categories'] = $add_additional_categories;

        return $this;
    }

    /**
     * Gets remove_additional_categories
     *
     * @return string[]|null
     */
    public function getRemoveAdditionalCategories()
    {
        return $this->container['remove_additional_categories'];
    }

    /**
     * Sets remove_additional_categories
     *
     * @param string[]|null $remove_additional_categories Remove all of the additional categories specified here
     *
     * @return self
     */
    public function setRemoveAdditionalCategories($remove_additional_categories)
    {
        if (is_null($remove_additional_categories)) {
            throw new \InvalidArgumentException('non-nullable remove_additional_categories cannot be null');
        }
        $this->container['remove_additional_categories'] = $remove_additional_categories;

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
     * @param \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null $donation_urls Set all of the donation links to the donation links specified here
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
     * Gets add_donation_urls
     *
     * @return \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null
     */
    public function getAddDonationUrls()
    {
        return $this->container['add_donation_urls'];
    }

    /**
     * Sets add_donation_urls
     *
     * @param \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null $add_donation_urls Add all of the donation links specified here
     *
     * @return self
     */
    public function setAddDonationUrls($add_donation_urls)
    {
        if (is_null($add_donation_urls)) {
            throw new \InvalidArgumentException('non-nullable add_donation_urls cannot be null');
        }
        $this->container['add_donation_urls'] = $add_donation_urls;

        return $this;
    }

    /**
     * Gets remove_donation_urls
     *
     * @return \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null
     */
    public function getRemoveDonationUrls()
    {
        return $this->container['remove_donation_urls'];
    }

    /**
     * Sets remove_donation_urls
     *
     * @param \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null $remove_donation_urls Remove all of the donation links specified here
     *
     * @return self
     */
    public function setRemoveDonationUrls($remove_donation_urls)
    {
        if (is_null($remove_donation_urls)) {
            throw new \InvalidArgumentException('non-nullable remove_donation_urls cannot be null');
        }
        $this->container['remove_donation_urls'] = $remove_donation_urls;

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
     * @param string|null $issues_url An optional link to where to submit bugs or issues with the projects
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
     * @param string|null $source_url An optional link to the source code of the projects
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
     * @param string|null $wiki_url An optional link to the projects' wiki page or other relevant information
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
     * @param string|null $discord_url An optional invite link to the projects' discord
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


