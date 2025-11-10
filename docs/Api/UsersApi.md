# Aternos\ModrinthApi\UsersApi

Users can create projects, join teams, access notifications, manage settings, and follow projects. Admins and moderators have more advanced permissions such as reviewing new projects.

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**changeUserIcon()**](UsersApi.md#changeUserIcon) | **PATCH** /user/{id|username}/icon | Change user&#39;s avatar |
| [**deleteUserIcon()**](UsersApi.md#deleteUserIcon) | **DELETE** /user/{id|username}/icon | Remove user&#39;s avatar |
| [**getFollowedProjects()**](UsersApi.md#getFollowedProjects) | **GET** /user/{id|username}/follows | Get user&#39;s followed projects |
| [**getPayoutHistory()**](UsersApi.md#getPayoutHistory) | **GET** /user/{id|username}/payouts | Get user&#39;s payout history |
| [**getUser()**](UsersApi.md#getUser) | **GET** /user/{id|username} | Get a user |
| [**getUserFromAuth()**](UsersApi.md#getUserFromAuth) | **GET** /user | Get user from authorization header |
| [**getUserProjects()**](UsersApi.md#getUserProjects) | **GET** /user/{id|username}/projects | Get user&#39;s projects |
| [**getUsers()**](UsersApi.md#getUsers) | **GET** /users | Get multiple users |
| [**modifyUser()**](UsersApi.md#modifyUser) | **PATCH** /user/{id|username} | Modify a user |
| [**withdrawPayout()**](UsersApi.md#withdrawPayout) | **POST** /user/{id|username}/payouts | Withdraw payout balance to PayPal or Venmo |


## `changeUserIcon()`

```php
changeUserIcon($id_username, $body)
```

Change user's avatar

The new avatar may be up to 2MiB in size.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user
$body = '/path/to/file.txt'; // \SplFileObject

try {
    $apiInstance->changeUserIcon($id_username, $body);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->changeUserIcon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |
| **body** | **\SplFileObject****\SplFileObject**|  | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `image/png`, `image/jpeg`, `image/bmp`, `image/gif`, `image/webp`, `image/svg`, `image/svgz`, `image/rgb`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteUserIcon()`

```php
deleteUserIcon($id_username)
```

Remove user's avatar

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user

try {
    $apiInstance->deleteUserIcon($id_username);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->deleteUserIcon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |

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

## `getFollowedProjects()`

```php
getFollowedProjects($id_username): \Aternos\ModrinthApi\Model\Project[]
```

Get user's followed projects

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user

try {
    $result = $apiInstance->getFollowedProjects($id_username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getFollowedProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |

### Return type

[**\Aternos\ModrinthApi\Model\Project[]**](../Model/Project.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPayoutHistory()`

```php
getPayoutHistory($id_username): \Aternos\ModrinthApi\Model\UserPayoutHistory
```

Get user's payout history

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user

try {
    $result = $apiInstance->getPayoutHistory($id_username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getPayoutHistory: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |

### Return type

[**\Aternos\ModrinthApi\Model\UserPayoutHistory**](../Model/UserPayoutHistory.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUser()`

```php
getUser($id_username): \Aternos\ModrinthApi\Model\User
```

Get a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user

try {
    $result = $apiInstance->getUser($id_username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |

### Return type

[**\Aternos\ModrinthApi\Model\User**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserFromAuth()`

```php
getUserFromAuth(): \Aternos\ModrinthApi\Model\User
```

Get user from authorization header

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getUserFromAuth();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUserFromAuth: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\User**](../Model/User.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUserProjects()`

```php
getUserProjects($id_username): \Aternos\ModrinthApi\Model\Project[]
```

Get user's projects

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user

try {
    $result = $apiInstance->getUserProjects($id_username);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUserProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |

### Return type

[**\Aternos\ModrinthApi\Model\Project[]**](../Model/Project.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getUsers()`

```php
getUsers($ids): \Aternos\ModrinthApi\Model\User[]
```

Get multiple users

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // string | The IDs of the users

try {
    $result = $apiInstance->getUsers($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->getUsers: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | **string**| The IDs of the users | |

### Return type

[**\Aternos\ModrinthApi\Model\User[]**](../Model/User.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `modifyUser()`

```php
modifyUser($id_username, $editable_user)
```

Modify a user

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user
$editable_user = new \Aternos\ModrinthApi\Model\EditableUser(); // \Aternos\ModrinthApi\Model\EditableUser | Modified user fields

try {
    $apiInstance->modifyUser($id_username, $editable_user);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->modifyUser: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |
| **editable_user** | [**\Aternos\ModrinthApi\Model\EditableUser**](../Model/EditableUser.md)| Modified user fields | [optional] |

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

## `withdrawPayout()`

```php
withdrawPayout($id_username, $amount)
```

Withdraw payout balance to PayPal or Venmo

Warning: certain amounts get withheld for fees. Please do not call this API endpoint without first acknowledging the warnings on the corresponding frontend page.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_username = ["EEFFGGHH","my_user"]; // string | The ID or username of the user
$amount = 56; // int | Amount to withdraw

try {
    $apiInstance->withdrawPayout($id_username, $amount);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->withdrawPayout: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_username** | **string**| The ID or username of the user | |
| **amount** | **int**| Amount to withdraw | |

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
