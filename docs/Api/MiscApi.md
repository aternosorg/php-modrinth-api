# Aternos\ModrinthApi\MiscApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**statistics()**](MiscApi.md#statistics) | **GET** /statistics | Various statistics about this Modrinth instance |
| [**submitReport()**](MiscApi.md#submitReport) | **POST** /report | Report a project, user, or version |


## `statistics()`

```php
statistics(): \Aternos\ModrinthApi\Model\Statistics200Response
```

Various statistics about this Modrinth instance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\MiscApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->statistics();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MiscApi->statistics: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\Aternos\ModrinthApi\Model\Statistics200Response**](../Model/Statistics200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitReport()`

```php
submitReport($creatable_report): mixed
```

Report a project, user, or version

Bring a project, user, or version to the attention of the moderators by reporting it. You must be logged in to report anything.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\MiscApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$creatable_report = new \Aternos\ModrinthApi\Model\CreatableReport(); // \Aternos\ModrinthApi\Model\CreatableReport | The report to be sent

try {
    $result = $apiInstance->submitReport($creatable_report);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MiscApi->submitReport: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **creatable_report** | [**\Aternos\ModrinthApi\Model\CreatableReport**](../Model/CreatableReport.md)| The report to be sent | [optional] |

### Return type

**mixed**

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
