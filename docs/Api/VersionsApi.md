# Aternos\ModrinthApi\VersionsApi

Versions contain download links to files with additional metadata.

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**addFilesToVersion()**](VersionsApi.md#addFilesToVersion) | **POST** /version/{id}/file | Add files to version |
| [**createVersion()**](VersionsApi.md#createVersion) | **POST** /version | Create a version |
| [**deleteVersion()**](VersionsApi.md#deleteVersion) | **DELETE** /version/{id} | Delete a version |
| [**getProjectVersions()**](VersionsApi.md#getProjectVersions) | **GET** /project/{id|slug}/version | List project&#39;s versions |
| [**getVersion()**](VersionsApi.md#getVersion) | **GET** /version/{id} | Get a version |
| [**getVersionFromIdOrNumber()**](VersionsApi.md#getVersionFromIdOrNumber) | **GET** /project/{id|slug}/version/{id|number} | Get a version given a version number or ID |
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
$id = ["IIJJKKLL"]; // string | The ID of the version
$data = array('key' => new \stdClass); // object

try {
    $apiInstance->addFilesToVersion($id, $data);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->addFilesToVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the version | |
| **data** | [**object**](../Model/object.md)|  | [optional] |

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
createVersion($data): \Aternos\ModrinthApi\Model\Version
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
$data = new \Aternos\ModrinthApi\Model\CreatableVersion(); // \Aternos\ModrinthApi\Model\CreatableVersion

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
| **data** | [**\Aternos\ModrinthApi\Model\CreatableVersion**](../Model/CreatableVersion.md)|  | |

### Return type

[**\Aternos\ModrinthApi\Model\Version**](../Model/Version.md)

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
$id = ["IIJJKKLL"]; // string | The ID of the version

try {
    $apiInstance->deleteVersion($id);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->deleteVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the version | |

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
getProjectVersions($id_slug, $loaders, $game_versions, $featured, $include_changelog): \Aternos\ModrinthApi\Model\Version[]
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$loaders = ["fabric"]; // string | The types of loaders to filter for
$game_versions = ["1.18.1"]; // string | The game versions to filter for
$featured = True; // bool | Allows to filter for featured or non-featured versions only
$include_changelog = true; // bool | Allows you to toggle the inclusion of the changelog field in the response. It is highly recommended to use include_changelog=false in most cases unless you specifically need the changelog for all versions.

try {
    $result = $apiInstance->getProjectVersions($id_slug, $loaders, $game_versions, $featured, $include_changelog);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->getProjectVersions: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **loaders** | **string**| The types of loaders to filter for | [optional] |
| **game_versions** | **string**| The game versions to filter for | [optional] |
| **featured** | **bool**| Allows to filter for featured or non-featured versions only | [optional] |
| **include_changelog** | **bool**| Allows you to toggle the inclusion of the changelog field in the response. It is highly recommended to use include_changelog&#x3D;false in most cases unless you specifically need the changelog for all versions. | [optional] [default to true] |

### Return type

[**\Aternos\ModrinthApi\Model\Version[]**](../Model/Version.md)

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
getVersion($id): \Aternos\ModrinthApi\Model\Version
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
$id = ["IIJJKKLL"]; // string | The ID of the version

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
| **id** | **string**| The ID of the version | |

### Return type

[**\Aternos\ModrinthApi\Model\Version**](../Model/Version.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVersionFromIdOrNumber()`

```php
getVersionFromIdOrNumber($id_slug, $id_number): \Aternos\ModrinthApi\Model\Version
```

Get a version given a version number or ID

Please note that, if the version number provided matches multiple versions, only the **oldest matching version** will be returned.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$id_number = ["IIJJKKLL"]; // string | The version ID or version number

try {
    $result = $apiInstance->getVersionFromIdOrNumber($id_slug, $id_number);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->getVersionFromIdOrNumber: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **id_number** | **string**| The version ID or version number | |

### Return type

[**\Aternos\ModrinthApi\Model\Version**](../Model/Version.md)

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
getVersions($ids): \Aternos\ModrinthApi\Model\Version[]
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
$ids = ["AABBCCDD", "EEFFGGHH"]; // string | The IDs of the versions

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
| **ids** | **string**| The IDs of the versions | |

### Return type

[**\Aternos\ModrinthApi\Model\Version[]**](../Model/Version.md)

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
modifyVersion($id, $editable_version)
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
$id = ["IIJJKKLL"]; // string | The ID of the version
$editable_version = new \Aternos\ModrinthApi\Model\EditableVersion(); // \Aternos\ModrinthApi\Model\EditableVersion | Modified version fields

try {
    $apiInstance->modifyVersion($id, $editable_version);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->modifyVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the version | |
| **editable_version** | [**\Aternos\ModrinthApi\Model\EditableVersion**](../Model/EditableVersion.md)| Modified version fields | [optional] |

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
scheduleVersion($id, $schedule)
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
$id = ["IIJJKKLL"]; // string | The ID of the version
$schedule = new \Aternos\ModrinthApi\Model\Schedule(); // \Aternos\ModrinthApi\Model\Schedule | Information about date and requested status

try {
    $apiInstance->scheduleVersion($id, $schedule);
} catch (Exception $e) {
    echo 'Exception when calling VersionsApi->scheduleVersion: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the version | |
| **schedule** | [**\Aternos\ModrinthApi\Model\Schedule**](../Model/Schedule.md)| Information about date and requested status | [optional] |

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
