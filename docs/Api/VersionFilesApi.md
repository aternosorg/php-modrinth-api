# Aternos\ModrinthApi\VersionFilesApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deleteFileFromHash()**](VersionFilesApi.md#deleteFileFromHash) | **DELETE** /version_file/{hash} | Delete a file from its hash |
| [**getLatestVersionFromHash()**](VersionFilesApi.md#getLatestVersionFromHash) | **POST** /version_file/{hash}/update | Latest version of a project from a hash, loader(s), and game version(s) |
| [**getLatestVersionsFromHashes()**](VersionFilesApi.md#getLatestVersionsFromHashes) | **POST** /version_files/update | Latest versions of multiple project from hashes, loader(s), and game version(s) |
| [**versionFromHash()**](VersionFilesApi.md#versionFromHash) | **GET** /version_file/{hash} | Get version from hash |
| [**versionsFromHashes()**](VersionFilesApi.md#versionsFromHashes) | **POST** /version_files | Get versions from hashes |


## `deleteFileFromHash()`

```php
deleteFileFromHash($hash, $algorithm, $version_id)
```

Delete a file from its hash

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\VersionFilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$hash = 619e250c133106bacc3e3b560839bd4b324dfda8; // mixed | The hash of the file, considering its byte content, and encoded in hexadecimal
$algorithm = sha512; // mixed | The algorithm of the hash
$version_id = [IIJJKKLL]; // mixed | Version ID to delete the version from, if multiple files of the same hash exist

try {
    $apiInstance->deleteFileFromHash($hash, $algorithm, $version_id);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->deleteFileFromHash: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash** | [**mixed**](../Model/.md)| The hash of the file, considering its byte content, and encoded in hexadecimal | |
| **algorithm** | [**mixed**](../Model/.md)| The algorithm of the hash | [optional] |
| **version_id** | [**mixed**](../Model/.md)| Version ID to delete the version from, if multiple files of the same hash exist | [optional] |

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

## `getLatestVersionFromHash()`

```php
getLatestVersionFromHash($hash, $algorithm, $get_latest_version_from_hash_request): mixed
```

Latest version of a project from a hash, loader(s), and game version(s)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionFilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$hash = 619e250c133106bacc3e3b560839bd4b324dfda8; // mixed | The hash of the file, considering its byte content, and encoded in hexadecimal
$algorithm = sha512; // mixed | The algorithm of the hash
$get_latest_version_from_hash_request = new \Aternos\ModrinthApi\Model\GetLatestVersionFromHashRequest(); // \Aternos\ModrinthApi\Model\GetLatestVersionFromHashRequest | Parameters of the updated version requested

try {
    $result = $apiInstance->getLatestVersionFromHash($hash, $algorithm, $get_latest_version_from_hash_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->getLatestVersionFromHash: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash** | [**mixed**](../Model/.md)| The hash of the file, considering its byte content, and encoded in hexadecimal | |
| **algorithm** | [**mixed**](../Model/.md)| The algorithm of the hash | [optional] |
| **get_latest_version_from_hash_request** | [**\Aternos\ModrinthApi\Model\GetLatestVersionFromHashRequest**](../Model/GetLatestVersionFromHashRequest.md)| Parameters of the updated version requested | [optional] |

### Return type

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getLatestVersionsFromHashes()`

```php
getLatestVersionsFromHashes($get_latest_versions_from_hashes_request): \Aternos\ModrinthApi\Model\VersionsFromHashes200Response
```

Latest versions of multiple project from hashes, loader(s), and game version(s)

This is the same as [`/version_file/{hash}/update`](#operation/getLatestVersionFromHash) except it accepts multiple hashes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionFilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$get_latest_versions_from_hashes_request = new \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesRequest(); // \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesRequest | Parameters of the updated version requested

try {
    $result = $apiInstance->getLatestVersionsFromHashes($get_latest_versions_from_hashes_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->getLatestVersionsFromHashes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_latest_versions_from_hashes_request** | [**\Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesRequest**](../Model/GetLatestVersionsFromHashesRequest.md)| Parameters of the updated version requested | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\VersionsFromHashes200Response**](../Model/VersionsFromHashes200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `versionFromHash()`

```php
versionFromHash($hash, $algorithm, $multiple): mixed
```

Get version from hash

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionFilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$hash = 619e250c133106bacc3e3b560839bd4b324dfda8; // mixed | The hash of the file, considering its byte content, and encoded in hexadecimal
$algorithm = sha512; // mixed | The algorithm of the hash
$multiple = NULL; // mixed | Whether to return multiple results when looking for this hash

try {
    $result = $apiInstance->versionFromHash($hash, $algorithm, $multiple);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->versionFromHash: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash** | [**mixed**](../Model/.md)| The hash of the file, considering its byte content, and encoded in hexadecimal | |
| **algorithm** | [**mixed**](../Model/.md)| The algorithm of the hash | [optional] |
| **multiple** | [**mixed**](../Model/.md)| Whether to return multiple results when looking for this hash | [optional] |

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

## `versionsFromHashes()`

```php
versionsFromHashes($versions_from_hashes_request): \Aternos\ModrinthApi\Model\VersionsFromHashes200Response
```

Get versions from hashes

This is the same as [`/version_file/{hash}`](#operation/versionFromHash) except it accepts multiple hashes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\VersionFilesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$versions_from_hashes_request = new \Aternos\ModrinthApi\Model\VersionsFromHashesRequest(); // \Aternos\ModrinthApi\Model\VersionsFromHashesRequest | Hashes and algorithm of the versions requested

try {
    $result = $apiInstance->versionsFromHashes($versions_from_hashes_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->versionsFromHashes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **versions_from_hashes_request** | [**\Aternos\ModrinthApi\Model\VersionsFromHashesRequest**](../Model/VersionsFromHashesRequest.md)| Hashes and algorithm of the versions requested | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\VersionsFromHashes200Response**](../Model/VersionsFromHashes200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
