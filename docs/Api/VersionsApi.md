# Aternos\ModrinthApi\VersionsApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**addFilesToVersion()**](VersionsApi.md#addFilesToVersion) | **POST** /version/{id}/file | Add files to version |
| [**createVersion()**](VersionsApi.md#createVersion) | **POST** /version | Create a version |
| [**deleteVersion()**](VersionsApi.md#deleteVersion) | **DELETE** /version/{id} | Delete a version |
| [**getProjectVersions()**](VersionsApi.md#getProjectVersions) | **GET** /project/{id|slug}/version | List project&#39;s versions |
| [**getVersion()**](VersionsApi.md#getVersion) | **GET** /version/{id} | Get a version |
| [**getVersions()**](VersionsApi.md#getVersions) | **GET** /versions | Get multiple versions |
| [**modifyVersion()**](VersionsApi.md#modifyVersion) | **PATCH** /version/{id} | Modify a version |
| [**scheduleVersion()**](VersionsApi.md#scheduleVersion) | **POST** /version/{id}/schedule | Schedule a version |


## `addFilesToVersion()`

```php
addFilesToVersion($id, $data)
```

Add files to version

Project files are attached. `.mrpack` and `.jar` files are accepted.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [IIJJKKLL]; // mixed | The ID of the version
$data = NULL; // mixed

try {
    $apiInstance->addFilesToVersion($id, $data);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->addFilesToVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the version | |
| **data** | [**mixed**](../Model/mixed.md)|  | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createVersion()`

```php
createVersion($data): mixed
```

Create a version

This route creates a version on an existing project. There must be at least one file attached to each new version, unless the new version's status is `draft`. `.mrpack`, `.jar`, `.zip`, and `.litemod` files are accepted.  The request is a [multipart request](https://www.ietf.org/rfc/rfc2388.txt) with at least two form fields: one is `data`, which includes a JSON body with the version metadata as shown below, and at least one field containing an upload file.  You can name the file parts anything you would like, but you must list each of the parts' names in `file_parts`, and optionally, provide one to use as the primary file in `primary_file`.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = NULL; // mixed

try {
    $result = $apiInstance->createVersion($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->createVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **data** | [**mixed**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteVersion()`

```php
deleteVersion($id)
```

Delete a version

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [IIJJKKLL]; // mixed | The ID of the version

try {
    $apiInstance->deleteVersion($id);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->deleteVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the version | |

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

## `getProjectVersions()`

```php
getProjectVersions($id_slug, $loaders, $game_versions, $featured): mixed
```

List project's versions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$loaders = ["fabric"]; // mixed | The types of loaders to filter for
$game_versions = ["1.18.1"]; // mixed | The game versions to filter for
$featured = NULL; // mixed | Allows to filter for featured or non-featured versions only

try {
    $result = $apiInstance->getProjectVersions($id_slug, $loaders, $game_versions, $featured);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->getProjectVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **loaders** | [**mixed**](../Model/.md)| The types of loaders to filter for | [optional] |
| **game_versions** | [**mixed**](../Model/.md)| The game versions to filter for | [optional] |
| **featured** | [**mixed**](../Model/.md)| Allows to filter for featured or non-featured versions only | [optional] |

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

## `getVersion()`

```php
getVersion($id): mixed
```

Get a version

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = [IIJJKKLL]; // mixed | The ID of the version

try {
    $result = $apiInstance->getVersion($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->getVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the version | |

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

## `getVersions()`

```php
getVersions($ids): mixed
```

Get multiple versions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // mixed | The IDs of the versions

try {
    $result = $apiInstance->getVersions($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->getVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | [**mixed**](../Model/.md)| The IDs of the versions | |

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

## `modifyVersion()`

```php
modifyVersion($id, $body)
```

Modify a version

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [IIJJKKLL]; // mixed | The ID of the version
$body = NULL; // mixed | Modified version fields

try {
    $apiInstance->modifyVersion($id, $body);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->modifyVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the version | |
| **body** | **mixed**| Modified version fields | [optional] |

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

## `scheduleVersion()`

```php
scheduleVersion($id, $schedule_version_request)
```

Schedule a version

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = [IIJJKKLL]; // mixed | The ID of the version
$schedule_version_request = new \Aternos\ModrinthApi\Model\ScheduleVersionRequest(); // \Aternos\ModrinthApi\Model\ScheduleVersionRequest | Information about date and requested status

try {
    $apiInstance->scheduleVersion($id, $schedule_version_request);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->scheduleVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | [**mixed**](../Model/.md)| The ID of the version | |
| **schedule_version_request** | [**\Aternos\ModrinthApi\Model\ScheduleVersionRequest**](../Model/ScheduleVersionRequest.md)| Information about date and requested status | [optional] |

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
