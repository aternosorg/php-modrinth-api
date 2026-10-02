<?php
/**
 * EditableProject
 *
 * PHP version 8.1
 *
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Labrinth
 *
 * This documentation doesn't provide a way to test our API. In order to facilitate testing, we recommend the following tools:  - [cURL](https://curl.se/) (recommended, command-line) - [ReqBIN](https://reqbin.com/) (recommended, online) - [Postman](https://www.postman.com/downloads/) - [Insomnia](https://insomnia.rest/) - Your web browser, if you don't need to send headers or a request body  Once you have a working client, you can test that it works by making a `GET` request to `https://staging-api.modrinth.com/`:  ```json {   \"about\": \"Welcome traveler!\",   \"documentation\": \"https://docs.modrinth.com\",   \"name\": \"modrinth-labrinth\",   \"version\": \"2.7.0\" } ```  If you got a response similar to the one above, you can use the Modrinth API! When you want to go live using the production API, use `api.modrinth.com` instead of `staging-api.modrinth.com`.  ## Authentication This API has two options for authentication: personal access tokens and [OAuth2](https://en.wikipedia.org/wiki/OAuth). All tokens are tied to a Modrinth user and use the `Authorization` header of the request.  Example: ``` Authorization: mrp_RNtLRSPmGj2pd1v1ubi52nX7TJJM9sznrmwhAuj511oe4t1jAqAQ3D6Wc8Ic ```  You do not need a token for most requests. Generally speaking, only the following types of requests require a token: - those which create data (such as version creation) - those which modify data (such as editing a project) - those which access private data (such as draft projects, notifications, emails, and payout data)  Each request requiring authentication has a certain scope. For example, to view the email of the user being requested, the token must have the `USER_READ_EMAIL` scope. You can find the list of available scopes [on GitHub](https://github.com/modrinth/labrinth/blob/master/src/models/pats.rs#L15). Making a request with an invalid scope will return a 401 error.  Please note that certain scopes and requests cannot be completed with a personal access token or using OAuth. For example, deleting a user account can only be done through Modrinth's frontend.  A detailed guide on OAuth has been published in [Modrinth's technical documentation](https://docs.modrinth.com/guide/oauth).  ### Personal access tokens Personal access tokens (PATs) can be generated in from [the user settings](https://modrinth.com/settings/account).  ### GitHub tokens For backwards compatibility purposes, some types of GitHub tokens also work for authenticating a user with Modrinth's API, granting all scopes. **We urge any application still using GitHub tokens to start using personal access tokens for security and reliability purposes.** GitHub tokens will cease to function to authenticate with Modrinth's API as soon as version 3 of the API is made generally available.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/). This allows for cross-domain communication from the browser. All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.  ## Identifiers The majority of items you can interact with in the API have a unique eight-digit base62 ID. Projects, versions, users, threads, teams, and reports all use this same way of identifying themselves. Version files use the sha1 or sha512 file hashes as identifiers.  Each project and user has a friendlier way of identifying them; slugs and usernames, respectively. While unique IDs are constant, slugs and usernames can change at any moment. If you want to store something in the long term, it is recommended to use the unique ID.  ## Ratelimits The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers. - `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute - `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window - `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets  Ratelimits are the same no matter whether you use a token or not. The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:support@modrinth.com).  ## User Agents To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header. Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic. It is recommended, but not required, to include contact information in your user agent. This allows us to contact you if we would like a change in your application's behavior without having to block your traffic. - Bad: `User-Agent: okhttp/4.9.3` - Good: `User-Agent: project_name` - Better: `User-Agent: github_username/project_name/1.56.0` - Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`  ## Versioning Modrinth follows a simple pattern for its API versioning. In the event of a breaking API change, the API version in the URL path is bumped, and migration steps will be published below.  When an API is no longer the current one, it will immediately be considered deprecated. No more support will be provided for API versions older than the current one. It will be kept for some time, but this amount of time is not certain.  We will exercise various tactics to get people to update their implementation of our API. One example is by adding something like `STOP USING THIS API` to various data returned by the API.  Once an API version is completely deprecated, it will permanently return a 410 error. Please ensure your application handles these 410 errors.  ### Migrations Inside the following spoiler, you will be able to find all changes between versions of the Modrinth API, accompanied by tips and a guide to migrate applications to newer versions.  Here, you can also find changes for [Minotaur](https://github.com/modrinth/minotaur), Modrinth's official Gradle plugin. Major versions of Minotaur directly correspond to major versions of the Modrinth API.  <details><summary>API v1 to API v2</summary>  These bullet points cover most changes in the v2 API, but please note that fields containing `mod` in most contexts have been shifted to `project`.  For example, in the search route, the field `mod_id` was renamed to `project_id`.  - The search route has been moved from `/api/v1/mod` to `/v2/search` - New project fields: `project_type` (may be `mod` or `modpack`), `moderation_message` (which has a `message` and `body`), `gallery` - New search facet: `project_type` - Alphabetical sort removed (it didn't work and is not possible due to limits in MeiliSearch) - New search fields: `project_type`, `gallery`   - The gallery field is an array of URLs to images that are part of the project's gallery - The gallery is a new feature which allows the user to upload images showcasing their mod to the CDN which will be displayed on their mod page - Internal change: Any project file uploaded to Modrinth is now validated to make sure it's a valid Minecraft mod, Modpack, etc.   - For example, a Forge 1.17 mod with a JAR not containing a mods.toml will not be allowed to be uploaded to Modrinth - In project creation, projects may not upload a mod with no versions to review, however they can be saved as a draft   - Similarly, for version creation, a version may not be uploaded without any files - Donation URLs have been enabled - New project status: `archived`. Projects with this status do not appear in search - Tags (such as categories, loaders) now have icons (SVGs) and specific project types attached - Dependencies have been wiped and replaced with a new system - Notifications now have a `type` field, such as `project_update`  Along with this, project subroutes (such as `/v2/project/{id}/version`) now allow the slug to be used as the ID. This is also the case with user routes.  </details><details><summary>Minotaur v1 to Minotaur v2</summary>  Minotaur 2.x introduced a few breaking changes to how your buildscript is formatted.  First, instead of registering your own `publishModrinth` task, Minotaur now automatically creates a `modrinth` task. As such, you can replace the `task publishModrinth(type: TaskModrinthUpload) {` line with just `modrinth {`.  To declare supported Minecraft versions and mod loaders, the `gameVersions` and `loaders` arrays must now be used. The syntax for these are pretty self-explanatory.  Instead of using `releaseType`, you must now use `versionType`. This was actually changed in v1.2.0, but very few buildscripts have moved on from v1.1.0.  Dependencies have been changed to a special DSL. Create a `dependencies` block within the `modrinth` block, and then use `scope.type(\"project/version\")`. For example, `required.project(\"fabric-api\")` adds a required project dependency on Fabric API.  You may now use the slug anywhere that a project ID was previously required.  </details>
 *
 * The version of the OpenAPI document: v2.7.0/366f528
 * Contact: support@modrinth.com
 * @generated Generated by: https://openapi-generator.tech
 * Generator version: 7.25.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Aternos\ModrinthApi\Model;

use ArrayAccess;
use JsonSerializable;
use InvalidArgumentException;
use ReturnTypeWillChange;
use Aternos\ModrinthApi\ObjectSerializer;

/**
 * EditableProject Class Doc Comment
 *
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements ArrayAccess<string, mixed>
 */
