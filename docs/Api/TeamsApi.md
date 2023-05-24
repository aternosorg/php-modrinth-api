# Aternos\ModrinthApi\TeamsApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**addTeamMember()**](TeamsApi.md#addTeamMember) | **POST** /team/{id}/members | Add a user to a team |
| [**deleteTeamMember()**](TeamsApi.md#deleteTeamMember) | **DELETE** /team/{id}/members/{user_id} | Remove a member from a team |
| [**getProjectTeamMembers()**](TeamsApi.md#getProjectTeamMembers) | **GET** /project/{id|slug}/members | Get a project&#39;s team members |
| [**getTeamMembers()**](TeamsApi.md#getTeamMembers) | **GET** /team/{id}/members | Get a team&#39;s members |
| [**getTeams()**](TeamsApi.md#getTeams) | **GET** /teams | Get the members of multiple teams |
| [**joinTeam()**](TeamsApi.md#joinTeam) | **POST** /team/{id}/join | Join a team |
| [**modifyTeamMember()**](TeamsApi.md#modifyTeamMember) | **PATCH** /team/{id}/members/{user_id} | Modify a team member&#39;s information |
| [**transferTeamOwnership()**](TeamsApi.md#transferTeamOwnership) | **PATCH** /team/{id}/owner | Transfer team&#39;s ownership to another user |


## `addTeamMember()`

```php
addTeamMember($id, $add_team_member_request)
```

Add a user to a team

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [MMNNOOPP]; // mixed | The ID of the team
$add_team_member_request = new \Aternos\ModrinthApi\Model\AddTeamMemberRequest(); // \Aternos\ModrinthApi\Model\AddTeamMemberRequest | User to be added (must be the ID, usernames cannot be used here)

try {
    $apiInstance->addTeamMember($id, $add_team_member_request);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->addTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the team | |
| **add_team_member_request** | [**\Aternos\ModrinthApi\Model\AddTeamMemberRequest**](../Model/AddTeamMemberRequest.md)| User to be added (must be the ID, usernames cannot be used here) | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteTeamMember()`

```php
deleteTeamMember($id, $id_username)
```

Remove a member from a team

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [MMNNOOPP]; // mixed | The ID of the team
$id_username = [EEFFGGHH, my_user]; // mixed | The ID or username of the user

try {
    $apiInstance->deleteTeamMember($id, $id_username);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->deleteTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the team | |
| **id_username** | [**mixed**](../Model/.md)| The ID or username of the user | |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProjectTeamMembers()`

```php
getProjectTeamMembers($id_slug): mixed
```

Get a project's team members

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $result = $apiInstance->getProjectTeamMembers($id_slug);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getProjectTeamMembers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

### Return type

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTeamMembers()`

```php
getTeamMembers($id): mixed
```

Get a team's members

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [MMNNOOPP]; // mixed | The ID of the team

try {
    $result = $apiInstance->getTeamMembers($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getTeamMembers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the team | |

### Return type

**mixed**

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTeams()`

```php
getTeams($ids): mixed
```

Get the members of multiple teams

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // mixed | The IDs of the teams

try {
    $result = $apiInstance->getTeams($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->getTeams: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | [**mixed**](../Model/.md)| The IDs of the teams | |

### Return type

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `joinTeam()`

```php
joinTeam($id)
```

Join a team

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [MMNNOOPP]; // mixed | The ID of the team

try {
    $apiInstance->joinTeam($id);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->joinTeam: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the team | |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `modifyTeamMember()`

```php
modifyTeamMember($id, $user_id, $modify_team_member_request)
```

Modify a team member's information

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [MMNNOOPP]; // mixed | The ID of the team
$user_id = NULL; // mixed | The ID of the user to modify
$modify_team_member_request = new \Aternos\ModrinthApi\Model\ModifyTeamMemberRequest(); // \Aternos\ModrinthApi\Model\ModifyTeamMemberRequest | Contents to be modified

try {
    $apiInstance->modifyTeamMember($id, $user_id, $modify_team_member_request);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->modifyTeamMember: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the team | |
| **user_id** | [**mixed**](../Model/.md)| The ID of the user to modify | |
| **modify_team_member_request** | [**\Aternos\ModrinthApi\Model\ModifyTeamMemberRequest**](../Model/ModifyTeamMemberRequest.md)| Contents to be modified | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `transferTeamOwnership()`

```php
transferTeamOwnership($id, $add_team_member_request)
```

Transfer team's ownership to another user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\TeamsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [MMNNOOPP]; // mixed | The ID of the team
$add_team_member_request = new \Aternos\ModrinthApi\Model\AddTeamMemberRequest(); // \Aternos\ModrinthApi\Model\AddTeamMemberRequest | New owner's ID

try {
    $apiInstance->transferTeamOwnership($id, $add_team_member_request);
} catch (Exception $e) {
    echo 'Exception when calling TeamsApi->transferTeamOwnership: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the team | |
| **add_team_member_request** | [**\Aternos\ModrinthApi\Model\AddTeamMemberRequest**](../Model/AddTeamMemberRequest.md)| New owner&#39;s ID | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
