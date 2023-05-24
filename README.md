# OpenAPIClient-php

**Remember to join our [Discord](https://discord.gg/EUHuJHt) if you need any support!**

## Authentication
This API uses GitHub tokens for authentication. The token is in the `Authorization` header of the request.

Example:
```
Authorization: gho_pJ9dGXVKpfzZp4PUHSxYEq9hjk0h288Gwj4S
```

You do not need a token for most requests. Generally speaking, only the following types of requests require a token:
- those which create data (such as version creation)
- those which modify data (such as editing a project)
- those which access private data (such as draft projects and notifications)

Applications interacting with the authenticated API should either retrieve the Modrinth GitHub token through the site or create a personal app token for use with Modrinth.
The API provides a couple routes for auth -- don't implement this flow in your application!
Instead, use a personal access token or create your own GitHub OAuth2 application.
This system will be revisited and allow easier interaction with the authenticated subset of the API once we roll out our own authentication system.

## Cross-Origin Resource Sharing
This API features Cross-Origin Resource Sharing (CORS) implemented in compliance with the [W3C spec](https://www.w3.org/TR/cors/).
This allows for cross-domain communication from the browser.
All responses have a wildcard same-origin which makes them completely public and accessible to everyone, including any code on any site.

## Ratelimits
The API has a ratelimit defined per IP. Limits and remaining amounts are given in the response headers.
- `X-Ratelimit-Limit`: the maximum number of requests that can be made in a minute
- `X-Ratelimit-Remaining`: the number of requests remaining in the current ratelimit window
- `X-Ratelimit-Reset`: the time in seconds until the ratelimit window resets

Ratelimits are the same no matter whether you use a token or not.
The ratelimit is currently 300 requests per minute. If you have a use case requiring a higher limit, please [contact us](mailto:admin@modrinth.com).

## User Agents
To access the Modrinth API, you **must** use provide a uniquely-identifying `User-Agent` header.
Providing a user agent that only identifies your HTTP client library (such as \"okhttp/4.9.3\") increases the likelihood that we will block your traffic.
It is recommended, but not required, to include contact information in your user agent.
This allows us to contact you if we would like a change in your application's behavior without having to block your traffic.
- Bad: `User-Agent: okhttp/4.9.3`
- Good: `User-Agent: project_name`
- Better: `User-Agent: github_username/project_name/1.56.0`
- Best: `User-Agent: github_username/project_name/1.56.0 (launcher.com)` or `User-Agent: github_username/project_name/1.56.0 (contact@launcher.com)`



## Installation & Usage

### Requirements

PHP 7.4 and later.
Should also work with PHP 8.0.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getModerationProjects();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->getModerationProjects: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.modrinth.com/v2*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*DefaultApi* | [**getModerationProjects**](docs/Api/DefaultApi.md#getmoderationprojects) | **GET** /moderation/projects | Get a list of processing projects
*DefaultApi* | [**getReports**](docs/Api/DefaultApi.md#getreports) | **GET** /report | Get reports
*MiscApi* | [**statistics**](docs/Api/MiscApi.md#statistics) | **GET** /statistics | Various statistics about this Modrinth instance
*MiscApi* | [**submitReport**](docs/Api/MiscApi.md#submitreport) | **POST** /report | Report a project, user, or version
*ProjectsApi* | [**addGalleryImage**](docs/Api/ProjectsApi.md#addgalleryimage) | **POST** /project/{id|slug}/gallery | Add a gallery image
*ProjectsApi* | [**changeProjectIcon**](docs/Api/ProjectsApi.md#changeprojecticon) | **PATCH** /project/{id|slug}/icon | Change project&#39;s icon
*ProjectsApi* | [**checkProjectValidity**](docs/Api/ProjectsApi.md#checkprojectvalidity) | **GET** /project/{id|slug}/check | Check project slug/ID validity
*ProjectsApi* | [**createProject**](docs/Api/ProjectsApi.md#createproject) | **POST** /project | Create a project
*ProjectsApi* | [**deleteGalleryImage**](docs/Api/ProjectsApi.md#deletegalleryimage) | **DELETE** /project/{id|slug}/gallery | Delete a gallery image
*ProjectsApi* | [**deleteProject**](docs/Api/ProjectsApi.md#deleteproject) | **DELETE** /project/{id|slug} | Delete a project
*ProjectsApi* | [**deleteProjectIcon**](docs/Api/ProjectsApi.md#deleteprojecticon) | **DELETE** /project/{id|slug}/icon | Delete project&#39;s icon
*ProjectsApi* | [**followProject**](docs/Api/ProjectsApi.md#followproject) | **POST** /project/{id|slug}/follow | Follow a project
*ProjectsApi* | [**getDependencies**](docs/Api/ProjectsApi.md#getdependencies) | **GET** /project/{id|slug}/dependencies | Get all of a project&#39;s dependencies
*ProjectsApi* | [**getProject**](docs/Api/ProjectsApi.md#getproject) | **GET** /project/{id|slug} | Get a project
*ProjectsApi* | [**getProjects**](docs/Api/ProjectsApi.md#getprojects) | **GET** /projects | Get multiple projects
*ProjectsApi* | [**modifyGalleryImage**](docs/Api/ProjectsApi.md#modifygalleryimage) | **PATCH** /project/{id|slug}/gallery | Modify a gallery image
*ProjectsApi* | [**modifyProject**](docs/Api/ProjectsApi.md#modifyproject) | **PATCH** /project/{id|slug} | Modify a project
*ProjectsApi* | [**patchProjects**](docs/Api/ProjectsApi.md#patchprojects) | **PATCH** /projects | Edit multiple projects
*ProjectsApi* | [**randomProjects**](docs/Api/ProjectsApi.md#randomprojects) | **GET** /projects_random | Get a list of random projects
*ProjectsApi* | [**scheduleProject**](docs/Api/ProjectsApi.md#scheduleproject) | **POST** /project/{id|slug}/schedule | Schedule a project
*ProjectsApi* | [**searchProjects**](docs/Api/ProjectsApi.md#searchprojects) | **GET** /search | Search projects
*ProjectsApi* | [**unfollowProject**](docs/Api/ProjectsApi.md#unfollowproject) | **DELETE** /project/{id|slug}/follow | Unfollow a project
*TagsApi* | [**categoryList**](docs/Api/TagsApi.md#categorylist) | **GET** /tag/category | Get a list of categories
*TagsApi* | [**donationPlatformList**](docs/Api/TagsApi.md#donationplatformlist) | **GET** /tag/donation_platform | Get a list of donation platforms
*TagsApi* | [**licenseList**](docs/Api/TagsApi.md#licenselist) | **GET** /tag/license | Get a list of licenses
*TagsApi* | [**loaderList**](docs/Api/TagsApi.md#loaderlist) | **GET** /tag/loader | Get a list of loaders
*TagsApi* | [**reportTypeList**](docs/Api/TagsApi.md#reporttypelist) | **GET** /tag/report_type | Get a list of report types
*TagsApi* | [**versionList**](docs/Api/TagsApi.md#versionlist) | **GET** /tag/game_version | Get a list of game versions
*TeamsApi* | [**addTeamMember**](docs/Api/TeamsApi.md#addteammember) | **POST** /team/{id}/members | Add a user to a team
*TeamsApi* | [**deleteTeamMember**](docs/Api/TeamsApi.md#deleteteammember) | **DELETE** /team/{id}/members/{user_id} | Remove a member from a team
*TeamsApi* | [**getProjectTeamMembers**](docs/Api/TeamsApi.md#getprojectteammembers) | **GET** /project/{id|slug}/members | Get a project&#39;s team members
*TeamsApi* | [**getTeamMembers**](docs/Api/TeamsApi.md#getteammembers) | **GET** /team/{id}/members | Get a team&#39;s members
*TeamsApi* | [**getTeams**](docs/Api/TeamsApi.md#getteams) | **GET** /teams | Get the members of multiple teams
*TeamsApi* | [**joinTeam**](docs/Api/TeamsApi.md#jointeam) | **POST** /team/{id}/join | Join a team
*TeamsApi* | [**modifyTeamMember**](docs/Api/TeamsApi.md#modifyteammember) | **PATCH** /team/{id}/members/{user_id} | Modify a team member&#39;s information
*TeamsApi* | [**transferTeamOwnership**](docs/Api/TeamsApi.md#transferteamownership) | **PATCH** /team/{id}/owner | Transfer team&#39;s ownership to another user
*UsersApi* | [**changeUserIcon**](docs/Api/UsersApi.md#changeusericon) | **PATCH** /user/{id|username}/icon | Change user&#39;s avatar
*UsersApi* | [**deleteUser**](docs/Api/UsersApi.md#deleteuser) | **DELETE** /user/{id|username} | Delete a user
*UsersApi* | [**getFollowedProjects**](docs/Api/UsersApi.md#getfollowedprojects) | **GET** /user/{id|username}/follows | Get user&#39;s followed projects
*UsersApi* | [**getNotifications**](docs/Api/UsersApi.md#getnotifications) | **GET** /user/{id|username}/notifications | Get user&#39;s notifications
*UsersApi* | [**getPayoutHistory**](docs/Api/UsersApi.md#getpayouthistory) | **GET** /user/{id|username}/payouts | Get user&#39;s payout history
*UsersApi* | [**getUser**](docs/Api/UsersApi.md#getuser) | **GET** /user/{id|username} | Get a user
*UsersApi* | [**getUserFromAuth**](docs/Api/UsersApi.md#getuserfromauth) | **GET** /user | Get user from authorization header
*UsersApi* | [**getUserProjects**](docs/Api/UsersApi.md#getuserprojects) | **GET** /user/{id|username}/projects | Get user&#39;s projects
*UsersApi* | [**getUsers**](docs/Api/UsersApi.md#getusers) | **GET** /users | Get multiple users
*UsersApi* | [**modifyUser**](docs/Api/UsersApi.md#modifyuser) | **PATCH** /user/{id|username} | Modify a user
*UsersApi* | [**withdrawPayout**](docs/Api/UsersApi.md#withdrawpayout) | **POST** /user/{id|username}/payouts | Withdraw payout balance to PayPal or Venmo
*VersionFilesApi* | [**deleteFileFromHash**](docs/Api/VersionFilesApi.md#deletefilefromhash) | **DELETE** /version_file/{hash} | Delete a file from its hash
*VersionFilesApi* | [**getLatestVersionFromHash**](docs/Api/VersionFilesApi.md#getlatestversionfromhash) | **POST** /version_file/{hash}/update | Latest version of a project from a hash, loader(s), and game version(s)
*VersionFilesApi* | [**getLatestVersionsFromHashes**](docs/Api/VersionFilesApi.md#getlatestversionsfromhashes) | **POST** /version_files/update | Latest versions of multiple project from hashes, loader(s), and game version(s)
*VersionFilesApi* | [**versionFromHash**](docs/Api/VersionFilesApi.md#versionfromhash) | **GET** /version_file/{hash} | Get version from hash
*VersionFilesApi* | [**versionsFromHashes**](docs/Api/VersionFilesApi.md#versionsfromhashes) | **POST** /version_files | Get versions from hashes
*VersionsApi* | [**addFilesToVersion**](docs/Api/VersionsApi.md#addfilestoversion) | **POST** /version/{id}/file | Add files to version
*VersionsApi* | [**createVersion**](docs/Api/VersionsApi.md#createversion) | **POST** /version | Create a version
*VersionsApi* | [**deleteVersion**](docs/Api/VersionsApi.md#deleteversion) | **DELETE** /version/{id} | Delete a version
*VersionsApi* | [**getProjectVersions**](docs/Api/VersionsApi.md#getprojectversions) | **GET** /project/{id|slug}/version | List project&#39;s versions
*VersionsApi* | [**getVersion**](docs/Api/VersionsApi.md#getversion) | **GET** /version/{id} | Get a version
*VersionsApi* | [**getVersions**](docs/Api/VersionsApi.md#getversions) | **GET** /versions | Get multiple versions
*VersionsApi* | [**modifyVersion**](docs/Api/VersionsApi.md#modifyversion) | **PATCH** /version/{id} | Modify a version
*VersionsApi* | [**scheduleVersion**](docs/Api/VersionsApi.md#scheduleversion) | **POST** /version/{id}/schedule | Schedule a version

## Models

- [AddTeamMemberRequest](docs/Model/AddTeamMemberRequest.md)
- [AuthError](docs/Model/AuthError.md)
- [BaseProject](docs/Model/BaseProject.md)
- [BaseVersion](docs/Model/BaseVersion.md)
- [CategoryTag](docs/Model/CategoryTag.md)
- [CheckProjectValidity200Response](docs/Model/CheckProjectValidity200Response.md)
- [CreatableReport](docs/Model/CreatableReport.md)
- [DonationPlatformTag](docs/Model/DonationPlatformTag.md)
- [EditableUser](docs/Model/EditableUser.md)
- [EditableUserPayoutData](docs/Model/EditableUserPayoutData.md)
- [GameVersionTag](docs/Model/GameVersionTag.md)
- [GetLatestVersionFromHashRequest](docs/Model/GetLatestVersionFromHashRequest.md)
- [GetLatestVersionsFromHashesRequest](docs/Model/GetLatestVersionsFromHashesRequest.md)
- [GetPayoutHistory200Response](docs/Model/GetPayoutHistory200Response.md)
- [InvalidInputError](docs/Model/InvalidInputError.md)
- [LicenseTag](docs/Model/LicenseTag.md)
- [LoaderTag](docs/Model/LoaderTag.md)
- [ModifyTeamMemberRequest](docs/Model/ModifyTeamMemberRequest.md)
- [Notification](docs/Model/Notification.md)
- [PatchProjectsRequest](docs/Model/PatchProjectsRequest.md)
- [ProjectDependencyList](docs/Model/ProjectDependencyList.md)
- [ScheduleProjectRequest](docs/Model/ScheduleProjectRequest.md)
- [ScheduleVersionRequest](docs/Model/ScheduleVersionRequest.md)
- [SearchResults](docs/Model/SearchResults.md)
- [Statistics200Response](docs/Model/Statistics200Response.md)
- [TeamMember](docs/Model/TeamMember.md)
- [VersionsFromHashes200Response](docs/Model/VersionsFromHashes200Response.md)
- [VersionsFromHashesRequest](docs/Model/VersionsFromHashesRequest.md)

## Authorization

Authentication schemes defined for the API:
### TokenAuth

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `v2.7.0/3b22f59`
    - Package version: `1.0.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
