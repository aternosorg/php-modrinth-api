# Aternos\ModrinthApi\ProjectsApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**addGalleryImage()**](ProjectsApi.md#addGalleryImage) | **POST** /project/{id|slug}/gallery | Add a gallery image |
| [**changeProjectIcon()**](ProjectsApi.md#changeProjectIcon) | **PATCH** /project/{id|slug}/icon | Change project&#39;s icon |
| [**checkProjectValidity()**](ProjectsApi.md#checkProjectValidity) | **GET** /project/{id|slug}/check | Check project slug/ID validity |
| [**createProject()**](ProjectsApi.md#createProject) | **POST** /project | Create a project |
| [**deleteGalleryImage()**](ProjectsApi.md#deleteGalleryImage) | **DELETE** /project/{id|slug}/gallery | Delete a gallery image |
| [**deleteProject()**](ProjectsApi.md#deleteProject) | **DELETE** /project/{id|slug} | Delete a project |
| [**deleteProjectIcon()**](ProjectsApi.md#deleteProjectIcon) | **DELETE** /project/{id|slug}/icon | Delete project&#39;s icon |
| [**followProject()**](ProjectsApi.md#followProject) | **POST** /project/{id|slug}/follow | Follow a project |
| [**getDependencies()**](ProjectsApi.md#getDependencies) | **GET** /project/{id|slug}/dependencies | Get all of a project&#39;s dependencies |
| [**getProject()**](ProjectsApi.md#getProject) | **GET** /project/{id|slug} | Get a project |
| [**getProjects()**](ProjectsApi.md#getProjects) | **GET** /projects | Get multiple projects |
| [**modifyGalleryImage()**](ProjectsApi.md#modifyGalleryImage) | **PATCH** /project/{id|slug}/gallery | Modify a gallery image |
| [**modifyProject()**](ProjectsApi.md#modifyProject) | **PATCH** /project/{id|slug} | Modify a project |
| [**patchProjects()**](ProjectsApi.md#patchProjects) | **PATCH** /projects | Edit multiple projects |
| [**randomProjects()**](ProjectsApi.md#randomProjects) | **GET** /projects_random | Get a list of random projects |
| [**scheduleProject()**](ProjectsApi.md#scheduleProject) | **POST** /project/{id|slug}/schedule | Schedule a project |
| [**searchProjects()**](ProjectsApi.md#searchProjects) | **GET** /search | Search projects |
| [**unfollowProject()**](ProjectsApi.md#unfollowProject) | **DELETE** /project/{id|slug}/follow | Unfollow a project |


## `addGalleryImage()`

```php
addGalleryImage($id_slug, $ext, $featured, $title, $description, $ordering, $body)
```

Add a gallery image

Modrinth allows you to upload files of up to 5MiB to a project's gallery.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$ext = NULL; // mixed | Image extension
$featured = NULL; // mixed | Whether an image is featured
$title = NULL; // mixed | Title of the image
$description = NULL; // mixed | Description of the image
$ordering = NULL; // mixed | Ordering of the image
$body = NULL; // mixed | New gallery image

try {
    $apiInstance->addGalleryImage($id_slug, $ext, $featured, $title, $description, $ordering, $body);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->addGalleryImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **ext** | [**mixed**](../Model/.md)| Image extension | |
| **featured** | [**mixed**](../Model/.md)| Whether an image is featured | |
| **title** | [**mixed**](../Model/.md)| Title of the image | [optional] |
| **description** | [**mixed**](../Model/.md)| Description of the image | [optional] |
| **ordering** | [**mixed**](../Model/.md)| Ordering of the image | [optional] |
| **body** | **mixed**| New gallery image | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `image/*`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `changeProjectIcon()`

```php
changeProjectIcon($id_slug, $ext, $body)
```

Change project's icon

The new icon may be up to 256KiB in size.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$ext = NULL; // mixed | Image extension
$body = NULL; // mixed

try {
    $apiInstance->changeProjectIcon($id_slug, $ext, $body);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->changeProjectIcon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **ext** | [**mixed**](../Model/.md)| Image extension | |
| **body** | **mixed**|  | [optional] |

### Return type

void (empty response body)

### Authorization

[TokenAuth](../../README.md#TokenAuth)

### HTTP request headers

- **Content-Type**: `image/*`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `checkProjectValidity()`

```php
checkProjectValidity($id_slug): \Aternos\ModrinthApi\Model\CheckProjectValidity200Response
```

Check project slug/ID validity

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $result = $apiInstance->checkProjectValidity($id_slug);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->checkProjectValidity: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

### Return type

[**\Aternos\ModrinthApi\Model\CheckProjectValidity200Response**](../Model/CheckProjectValidity200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createProject()`

```php
createProject($data, $icon): mixed
```

Create a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = NULL; // mixed
$icon = NULL; // mixed | Project icon file

try {
    $result = $apiInstance->createProject($data, $icon);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->createProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **data** | [**mixed**](../Model/mixed.md)|  | |
| **icon** | [**mixed**](../Model/mixed.md)| Project icon file | [optional] |

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

## `deleteGalleryImage()`

```php
deleteGalleryImage($id_slug, $url)
```

Delete a gallery image

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$url = NULL; // mixed | URL link of the image to delete

try {
    $apiInstance->deleteGalleryImage($id_slug, $url);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->deleteGalleryImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **url** | [**mixed**](../Model/.md)| URL link of the image to delete | |

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

## `deleteProject()`

```php
deleteProject($id_slug)
```

Delete a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $apiInstance->deleteProject($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->deleteProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

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

## `deleteProjectIcon()`

```php
deleteProjectIcon($id_slug)
```

Delete project's icon

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $apiInstance->deleteProjectIcon($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->deleteProjectIcon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

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

## `followProject()`

```php
followProject($id_slug)
```

Follow a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $apiInstance->followProject($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->followProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

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

## `getDependencies()`

```php
getDependencies($id_slug): \Aternos\ModrinthApi\Model\ProjectDependencyList
```

Get all of a project's dependencies

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $result = $apiInstance->getDependencies($id_slug);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->getDependencies: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

### Return type

[**\Aternos\ModrinthApi\Model\ProjectDependencyList**](../Model/ProjectDependencyList.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getProject()`

```php
getProject($id_slug): mixed
```

Get a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $result = $apiInstance->getProject($id_slug);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->getProject: ', $e->getMessage(), PHP_EOL;
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

## `getProjects()`

```php
getProjects($ids): mixed
```

Get multiple projects

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // mixed | The IDs of the projects

try {
    $result = $apiInstance->getProjects($ids);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->getProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | [**mixed**](../Model/.md)| The IDs of the projects | |

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

## `modifyGalleryImage()`

```php
modifyGalleryImage($id_slug, $url, $featured, $title, $description, $ordering)
```

Modify a gallery image

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$url = NULL; // mixed | URL link of the image to modify
$featured = NULL; // mixed | Whether the image is featured
$title = NULL; // mixed | New title of the image
$description = NULL; // mixed | New description of the image
$ordering = NULL; // mixed | New ordering of the image

try {
    $apiInstance->modifyGalleryImage($id_slug, $url, $featured, $title, $description, $ordering);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->modifyGalleryImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **url** | [**mixed**](../Model/.md)| URL link of the image to modify | |
| **featured** | [**mixed**](../Model/.md)| Whether the image is featured | [optional] |
| **title** | [**mixed**](../Model/.md)| New title of the image | [optional] |
| **description** | [**mixed**](../Model/.md)| New description of the image | [optional] |
| **ordering** | [**mixed**](../Model/.md)| New ordering of the image | [optional] |

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

## `modifyProject()`

```php
modifyProject($id_slug, $body)
```

Modify a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$body = NULL; // mixed | Modified project fields

try {
    $apiInstance->modifyProject($id_slug, $body);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->modifyProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **body** | **mixed**| Modified project fields | [optional] |

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

## `patchProjects()`

```php
patchProjects($ids, $patch_projects_request)
```

Edit multiple projects

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$ids = ["AABBCCDD", "EEFFGGHH"]; // mixed | The IDs of the projects
$patch_projects_request = new \Aternos\ModrinthApi\Model\PatchProjectsRequest(); // \Aternos\ModrinthApi\Model\PatchProjectsRequest | Fields to edit on all projects specified

try {
    $apiInstance->patchProjects($ids, $patch_projects_request);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->patchProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | [**mixed**](../Model/.md)| The IDs of the projects | |
| **patch_projects_request** | [**\Aternos\ModrinthApi\Model\PatchProjectsRequest**](../Model/PatchProjectsRequest.md)| Fields to edit on all projects specified | [optional] |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `randomProjects()`

```php
randomProjects($count): mixed
```

Get a list of random projects

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$count = 70; // mixed | The number of random projects to return

try {
    $result = $apiInstance->randomProjects($count);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->randomProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **count** | [**mixed**](../Model/.md)| The number of random projects to return | |

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

## `scheduleProject()`

```php
scheduleProject($id_slug, $schedule_project_request)
```

Schedule a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project
$schedule_project_request = new \Aternos\ModrinthApi\Model\ScheduleProjectRequest(); // \Aternos\ModrinthApi\Model\ScheduleProjectRequest | Information about date and requested status

try {
    $apiInstance->scheduleProject($id_slug, $schedule_project_request);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->scheduleProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |
| **schedule_project_request** | [**\Aternos\ModrinthApi\Model\ScheduleProjectRequest**](../Model/ScheduleProjectRequest.md)| Information about date and requested status | [optional] |

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

## `searchProjects()`

```php
searchProjects($query, $facets, $index, $offset, $limit, $filters, $version): \Aternos\ModrinthApi\Model\SearchResults
```

Search projects

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$query = gravestones; // mixed | The query to search for
$facets = [["categories:forge"],["versions:1.17.1"],["project_type:mod"],["license:mit"]]; // mixed | The recommended way of filtering search results. [Learn more about using facets.](/docs/tutorials/api_search)
$index = downloads; // mixed | The sorting method used for sorting search results
$offset = 20; // mixed | The offset into the search. Skips this number of results
$limit = 20; // mixed | The number of results returned by the search
$filters = categories="fabric" AND (categories="technology" OR categories="utility"); // mixed | A list of filters relating to the properties of a project. Use filters when there isn't an available facet for your needs. [More information](https://docs.meilisearch.com/reference/features/filtering.html)
$version = version="1.16.3" OR version="1.16.2" OR version="1.16.1"; // mixed | A list of filters relating to the versions of a project. Use of facets for filtering by version is recommended

try {
    $result = $apiInstance->searchProjects($query, $facets, $index, $offset, $limit, $filters, $version);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->searchProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **query** | [**mixed**](../Model/.md)| The query to search for | [optional] |
| **facets** | [**mixed**](../Model/.md)| The recommended way of filtering search results. [Learn more about using facets.](/docs/tutorials/api_search) | [optional] |
| **index** | [**mixed**](../Model/.md)| The sorting method used for sorting search results | [optional] |
| **offset** | [**mixed**](../Model/.md)| The offset into the search. Skips this number of results | [optional] |
| **limit** | [**mixed**](../Model/.md)| The number of results returned by the search | [optional] |
| **filters** | [**mixed**](../Model/.md)| A list of filters relating to the properties of a project. Use filters when there isn&#39;t an available facet for your needs. [More information](https://docs.meilisearch.com/reference/features/filtering.html) | [optional] |
| **version** | [**mixed**](../Model/.md)| A list of filters relating to the versions of a project. Use of facets for filtering by version is recommended | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\SearchResults**](../Model/SearchResults.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `unfollowProject()`

```php
unfollowProject($id_slug)
```

Unfollow a project

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: TokenAuth
$config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Aternos\ModrinthApi\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new Aternos\ModrinthApi\Api\ProjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_slug = [AABBCCDD, my_project]; // mixed | The ID or slug of the project

try {
    $apiInstance->unfollowProject($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->unfollowProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | [**mixed**](../Model/.md)| The ID or slug of the project | |

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
