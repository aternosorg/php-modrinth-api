# Aternos\ModrinthApi\TagsApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**categoryList()**](TagsApi.md#categoryList) | **GET** /tag/category | Get a list of categories |
| [**donationPlatformList()**](TagsApi.md#donationPlatformList) | **GET** /tag/donation_platform | Get a list of donation platforms |
| [**licenseList()**](TagsApi.md#licenseList) | **GET** /tag/license | Get a list of licenses |
| [**licenseText()**](TagsApi.md#licenseText) | **GET** /tag/license/{id} | Get the text and title of a license |
| [**loaderList()**](TagsApi.md#loaderList) | **GET** /tag/loader | Get a list of loaders |
| [**projectTypeList()**](TagsApi.md#projectTypeList) | **GET** /tag/project_type | Get a list of project types |
| [**reportTypeList()**](TagsApi.md#reportTypeList) | **GET** /tag/report_type | Get a list of report types |
| [**sideTypeList()**](TagsApi.md#sideTypeList) | **GET** /tag/side_type | Get a list of side types |
| [**versionList()**](TagsApi.md#versionList) | **GET** /tag/game_version | Get a list of game versions |


## `categoryList()`

```php
categoryList(): \Aternos\ModrinthApi\Model\CategoryTag[]
```

Get a list of categories

Gets an array of categories, their icons, and applicable project types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->categoryList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->categoryList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\CategoryTag[]**](../Model/CategoryTag.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `donationPlatformList()`

```php
donationPlatformList(): \Aternos\ModrinthApi\Model\DonationPlatformTag[]
```

Get a list of donation platforms

Gets an array of donation platforms and information about them

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->donationPlatformList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->donationPlatformList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\DonationPlatformTag[]**](../Model/DonationPlatformTag.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `licenseList()`

```php
licenseList(): \Aternos\ModrinthApi\Model\LicenseTag[]
```

Get a list of licenses

Deprecated - simply use SPDX IDs.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->licenseList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->licenseList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\LicenseTag[]**](../Model/LicenseTag.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `licenseText()`

```php
licenseText($id): \Aternos\ModrinthApi\Model\LicenseText200Response
```

Get the text and title of a license

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id = ["LGPL-3.0-or-later"]; // string | The license ID to get the text of

try {
    $result = $apiInstance->licenseText($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->licenseText: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The license ID to get the text of | |

### Return type

[**\Aternos\ModrinthApi\Model\LicenseText200Response**](../Model/LicenseText200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `loaderList()`

```php
loaderList(): \Aternos\ModrinthApi\Model\LoaderTag[]
```

Get a list of loaders

Gets an array of loaders, their icons, and supported project types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->loaderList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->loaderList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\LoaderTag[]**](../Model/LoaderTag.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `projectTypeList()`

```php
projectTypeList(): string[]
```

Get a list of project types

Gets an array of valid project types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->projectTypeList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->projectTypeList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**string[]**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `reportTypeList()`

```php
reportTypeList(): string[]
```

Get a list of report types

Gets an array of valid report types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->reportTypeList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->reportTypeList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**string[]**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `sideTypeList()`

```php
sideTypeList(): string[]
```

Get a list of side types

Gets an array of valid side types

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->sideTypeList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->sideTypeList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**string[]**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `versionList()`

```php
versionList(): \Aternos\ModrinthApi\Model\GameVersionTag[]
```

Get a list of game versions

Gets an array of game versions and information about them

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\TagsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->versionList();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling TagsApi->versionList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\GameVersionTag[]**](../Model/GameVersionTag.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
