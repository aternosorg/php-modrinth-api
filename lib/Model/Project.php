<?php
/**
 * Project
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
 * This documentation doesn't provide a way to test our API. In order to facilitate testing, we recommend the following tools:  - [cURL](https://curl.se/) (recommended, command-line) - [ReqBIN](https://reqbin.com/) (recommended, online) - [Postman](https://www.postman.com/downloads/) - [Insomnia](https://insomnia.rest/) - Your web browser, if you don't need to send headers or a request body  Once you have a working client, you can test that it works by making a `GET` request to `https://staging-api.modrinth.com/`:  ```json {   \"about\": \"Welcome traveler!\",   \"documentation\": \"https://docs.modrinth.com\",   \"name\": \"modrinth-labrinth\",   \"version\": \"2.7.0\" } ```  If you got a response similar to the one above, you can use the Modrinth API! When you want to go live using the production API, use `api.modrinth.com` instead of `staging-api.modrinth.com`.  ## Authentication This API has two options for authentication: personal access tokens and [OAuth2](https://en.wikipedia.org/wiki/OAuth). All tokens are tied to a Modrinth user and use the `Authorization` header of the request.  Example: ``` Authorization: mrp_RNtLRSPmGj2pd1v1ubi52nX7TJJM9sznrmwhAuj511oe4t1jAqAQ3D6Wc8Ic ```  You do not need a token for most requests. Generally speaking, only the following types of requests require a token: - those which create data (such as version creation) - those which modify data (such as editing a project) - those which access private data (such as draft projects, notifications, emails, and payout data)  Each request requiring authentication has a certain scope. For example, to view the email of the user being requested, the token must have the `USER_READ_EMAIL` scope. You can find the list of available scopes [on GitHub](https://github.com/modrinth/labrinth/blob/master/src/models/pats.rs#L15). Making a request with an invalid scope will return a 401 error.  Please note that certain scopes and requests cannot be completed with a personal access token or using OAuth. For example, deleting a user account can only be done through Modrinth's frontend.  ### OAuth2 Applications interacting with an authenticated API should create an OAuth2 application. You can do this in [the developer settings](https://modrinth.com/settings/applications).  Make sure to save your application secret, as you will not be able to access it after you leave the page.  Once you have created a client, use the following URL to have a user authorize your client: ``` https://modrinth.com/auth/authorize?client_id=<CLIENT_ID>&redirect_uri=<CALLBACK_URL>&scope=<SCOPE_ONE>+<SCOPE_TWO>+<SCOPE_THREE> ``` > You can get a list of all scope names [here](https://github.com/modrinth/code/tree/main/apps/labrinth/src/models/v3/pats.rs).  Then, send a `POST` request to the following URL to get the token:  ``` https://api.modrinth.com/_internal/oauth/token ```  > Note that you will need to provide your application's secret under the Authorization header.  In the body of your request, make sure to include the following: - `code`: The code generated when authorizing your client - `client_id`: Your client ID (found in developer settings) - `redirect_uri`: A valid redirect URI provided in your application's settings - `grant_type`: This will need to be `authorization_code`.  If your token request fails for any reason, you will need to get another code from the authorization process.  This route will be changed in the future to move the `_internal` part to `v3`.  ### Personal access tokens Personal access tokens (PATs) can be generated in from [the user settings](https://modrinth.com/settings/account).  ### GitHub tokens For backwards compatibility purposes, some types of GitHub tokens also work for authenticating a user with Modrinth's API, granting all scopes. **We urge any application still using GitHub tokens to start using personal access tokens for security and reliability purposes.** GitHub tokens will cease to function to authenticate with Modrinth's API as soon as version 3 of the API is made generally available.  ## Cross-Origin Resource Sharing This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/). This allows for cross-domain communication from the browser. All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.  ## Identifiers The majority of items you can interact with in the API have a unique eight-digit base62 ID. Projects, versions, users, threads, teams, and reports all use this same way of identifying themselves. Version files use the sha1 or sha512 file hashes as identifiers.  Each project and user has a friendlier way of identifying them; slugs and usernames, respectively. While unique IDs are constant, slugs and usernames can change at any moment. If you want to store something in the long term, it is recommended to use the unique ID.  ## Ratelimits The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers. - `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute - `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window - `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets  Ratelimits are the same no matter whether you use a token or not. The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:admin@modrinth.com).  ## User Agents To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header. Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic. It is recommended, but not required, to include contact information in your user agent. This allows us to contact you if we would like a change in your application's behavior without having to block your traffic. - Bad: `User-Agent: okhttp/4.9.3` - Good: `User-Agent: project_name` - Better: `User-Agent: github_username/project_name/1.56.0` - Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`  ## Versioning Modrinth follows a simple pattern for its API versioning. In the event of a breaking API change, the API version in the URL path is bumped, and migration steps will be published below.  When an API is no longer the current one, it will immediately be considered deprecated. No more support will be provided for API versions older than the current one. It will be kept for some time, but this amount of time is not certain.  We will exercise various tactics to get people to update their implementation of our API. One example is by adding something like `STOP USING THIS API` to various data returned by the API.  Once an API version is completely deprecated, it will permanently return a 410 error. Please ensure your application handles these 410 errors.  ### Migrations Inside the following spoiler, you will be able to find all changes between versions of the Modrinth API, accompanied by tips and a guide to migrate applications to newer versions.  Here, you can also find changes for [Minotaur](https://github.com/modrinth/minotaur), Modrinth's official Gradle plugin. Major versions of Minotaur directly correspond to major versions of the Modrinth API.  <details><summary>API v1 to API v2</summary>  These bullet points cover most changes in the v2 API, but please note that fields containing `mod` in most contexts have been shifted to `project`.  For example, in the search route, the field `mod_id` was renamed to `project_id`.  - The search route has been moved from `/api/v1/mod` to `/v2/search` - New project fields: `project_type` (may be `mod` or `modpack`), `moderation_message` (which has a `message` and `body`), `gallery` - New search facet: `project_type` - Alphabetical sort removed (it didn't work and is not possible due to limits in MeiliSearch) - New search fields: `project_type`, `gallery`   - The gallery field is an array of URLs to images that are part of the project's gallery - The gallery is a new feature which allows the user to upload images showcasing their mod to the CDN which will be displayed on their mod page - Internal change: Any project file uploaded to Modrinth is now validated to make sure it's a valid Minecraft mod, Modpack, etc.   - For example, a Forge 1.17 mod with a JAR not containing a mods.toml will not be allowed to be uploaded to Modrinth - In project creation, projects may not upload a mod with no versions to review, however they can be saved as a draft   - Similarly, for version creation, a version may not be uploaded without any files - Donation URLs have been enabled - New project status: `archived`. Projects with this status do not appear in search - Tags (such as categories, loaders) now have icons (SVGs) and specific project types attached - Dependencies have been wiped and replaced with a new system - Notifications now have a `type` field, such as `project_update`  Along with this, project subroutes (such as `/v2/project/{id}/version`) now allow the slug to be used as the ID. This is also the case with user routes.  </details><details><summary>Minotaur v1 to Minotaur v2</summary>  Minotaur 2.x introduced a few breaking changes to how your buildscript is formatted.  First, instead of registering your own `publishModrinth` task, Minotaur now automatically creates a `modrinth` task. As such, you can replace the `task publishModrinth(type: TaskModrinthUpload) {` line with just `modrinth {`.  To declare supported Minecraft versions and mod loaders, the `gameVersions` and `loaders` arrays must now be used. The syntax for these are pretty self-explanatory.  Instead of using `releaseType`, you must now use `versionType`. This was actually changed in v1.2.0, but very few buildscripts have moved on from v1.1.0.  Dependencies have been changed to a special DSL. Create a `dependencies` block within the `modrinth` block, and then use `scope.type(\"project/version\")`. For example, `required.project(\"fabric-api\")` adds a required project dependency on Fabric API.  You may now use the slug anywhere that a project ID was previously required.  </details>
 *
 * The version of the OpenAPI document: v2.7.0/15cf3fc
 * Contact: support@modrinth.com
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.11.0
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
 * Project Class Doc Comment
 *
 * @category Class
 * @package  Aternos\ModrinthApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class Project implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'Project';

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
        'project_type' => 'string',
        'downloads' => 'int',
        'icon_url' => 'string',
        'color' => 'int',
        'thread_id' => 'string',
        'monetization_status' => 'string',
        'id' => 'string',
        'team' => 'string',
        'body_url' => 'string',
        'moderator_message' => '\Aternos\ModrinthApi\Model\ModeratorMessage',
        'published' => 'string',
        'updated' => 'string',
        'approved' => 'string',
        'queued' => 'string',
        'followers' => 'int',
        'license' => '\Aternos\ModrinthApi\Model\ProjectLicense',
        'versions' => 'string[]',
        'game_versions' => 'string[]',
        'loaders' => 'string[]',
        'gallery' => '\Aternos\ModrinthApi\Model\GalleryImage[]'
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
        'project_type' => null,
        'downloads' => null,
        'icon_url' => null,
        'color' => null,
        'thread_id' => null,
        'monetization_status' => null,
        'id' => null,
        'team' => null,
        'body_url' => null,
        'moderator_message' => null,
        'published' => 'ISO-8601',
        'updated' => 'ISO-8601',
        'approved' => 'ISO-8601',
        'queued' => 'ISO-8601',
        'followers' => null,
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
        'project_type' => false,
        'downloads' => false,
        'icon_url' => true,
        'color' => true,
        'thread_id' => false,
        'monetization_status' => false,
        'id' => false,
        'team' => false,
        'body_url' => true,
        'moderator_message' => true,
        'published' => false,
        'updated' => false,
        'approved' => true,
        'queued' => true,
        'followers' => false,
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
        'project_type' => 'project_type',
        'downloads' => 'downloads',
        'icon_url' => 'icon_url',
        'color' => 'color',
        'thread_id' => 'thread_id',
        'monetization_status' => 'monetization_status',
        'id' => 'id',
        'team' => 'team',
        'body_url' => 'body_url',
        'moderator_message' => 'moderator_message',
        'published' => 'published',
        'updated' => 'updated',
        'approved' => 'approved',
        'queued' => 'queued',
        'followers' => 'followers',
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
        'project_type' => 'setProjectType',
        'downloads' => 'setDownloads',
        'icon_url' => 'setIconUrl',
        'color' => 'setColor',
        'thread_id' => 'setThreadId',
        'monetization_status' => 'setMonetizationStatus',
        'id' => 'setId',
        'team' => 'setTeam',
        'body_url' => 'setBodyUrl',
        'moderator_message' => 'setModeratorMessage',
        'published' => 'setPublished',
        'updated' => 'setUpdated',
        'approved' => 'setApproved',
        'queued' => 'setQueued',
        'followers' => 'setFollowers',
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
        'project_type' => 'getProjectType',
        'downloads' => 'getDownloads',
        'icon_url' => 'getIconUrl',
        'color' => 'getColor',
        'thread_id' => 'getThreadId',
        'monetization_status' => 'getMonetizationStatus',
        'id' => 'getId',
        'team' => 'getTeam',
        'body_url' => 'getBodyUrl',
        'moderator_message' => 'getModeratorMessage',
        'published' => 'getPublished',
        'updated' => 'getUpdated',
        'approved' => 'getApproved',
        'queued' => 'getQueued',
        'followers' => 'getFollowers',
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

    public const CLIENT_SIDE_REQUIRED = 'required';
    public const CLIENT_SIDE_OPTIONAL = 'optional';
    public const CLIENT_SIDE_UNSUPPORTED = 'unsupported';
    public const CLIENT_SIDE_UNKNOWN = 'unknown';
    public const SERVER_SIDE_REQUIRED = 'required';
    public const SERVER_SIDE_OPTIONAL = 'optional';
    public const SERVER_SIDE_UNSUPPORTED = 'unsupported';
    public const SERVER_SIDE_UNKNOWN = 'unknown';
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
    public const PROJECT_TYPE_MOD = 'mod';
    public const PROJECT_TYPE_MODPACK = 'modpack';
    public const PROJECT_TYPE_RESOURCEPACK = 'resourcepack';
    public const PROJECT_TYPE_SHADER = 'shader';
    public const MONETIZATION_STATUS_MONETIZED = 'monetized';
    public const MONETIZATION_STATUS_DEMONETIZED = 'demonetized';
    public const MONETIZATION_STATUS_FORCE_DEMONETIZED = 'force-demonetized';

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
            self::CLIENT_SIDE_UNKNOWN,
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
            self::SERVER_SIDE_UNKNOWN,
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
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getProjectTypeAllowableValues()
    {
        return [
            self::PROJECT_TYPE_MOD,
            self::PROJECT_TYPE_MODPACK,
            self::PROJECT_TYPE_RESOURCEPACK,
            self::PROJECT_TYPE_SHADER,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getMonetizationStatusAllowableValues()
    {
        return [
            self::MONETIZATION_STATUS_MONETIZED,
            self::MONETIZATION_STATUS_DEMONETIZED,
            self::MONETIZATION_STATUS_FORCE_DEMONETIZED,
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
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
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
        $this->setIfExists('project_type', $data ?? [], null);
        $this->setIfExists('downloads', $data ?? [], null);
        $this->setIfExists('icon_url', $data ?? [], null);
        $this->setIfExists('color', $data ?? [], null);
        $this->setIfExists('thread_id', $data ?? [], null);
        $this->setIfExists('monetization_status', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('team', $data ?? [], null);
        $this->setIfExists('body_url', $data ?? [], null);
        $this->setIfExists('moderator_message', $data ?? [], null);
        $this->setIfExists('published', $data ?? [], null);
        $this->setIfExists('updated', $data ?? [], null);
        $this->setIfExists('approved', $data ?? [], null);
        $this->setIfExists('queued', $data ?? [], null);
        $this->setIfExists('followers', $data ?? [], null);
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

        if ($this->container['slug'] === null) {
            $invalidProperties[] = "'slug' can't be null";
        }
        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['categories'] === null) {
            $invalidProperties[] = "'categories' can't be null";
        }
        if ($this->container['client_side'] === null) {
            $invalidProperties[] = "'client_side' can't be null";
        }
        $allowedValues = $this->getClientSideAllowableValues();
        if (!is_null($this->container['client_side']) && !in_array($this->container['client_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'client_side', must be one of '%s'",
                $this->container['client_side'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['server_side'] === null) {
            $invalidProperties[] = "'server_side' can't be null";
        }
        $allowedValues = $this->getServerSideAllowableValues();
        if (!is_null($this->container['server_side']) && !in_array($this->container['server_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'server_side', must be one of '%s'",
                $this->container['server_side'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['body'] === null) {
            $invalidProperties[] = "'body' can't be null";
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

        $allowedValues = $this->getRequestedStatusAllowableValues();
        if (!is_null($this->container['requested_status']) && !in_array($this->container['requested_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'requested_status', must be one of '%s'",
                $this->container['requested_status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['project_type'] === null) {
            $invalidProperties[] = "'project_type' can't be null";
        }
        $allowedValues = $this->getProjectTypeAllowableValues();
        if (!is_null($this->container['project_type']) && !in_array($this->container['project_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'project_type', must be one of '%s'",
                $this->container['project_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['downloads'] === null) {
            $invalidProperties[] = "'downloads' can't be null";
        }
        $allowedValues = $this->getMonetizationStatusAllowableValues();
        if (!is_null($this->container['monetization_status']) && !in_array($this->container['monetization_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'monetization_status', must be one of '%s'",
                $this->container['monetization_status'],
                implode("', '", $allowedValues)
            );
        }

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
     * @return string
     */
    public function getSlug()
    {
        return $this->container['slug'];
    }

    /**
     * Sets slug
     *
     * @param string $slug The slug of a project, used for vanity URLs. Regex: ```^[\\w!@$()`.+,\"\\-']{3,64}$```
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
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title The title or name of the project
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
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description A short description of the project
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
     * @return string[]
     */
    public function getCategories()
    {
        return $this->container['categories'];
    }

    /**
     * Sets categories
     *
     * @param string[] $categories A list of the categories that the project has
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
     * @return string
     */
    public function getClientSide()
    {
        return $this->container['client_side'];
    }

    /**
     * Sets client_side
     *
     * @param string $client_side The client side support of the project
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
     * @return string
     */
    public function getServerSide()
    {
        return $this->container['server_side'];
    }

    /**
     * Sets server_side
     *
     * @param string $server_side The server side support of the project
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
     * @return string
     */
    public function getBody()
    {
        return $this->container['body'];
    }

    /**
     * Sets body
     *
     * @param string $body A long form description of the project
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
     * Gets project_type
     *
     * @return string
     */
    public function getProjectType()
    {
        return $this->container['project_type'];
    }

    /**
     * Sets project_type
     *
     * @param string $project_type The project type of the project
     *
     * @return self
     */
    public function setProjectType($project_type)
    {
        if (is_null($project_type)) {
            throw new \InvalidArgumentException('non-nullable project_type cannot be null');
        }
        $allowedValues = $this->getProjectTypeAllowableValues();
        if (!in_array($project_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'project_type', must be one of '%s'",
                    $project_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['project_type'] = $project_type;

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
     * @param int $downloads The total number of downloads of the project
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
     * Gets icon_url
     *
     * @return string|null
     */
    public function getIconUrl()
    {
        return $this->container['icon_url'];
    }

    /**
     * Sets icon_url
     *
     * @param string|null $icon_url The URL of the project's icon
     *
     * @return self
     */
    public function setIconUrl($icon_url)
    {
        if (is_null($icon_url)) {
            array_push($this->openAPINullablesSetToNull, 'icon_url');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('icon_url', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['icon_url'] = $icon_url;

        return $this;
    }

    /**
     * Gets color
     *
     * @return int|null
     */
    public function getColor()
    {
        return $this->container['color'];
    }

    /**
     * Sets color
     *
     * @param int|null $color The RGB color of the project, automatically generated from the project icon
     *
     * @return self
     */
    public function setColor($color)
    {
        if (is_null($color)) {
            array_push($this->openAPINullablesSetToNull, 'color');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('color', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['color'] = $color;

        return $this;
    }

    /**
     * Gets thread_id
     *
     * @return string|null
     */
    public function getThreadId()
    {
        return $this->container['thread_id'];
    }

    /**
     * Sets thread_id
     *
     * @param string|null $thread_id The ID of the moderation thread associated with this project
     *
     * @return self
     */
    public function setThreadId($thread_id)
    {
        if (is_null($thread_id)) {
            throw new \InvalidArgumentException('non-nullable thread_id cannot be null');
        }
        $this->container['thread_id'] = $thread_id;

        return $this;
    }

    /**
     * Gets monetization_status
     *
     * @return string|null
     */
    public function getMonetizationStatus()
    {
        return $this->container['monetization_status'];
    }

    /**
     * Sets monetization_status
     *
     * @param string|null $monetization_status monetization_status
     *
     * @return self
     */
    public function setMonetizationStatus($monetization_status)
    {
        if (is_null($monetization_status)) {
            throw new \InvalidArgumentException('non-nullable monetization_status cannot be null');
        }
        $allowedValues = $this->getMonetizationStatusAllowableValues();
        if (!in_array($monetization_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'monetization_status', must be one of '%s'",
                    $monetization_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['monetization_status'] = $monetization_status;

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
     * @return \Aternos\ModrinthApi\Model\ModeratorMessage|null
     * @deprecated
     */
    public function getModeratorMessage()
    {
        return $this->container['moderator_message'];
    }

    /**
     * Sets moderator_message
     *
     * @param \Aternos\ModrinthApi\Model\ModeratorMessage|null $moderator_message moderator_message
     *
     * @return self
     * @deprecated
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
     * @param string|null $approved The date the project's status was set to an approved status
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
     * Gets queued
     *
     * @return string|null
     */
    public function getQueued()
    {
        return $this->container['queued'];
    }

    /**
     * Sets queued
     *
     * @param string|null $queued The date the project's status was submitted to moderators for review
     *
     * @return self
     */
    public function setQueued($queued)
    {
        if (is_null($queued)) {
            array_push($this->openAPINullablesSetToNull, 'queued');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('queued', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['queued'] = $queued;

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
     * Gets license
     *
     * @return \Aternos\ModrinthApi\Model\ProjectLicense|null
     */
    public function getLicense()
    {
        return $this->container['license'];
    }

    /**
     * Sets license
     *
     * @param \Aternos\ModrinthApi\Model\ProjectLicense|null $license license
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
     * @return \Aternos\ModrinthApi\Model\GalleryImage[]|null
     */
    public function getGallery()
    {
        return $this->container['gallery'];
    }

    /**
     * Sets gallery
     *
     * @param \Aternos\ModrinthApi\Model\GalleryImage[]|null $gallery A list of images that have been uploaded to the project's gallery
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


