# Aternos\ModrinthApi\ThreadsApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**deleteThreadMessage()**](ThreadsApi.md#deleteThreadMessage) | **DELETE** /message/{id} | Delete a thread message |
| [**getOpenReports()**](ThreadsApi.md#getOpenReports) | **GET** /report | Get your open reports |
| [**getReport()**](ThreadsApi.md#getReport) | **GET** /report/{id} | Get report from ID |
| [**getReports()**](ThreadsApi.md#getReports) | **GET** /reports | Get multiple reports |
| [**getThread()**](ThreadsApi.md#getThread) | **GET** /thread/{id} | Get a thread |
| [**getThreads()**](ThreadsApi.md#getThreads) | **GET** /threads | Get multiple threads |
| [**modifyReport()**](ThreadsApi.md#modifyReport) | **PATCH** /report/{id} | Modify a report |
| [**sendThreadMessage()**](ThreadsApi.md#sendThreadMessage) | **POST** /thread/{id} | Send a text message to a thread |
| [**submitReport()**](ThreadsApi.md#submitReport) | **POST** /report | Report a project, user, or version |


## `deleteThreadMessage()`

```php
deleteThreadMessage($id)
```

Delete a thread message

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = ["IIJJKKLL"]; // string | The ID of the message

try {
    $apiInstance->deleteThreadMessage($id);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->deleteThreadMessage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the message | |

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

## `getOpenReports()`

```php
getOpenReports($count): \Aternos\ModrinthApi\Model\Report[]
```

Get your open reports

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$count = 100; // int

try {
    $result = $apiInstance->getOpenReports($count);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->getOpenReports: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **count** | **int**|  | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\Report[]**](../Model/Report.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getReport()`

```php
getReport($id): \Aternos\ModrinthApi\Model\Report
```

Get report from ID

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = ["RRSSTTUU"]; // string | The ID of the report

try {
    $result = $apiInstance->getReport($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->getReport: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the report | |

### Return type

[**\Aternos\ModrinthApi\Model\Report**](../Model/Report.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getReports()`

```php
getReports($ids): \Aternos\ModrinthApi\Model\Report[]
```

Get multiple reports

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // string[] | The IDs of the reports

try {
    $result = $apiInstance->getReports($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->getReports: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | [**string[]**](../Model/string.md)| The IDs of the reports | |

### Return type

[**\Aternos\ModrinthApi\Model\Report[]**](../Model/Report.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getThread()`

```php
getThread($id): \Aternos\ModrinthApi\Model\Thread
```

Get a thread

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = ["QQRRSSTT"]; // string | The ID of the thread

try {
    $result = $apiInstance->getThread($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->getThread: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the thread | |

### Return type

[**\Aternos\ModrinthApi\Model\Thread**](../Model/Thread.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getThreads()`

```php
getThreads($ids): \Aternos\ModrinthApi\Model\Thread[]
```

Get multiple threads

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // string[] | The IDs of the threads

try {
    $result = $apiInstance->getThreads($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->getThreads: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | [**string[]**](../Model/string.md)| The IDs of the threads | |

### Return type

[**\Aternos\ModrinthApi\Model\Thread[]**](../Model/Thread.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `modifyReport()`

```php
modifyReport($id, $modify_report_request)
```

Modify a report

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = ["RRSSTTUU"]; // string | The ID of the report
$modify_report_request = new \Aternos\ModrinthApi\Model\ModifyReportRequest(); // \Aternos\ModrinthApi\Model\ModifyReportRequest | What to modify about the report

try {
    $apiInstance->modifyReport($id, $modify_report_request);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->modifyReport: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the report | |
| **modify_report_request** | [**\Aternos\ModrinthApi\Model\ModifyReportRequest**](../Model/ModifyReportRequest.md)| What to modify about the report | [optional] |

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

## `sendThreadMessage()`

```php
sendThreadMessage($id, $thread_message_body): \Aternos\ModrinthApi\Model\Thread
```

Send a text message to a thread

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = ["QQRRSSTT"]; // string | The ID of the thread
$thread_message_body = new \Aternos\ModrinthApi\Model\ThreadMessageBody(); // \Aternos\ModrinthApi\Model\ThreadMessageBody | The message to be sent. Note that you only need the fields applicable for the `text` type.

try {
    $result = $apiInstance->sendThreadMessage($id, $thread_message_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ThreadsApi->sendThreadMessage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id** | **string**| The ID of the thread | |
| **thread_message_body** | [**\Aternos\ModrinthApi\Model\ThreadMessageBody**](../Model/ThreadMessageBody.md)| The message to be sent. Note that you only need the fields applicable for the &#x60;text&#x60; type. | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\Thread**](../Model/Thread.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitReport()`

```php
submitReport($creatable_report): \Aternos\ModrinthApi\Model\Report
```

Report a project, user, or version

Bring a project, user, or version to the attention of the moderators by reporting it.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ThreadsApi(
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
    echo 'Exception when calling ThreadsApi->submitReport: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **creatable_report** | [**\Aternos\ModrinthApi\Model\CreatableReport**](../Model/CreatableReport.md)| The report to be sent | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\Report**](../Model/Report.md)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
