# Aternos\ModrinthApi\TagsApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**categoryList()**](TagsApi.md#categoryList) | **GET** /tag/category | Get a list of categories |
| [**donationPlatformList()**](TagsApi.md#donationPlatformList) | **GET** /tag/donation_platform | Get a list of donation platforms |
| [**licenseList()**](TagsApi.md#licenseList) | **GET** /tag/license | Get a list of licenses |
| [**loaderList()**](TagsApi.md#loaderList) | **GET** /tag/loader | Get a list of loaders |
| [**reportTypeList()**](TagsApi.md#reportTypeList) | **GET** /tag/report_type | Get a list of report types |
| [**versionList()**](TagsApi.md#versionList) | **GET** /tag/game_version | Get a list of game versions |


## `categoryList()`

```php
categoryList(): mixed
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

**mixed**

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
donationPlatformList(): mixed
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

**mixed**

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
licenseList(): mixed
```

Get a list of licenses

Gets an array of licenses and information about them

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

**mixed**

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
loaderList(): mixed
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

**mixed**

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
reportTypeList(): mixed
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

**mixed**

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
versionList(): mixed
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

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
