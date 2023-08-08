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
$hash = 619e250c133106bacc3e3b560839bd4b324dfda8; // string | The hash of the file, considering its byte content, and encoded in hexadecimal
$algorithm = sha512; // string | The algorithm of the hash
$version_id = ["IIJJKKLL"]; // string | Version ID to delete the version from, if multiple files of the same hash exist

try {
    $apiInstance->deleteFileFromHash($hash, $algorithm, $version_id);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->deleteFileFromHash: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash** | **string**| The hash of the file, considering its byte content, and encoded in hexadecimal | |
| **algorithm** | **string**| The algorithm of the hash | [default to &#39;sha1&#39;] |
| **version_id** | **string**| Version ID to delete the version from, if multiple files of the same hash exist | [optional] |

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
getLatestVersionFromHash($hash, $algorithm, $get_latest_version_from_hash_body): \Aternos\ModrinthApi\Model\Version
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
$hash = 619e250c133106bacc3e3b560839bd4b324dfda8; // string | The hash of the file, considering its byte content, and encoded in hexadecimal
$algorithm = sha512; // string | The algorithm of the hash
$get_latest_version_from_hash_body = new \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody(); // \Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody | Parameters of the updated version requested

try {
    $result = $apiInstance->getLatestVersionFromHash($hash, $algorithm, $get_latest_version_from_hash_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->getLatestVersionFromHash: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash** | **string**| The hash of the file, considering its byte content, and encoded in hexadecimal | |
| **algorithm** | **string**| The algorithm of the hash | [default to &#39;sha1&#39;] |
| **get_latest_version_from_hash_body** | [**\Aternos\ModrinthApi\Model\GetLatestVersionFromHashBody**](../Model/GetLatestVersionFromHashBody.md)| Parameters of the updated version requested | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\Version**](../Model/Version.md)

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
getLatestVersionsFromHashes($get_latest_versions_from_hashes_body): array<string,\Aternos\ModrinthApi\Model\Version>
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
$get_latest_versions_from_hashes_body = new \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody(); // \Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody | Parameters of the updated version requested

try {
    $result = $apiInstance->getLatestVersionsFromHashes($get_latest_versions_from_hashes_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->getLatestVersionsFromHashes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_latest_versions_from_hashes_body** | [**\Aternos\ModrinthApi\Model\GetLatestVersionsFromHashesBody**](../Model/GetLatestVersionsFromHashesBody.md)| Parameters of the updated version requested | [optional] |

### Return type

[**array<string,\Aternos\ModrinthApi\Model\Version>**](../Model/Version.md)

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
versionFromHash($hash, $algorithm, $multiple): \Aternos\ModrinthApi\Model\Version
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
$hash = 619e250c133106bacc3e3b560839bd4b324dfda8; // string | The hash of the file, considering its byte content, and encoded in hexadecimal
$algorithm = sha512; // string | The algorithm of the hash
$multiple = false; // bool | Whether to return multiple results when looking for this hash

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
| **hash** | **string**| The hash of the file, considering its byte content, and encoded in hexadecimal | |
| **algorithm** | **string**| The algorithm of the hash | [default to &#39;sha1&#39;] |
| **multiple** | **bool**| Whether to return multiple results when looking for this hash | [optional] [default to false] |

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

## `versionsFromHashes()`

```php
versionsFromHashes($hash_list): array<string,\Aternos\ModrinthApi\Model\Version>
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
$hash_list = new \Aternos\ModrinthApi\Model\HashList(); // \Aternos\ModrinthApi\Model\HashList | Hashes and algorithm of the versions requested

try {
    $result = $apiInstance->versionsFromHashes($hash_list);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VersionFilesApi->versionsFromHashes: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **hash_list** | [**\Aternos\ModrinthApi\Model\HashList**](../Model/HashList.md)| Hashes and algorithm of the versions requested | [optional] |

### Return type

[**array<string,\Aternos\ModrinthApi\Model\Version>**](../Model/Version.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