class EditableProject implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static string $openAPIModelName = 'EditableProject';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var array<string, string>
     */
    protected static array $openAPITypes = [
        'slug' => 'string',
        'title' => 'string',
        'description' => 'string',
        'body' => 'string',
        'categories' => 'string[]',
        'additional_categories' => 'string[]',
        'status' => 'string',
        'requested_status' => 'string',
        'issues_url' => 'string',
        'source_url' => 'string',
        'wiki_url' => 'string',
        'discord_url' => 'string',
        'donation_urls' => '\Aternos\ModrinthApi\Model\ProjectDonationURL[]',
        'client_side' => 'string',
        'server_side' => 'string',
        'license_id' => 'string',
        'license_url' => 'string',
        'moderation_message' => 'string',
        'moderation_message_body' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var array<string, string|null>
     */
    protected static array $openAPIFormats = [
        'slug' => null,
        'title' => null,
        'description' => null,
        'body' => null,
        'categories' => null,
        'additional_categories' => null,
        'status' => null,
        'requested_status' => null,
        'issues_url' => null,
        'source_url' => null,
        'wiki_url' => null,
        'discord_url' => null,
        'donation_urls' => null,
        'client_side' => null,
        'server_side' => null,
        'license_id' => null,
        'license_url' => null,
        'moderation_message' => null,
        'moderation_message_body' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var array<string, bool>
     */
    protected static array $openAPINullables = [
        'slug' => false,
        'title' => false,
        'description' => false,
        'body' => false,
        'categories' => false,
        'additional_categories' => false,
        'status' => false,
        'requested_status' => true,
        'issues_url' => true,
        'source_url' => true,
        'wiki_url' => true,
        'discord_url' => true,
        'donation_urls' => false,
        'client_side' => false,
        'server_side' => false,
        'license_id' => false,
        'license_url' => true,
        'moderation_message' => true,
        'moderation_message_body' => true
    ];

    /**
     * If a nullable field gets set to null, insert it here
     *
     * @var array<string, bool>
     */
    protected array $openAPINullablesSetToNull = [];

    /**
     * {@inheritdoc}
     */
    public static function openAPITypes(): array
    {
        return self::$openAPITypes;
    }

    /**
     * {@inheritdoc}
     */
    public static function openAPIFormats(): array
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array<string, bool>
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return array<string, bool>
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param array<string, bool> $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * {@inheritdoc}
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * {@inheritdoc}
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var array<string, string>
     */
    protected static array $attributeMap = [
        'slug' => 'slug',
        'title' => 'title',
        'description' => 'description',
        'body' => 'body',
        'categories' => 'categories',
        'additional_categories' => 'additional_categories',
        'status' => 'status',
        'requested_status' => 'requested_status',
        'issues_url' => 'issues_url',
        'source_url' => 'source_url',
        'wiki_url' => 'wiki_url',
        'discord_url' => 'discord_url',
        'donation_urls' => 'donation_urls',
        'client_side' => 'client_side',
        'server_side' => 'server_side',
        'license_id' => 'license_id',
        'license_url' => 'license_url',
        'moderation_message' => 'moderation_message',
        'moderation_message_body' => 'moderation_message_body'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var array<string, string>
     */
    protected static array $setters = [
        'slug' => 'setSlug',
        'title' => 'setTitle',
        'description' => 'setDescription',
        'body' => 'setBody',
        'categories' => 'setCategories',
        'additional_categories' => 'setAdditionalCategories',
        'status' => 'setStatus',
        'requested_status' => 'setRequestedStatus',
        'issues_url' => 'setIssuesUrl',
        'source_url' => 'setSourceUrl',
        'wiki_url' => 'setWikiUrl',
        'discord_url' => 'setDiscordUrl',
        'donation_urls' => 'setDonationUrls',
        'client_side' => 'setClientSide',
        'server_side' => 'setServerSide',
        'license_id' => 'setLicenseId',
        'license_url' => 'setLicenseUrl',
        'moderation_message' => 'setModerationMessage',
        'moderation_message_body' => 'setModerationMessageBody'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var array<string, string>
     */
    protected static array $getters = [
        'slug' => 'getSlug',
        'title' => 'getTitle',
        'description' => 'getDescription',
        'body' => 'getBody',
        'categories' => 'getCategories',
        'additional_categories' => 'getAdditionalCategories',
        'status' => 'getStatus',
        'requested_status' => 'getRequestedStatus',
        'issues_url' => 'getIssuesUrl',
        'source_url' => 'getSourceUrl',
        'wiki_url' => 'getWikiUrl',
        'discord_url' => 'getDiscordUrl',
        'donation_urls' => 'getDonationUrls',
        'client_side' => 'getClientSide',
        'server_side' => 'getServerSide',
        'license_id' => 'getLicenseId',
        'license_url' => 'getLicenseUrl',
        'moderation_message' => 'getModerationMessage',
        'moderation_message_body' => 'getModerationMessageBody'
    ];

    /**
     * {@inheritdoc}
     */
    public static function attributeMap(): array
    {
        return self::$attributeMap;
    }

    /**
     * {@inheritdoc}
     */
    public static function setters(): array
    {
        return self::$setters;
    }

    /**
     * {@inheritdoc}
     */
    public static function getters(): array
    {
        return self::$getters;
    }

    /**
     * {@inheritdoc}
     */
    public function getModelName(): string
    {
        return self::$openAPIModelName;
    }

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
    public const STATUS_UNKNOWN_DEFAULT_OPEN_API = 'unknown_default_open_api';
    public const REQUESTED_STATUS_APPROVED = 'approved';
    public const REQUESTED_STATUS_ARCHIVED = 'archived';
    public const REQUESTED_STATUS_UNLISTED = 'unlisted';
    public const REQUESTED_STATUS__PRIVATE = 'private';
    public const REQUESTED_STATUS_DRAFT = 'draft';
    public const REQUESTED_STATUS_UNKNOWN_DEFAULT_OPEN_API = 'unknown_default_open_api';
    public const CLIENT_SIDE_REQUIRED = 'required';
    public const CLIENT_SIDE_OPTIONAL = 'optional';
    public const CLIENT_SIDE_UNSUPPORTED = 'unsupported';
    public const CLIENT_SIDE_UNKNOWN_DEFAULT_OPEN_API = 'unknown_default_open_api';
    public const SERVER_SIDE_REQUIRED = 'required';
    public const SERVER_SIDE_OPTIONAL = 'optional';
    public const SERVER_SIDE_UNSUPPORTED = 'unsupported';
    public const SERVER_SIDE_UNKNOWN_DEFAULT_OPEN_API = 'unknown_default_open_api';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public static function getStatusAllowableValues()
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
            self::STATUS_UNKNOWN_DEFAULT_OPEN_API,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public static function getRequestedStatusAllowableValues()
    {
        return [
            self::REQUESTED_STATUS_APPROVED,
            self::REQUESTED_STATUS_ARCHIVED,
            self::REQUESTED_STATUS_UNLISTED,
            self::REQUESTED_STATUS__PRIVATE,
            self::REQUESTED_STATUS_DRAFT,
            self::REQUESTED_STATUS_UNKNOWN_DEFAULT_OPEN_API,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public static function getClientSideAllowableValues()
    {
        return [
            self::CLIENT_SIDE_REQUIRED,
            self::CLIENT_SIDE_OPTIONAL,
            self::CLIENT_SIDE_UNSUPPORTED,
            self::CLIENT_SIDE_UNKNOWN_DEFAULT_OPEN_API,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public static function getServerSideAllowableValues()
    {
        return [
            self::SERVER_SIDE_REQUIRED,
            self::SERVER_SIDE_OPTIONAL,
            self::SERVER_SIDE_UNSUPPORTED,
            self::SERVER_SIDE_UNKNOWN_DEFAULT_OPEN_API,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var array
     */
    protected array $container = [];

    /**
     * Constructor
     *
     * @param array $data Associated array of property values initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('slug', $data ?? [], null);
        $this->setIfExists('title', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('body', $data ?? [], null);
        $this->setIfExists('categories', $data ?? [], null);
        $this->setIfExists('additional_categories', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('requested_status', $data ?? [], null);
        $this->setIfExists('issues_url', $data ?? [], null);
        $this->setIfExists('source_url', $data ?? [], null);
        $this->setIfExists('wiki_url', $data ?? [], null);
        $this->setIfExists('discord_url', $data ?? [], null);
        $this->setIfExists('donation_urls', $data ?? [], null);
        $this->setIfExists('client_side', $data ?? [], null);
        $this->setIfExists('server_side', $data ?? [], null);
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
    private function setIfExists(string $variableName, array $fields, mixed $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * {@inheritdoc}
     */
    public function listInvalidProperties(): array
    {
        $invalidProperties = [];

        $allowedValues = self::getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = self::getRequestedStatusAllowableValues();
        if (!is_null($this->container['requested_status']) && !in_array($this->container['requested_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'requested_status', must be one of '%s'",
                $this->container['requested_status'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = self::getClientSideAllowableValues();
        if (!is_null($this->container['client_side']) && !in_array($this->container['client_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'client_side', must be one of '%s'",
                $this->container['client_side'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = self::getServerSideAllowableValues();
        if (!is_null($this->container['server_side']) && !in_array($this->container['server_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'server_side', must be one of '%s'",
                $this->container['server_side'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * {@inheritdoc}
     */
    public function valid(): bool
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets slug
     *
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->container['slug'];
    }

    /**
     * Sets slug
     *
     * @param string|null $slug The slug of a project, used for vanity URLs. Regex: ```^[\\w!@$()`.+,\"\\-']{3,64}$```
     *
     * @return $this
     */
    public function setSlug(?string $slug): static
    {
        if (is_null($slug)) {
            throw new InvalidArgumentException('non-nullable slug cannot be null');
        }
        $this->container['slug'] = $slug;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string|null $title The title or name of the project
     *
     * @return $this
     */
    public function setTitle(?string $title): static
    {
        if (is_null($title)) {
            throw new InvalidArgumentException('non-nullable title cannot be null');
        }
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description A short sentence summarizing the project, no more than a sentence or two.
     *
     * @return $this
     */
    public function setDescription(?string $description): static
    {
        if (is_null($description)) {
            throw new InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets body
     *
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->container['body'];
    }

    /**
     * Sets body
     *
     * @param string|null $body A long form description of the project
     *
     * @return $this
     */
    public function setBody(?string $body): static
    {
        if (is_null($body)) {
            throw new InvalidArgumentException('non-nullable body cannot be null');
        }
        $this->container['body'] = $body;

        return $this;
    }

    /**
     * Gets categories
     *
     * @return string[]|null
     */
    public function getCategories(): ?array
    {
        return $this->container['categories'];
    }

    /**
     * Sets categories
     *
     * @param string[]|null $categories A list of the featured categories that the project has.
     *
     * @return $this
     */
    public function setCategories(?array $categories): static
    {
        if (is_null($categories)) {
            throw new InvalidArgumentException('non-nullable categories cannot be null');
        }
        $this->container['categories'] = $categories;

        return $this;
    }

    /**
     * Gets additional_categories
     *
     * @return string[]|null
     */
    public function getAdditionalCategories(): ?array
    {
        return $this->container['additional_categories'];
    }

    /**
     * Sets additional_categories
     *
     * @param string[]|null $additional_categories A list of additional categories that the project also has. These are supplementary to the featured categories, and does not include them again.
     *
     * @return $this
     */
    public function setAdditionalCategories(?array $additional_categories): static
    {
        if (is_null($additional_categories)) {
            throw new InvalidArgumentException('non-nullable additional_categories cannot be null');
        }
        $this->container['additional_categories'] = $additional_categories;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status The status of the project
     *
     * @return $this
     */
    public function setStatus(?string $status): static
    {
        if (is_null($status)) {
            throw new InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = self::getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            $status = self::STATUS_UNKNOWN_DEFAULT_OPEN_API;
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets requested_status
     *
     * @return string|null
     */
    public function getRequestedStatus(): ?string
    {
        return $this->container['requested_status'];
    }

    /**
     * Sets requested_status
     *
     * @param string|null $requested_status The requested status when submitting for review or scheduling the project for release. Approved status refers to \"Public\" visibility.
     *
     * @return $this
     */
    public function setRequestedStatus(?string $requested_status): static
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
        $allowedValues = self::getRequestedStatusAllowableValues();
        if (!is_null($requested_status) && !in_array($requested_status, $allowedValues, true)) {
            $requested_status = self::REQUESTED_STATUS_UNKNOWN_DEFAULT_OPEN_API;
        }
        $this->container['requested_status'] = $requested_status;

        return $this;
    }

    /**
     * Gets issues_url
     *
     * @return string|null
     */
    public function getIssuesUrl(): ?string
    {
        return $this->container['issues_url'];
    }

    /**
     * Sets issues_url
     *
     * @param string|null $issues_url An optional link to where to submit bugs or issues with the project
     *
     * @return $this
     */
    public function setIssuesUrl(?string $issues_url): static
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
    public function getSourceUrl(): ?string
    {
        return $this->container['source_url'];
    }

    /**
     * Sets source_url
     *
     * @param string|null $source_url An optional link to the source code of the project
     *
     * @return $this
     */
    public function setSourceUrl(?string $source_url): static
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
    public function getWikiUrl(): ?string
    {
        return $this->container['wiki_url'];
    }

    /**
     * Sets wiki_url
     *
     * @param string|null $wiki_url An optional link to the project's wiki page or other relevant information
     *
     * @return $this
     */
    public function setWikiUrl(?string $wiki_url): static
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
    public function getDiscordUrl(): ?string
    {
        return $this->container['discord_url'];
    }

    /**
     * Sets discord_url
     *
     * @param string|null $discord_url An optional invite link to the project's discord.
     *
     * @return $this
     */
    public function setDiscordUrl(?string $discord_url): static
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
    public function getDonationUrls(): ?array
    {
        return $this->container['donation_urls'];
    }

    /**
     * Sets donation_urls
     *
     * @param \Aternos\ModrinthApi\Model\ProjectDonationURL[]|null $donation_urls A list of donation links for the project
     *
     * @return $this
     */
    public function setDonationUrls(?array $donation_urls): static
    {
        if (is_null($donation_urls)) {
            throw new InvalidArgumentException('non-nullable donation_urls cannot be null');
        }
        $this->container['donation_urls'] = $donation_urls;

        return $this;
    }

    /**
     * Gets client_side
     *
     * @return string|null
     * @deprecated
     */
    public function getClientSide(): ?string
    {
        return $this->container['client_side'];
    }

    /**
     * Sets client_side
     *
     * @param string|null $client_side Deprecated - use `environment` instead.
     *
     * @return $this
     * @deprecated
     */
    public function setClientSide(?string $client_side): static
    {
        if (is_null($client_side)) {
            throw new InvalidArgumentException('non-nullable client_side cannot be null');
        }
        $allowedValues = self::getClientSideAllowableValues();
        if (!in_array($client_side, $allowedValues, true)) {
            $client_side = self::CLIENT_SIDE_UNKNOWN_DEFAULT_OPEN_API;
        }
        $this->container['client_side'] = $client_side;

        return $this;
    }

    /**
     * Gets server_side
     *
     * @return string|null
     * @deprecated
     */
    public function getServerSide(): ?string
    {
        return $this->container['server_side'];
    }

    /**
     * Sets server_side
     *
     * @param string|null $server_side Deprecated - use `environment` instead.
     *
     * @return $this
     * @deprecated
     */
    public function setServerSide(?string $server_side): static
    {
        if (is_null($server_side)) {
            throw new InvalidArgumentException('non-nullable server_side cannot be null');
        }
        $allowedValues = self::getServerSideAllowableValues();
        if (!in_array($server_side, $allowedValues, true)) {
            $server_side = self::SERVER_SIDE_UNKNOWN_DEFAULT_OPEN_API;
        }
        $this->container['server_side'] = $server_side;

        return $this;
    }

    /**
     * Gets license_id
     *
     * @return string|null
     */
    public function getLicenseId(): ?string
    {
        return $this->container['license_id'];
    }

    /**
     * Sets license_id
     *
     * @param string|null $license_id The SPDX license ID of a project
     *
     * @return $this
     */
    public function setLicenseId(?string $license_id): static
    {
        if (is_null($license_id)) {
            throw new InvalidArgumentException('non-nullable license_id cannot be null');
        }
        $this->container['license_id'] = $license_id;

        return $this;
    }

    /**
     * Gets license_url
     *
     * @return string|null
     */
    public function getLicenseUrl(): ?string
    {
        return $this->container['license_url'];
    }

    /**
     * Sets license_url
     *
     * @param string|null $license_url The URL to this license
     *
     * @return $this
     */
    public function setLicenseUrl(?string $license_url): static
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
    public function getModerationMessage(): ?string
    {
        return $this->container['moderation_message'];
    }

    /**
     * Sets moderation_message
     *
     * @param string|null $moderation_message The title of the moderators' message for the project
     *
     * @return $this
     */
    public function setModerationMessage(?string $moderation_message): static
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
    public function getModerationMessageBody(): ?string
    {
        return $this->container['moderation_message_body'];
    }

    /**
     * Sets moderation_message_body
     *
     * @param string|null $moderation_message_body The body of the moderators' message for the project
     *
     * @return $this
     */
    public function setModerationMessageBody(?string $moderation_message_body): static
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
     * @param int|string $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int|string $offset Offset
     *
     * @return mixed|null
     */
    #[ReturnTypeWillChange]
    public function offsetGet(mixed $offset): mixed
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|string|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
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
     * @param int|string $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
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
    #[ReturnTypeWillChange]
    public function jsonSerialize(): mixed
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString(): string
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
    public function toHeaderValue(): string
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


