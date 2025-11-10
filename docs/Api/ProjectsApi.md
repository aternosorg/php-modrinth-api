# Aternos\ModrinthApi\ProjectsApi

Projects are what Modrinth is centered around, be it mods, modpacks, resource packs, etc.

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
| [**patchProjects()**](ProjectsApi.md#patchProjects) | **PATCH** /projects | Bulk-edit multiple projects |
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$ext = 'ext_example'; // string | Image extension
$featured = True; // bool | Whether an image is featured
$title = 'title_example'; // string | Title of the image
$description = 'description_example'; // string | Description of the image
$ordering = 56; // int | Ordering of the image
$body = '/path/to/file.txt'; // \SplFileObject

try {
    $apiInstance->addGalleryImage($id_slug, $ext, $featured, $title, $description, $ordering, $body);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->addGalleryImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **ext** | **string**| Image extension | |
| **featured** | **bool**| Whether an image is featured | |
| **title** | **string**| Title of the image | [optional] |
| **description** | **string**| Description of the image | [optional] |
| **ordering** | **int**| Ordering of the image | [optional] |
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$ext = 'ext_example'; // string | Image extension
$body = '/path/to/file.txt'; // \SplFileObject

try {
    $apiInstance->changeProjectIcon($id_slug, $ext, $body);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->changeProjectIcon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **ext** | **string**| Image extension | |
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

## `checkProjectValidity()`

```php
checkProjectValidity($id_slug): \Aternos\ModrinthApi\Model\ProjectIdentifier
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

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
| **id_slug** | **string**| The ID or slug of the project | |

### Return type

[**\Aternos\ModrinthApi\Model\ProjectIdentifier**](../Model/ProjectIdentifier.md)

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
createProject($data, $icon): \Aternos\ModrinthApi\Model\Project
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
$data = new \Aternos\ModrinthApi\Model\CreatableProject(); // \Aternos\ModrinthApi\Model\CreatableProject
$icon = '/path/to/file.txt'; // \SplFileObject | Project icon file

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
| **data** | [**\Aternos\ModrinthApi\Model\CreatableProject**](../Model/CreatableProject.md)|  | |
| **icon** | **\SplFileObject****\SplFileObject**| Project icon file | [optional] |

### Return type

[**\Aternos\ModrinthApi\Model\Project**](../Model/Project.md)

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$url = 'url_example'; // string | URL link of the image to delete

try {
    $apiInstance->deleteGalleryImage($id_slug, $url);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->deleteGalleryImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **url** | **string**| URL link of the image to delete | |

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

try {
    $apiInstance->deleteProject($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->deleteProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

try {
    $apiInstance->deleteProjectIcon($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->deleteProjectIcon: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

try {
    $apiInstance->followProject($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->followProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

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
| **id_slug** | **string**| The ID or slug of the project | |

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
getProject($id_slug): \Aternos\ModrinthApi\Model\Project
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

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
| **id_slug** | **string**| The ID or slug of the project | |

### Return type

[**\Aternos\ModrinthApi\Model\Project**](../Model/Project.md)

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
getProjects($ids): \Aternos\ModrinthApi\Model\Project[]
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
$ids = ["AABBCCDD", "EEFFGGHH"]; // string | The IDs and/or slugs of the projects

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
| **ids** | **string**| The IDs and/or slugs of the projects | |

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$url = 'url_example'; // string | URL link of the image to modify
$featured = True; // bool | Whether the image is featured
$title = 'title_example'; // string | New title of the image
$description = 'description_example'; // string | New description of the image
$ordering = 56; // int | New ordering of the image

try {
    $apiInstance->modifyGalleryImage($id_slug, $url, $featured, $title, $description, $ordering);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->modifyGalleryImage: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **url** | **string**| URL link of the image to modify | |
| **featured** | **bool**| Whether the image is featured | [optional] |
| **title** | **string**| New title of the image | [optional] |
| **description** | **string**| New description of the image | [optional] |
| **ordering** | **int**| New ordering of the image | [optional] |

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
modifyProject($id_slug, $editable_project)
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$editable_project = new \Aternos\ModrinthApi\Model\EditableProject(); // \Aternos\ModrinthApi\Model\EditableProject | Modified project fields

try {
    $apiInstance->modifyProject($id_slug, $editable_project);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->modifyProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| **editable_project** | [**\Aternos\ModrinthApi\Model\EditableProject**](../Model/EditableProject.md)| Modified project fields | [optional] |

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
patchProjects($ids, $patch_projects_body)
```

Bulk-edit multiple projects

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
$ids = ["AABBCCDD", "EEFFGGHH"]; // string | The IDs and/or slugs of the projects
$patch_projects_body = new \Aternos\ModrinthApi\Model\PatchProjectsBody(); // \Aternos\ModrinthApi\Model\PatchProjectsBody | Fields to edit on all projects specified

try {
    $apiInstance->patchProjects($ids, $patch_projects_body);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->patchProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **ids** | **string**| The IDs and/or slugs of the projects | |
| **patch_projects_body** | [**\Aternos\ModrinthApi\Model\PatchProjectsBody**](../Model/PatchProjectsBody.md)| Fields to edit on all projects specified | [optional] |

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

## `randomProjects()`

```php
randomProjects($count): \Aternos\ModrinthApi\Model\Project[]
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
$count = 70; // int | The number of random projects to return

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
| **count** | **int**| The number of random projects to return | |

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

## `scheduleProject()`

```php
scheduleProject($id_slug, $schedule)
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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project
$schedule = new \Aternos\ModrinthApi\Model\Schedule(); // \Aternos\ModrinthApi\Model\Schedule | Information about date and requested status

try {
    $apiInstance->scheduleProject($id_slug, $schedule);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->scheduleProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
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

## `searchProjects()`

```php
searchProjects($query, $facets, $index, $offset, $limit): \Aternos\ModrinthApi\Model\SearchResults
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
$query = gravestones; // string | The query to search for
$facets = [["categories:forge"],["versions:1.17.1"],["project_type:mod"],["license:mit"]]; // string | Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - `project_type` - `categories` (loaders are lumped in with categories in search) - `versions` - `client_side` - `server_side` - `open_source`  Several others are also available for use, though these should not be used outside very specific use cases. - `title` - `author` - `follows` - `project_id` - `license` - `downloads` - `color` - `created_timestamp` (uses Unix timestamp) - `modified_timestamp` (uses Unix timestamp) - `date_created` (uses ISO-8601 timestamp) - `date_modified` (uses ISO-8601 timestamp)  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is `:` (same as `=`), though you can also use `!=`, `>=`, `>`, `<=`, and `<`. Join together the type, operation, and value, and you've got your string. ``` {type} {operation} {value} ```  Examples: ``` categories = adventure versions != 1.20.1 downloads <= 100 ```  You then join these strings together in arrays to signal `AND` and `OR` operators.  ##### OR All elements in a single array are considered to be joined by OR statements. For example, the search `[[\"versions:1.16.5\", \"versions:1.17.1\"]]` translates to `Projects that support 1.16.5 OR 1.17.1`.  ##### AND Separate arrays are considered to be joined by AND statements. For example, the search `[[\"versions:1.16.5\"], [\"project_type:modpack\"]]` translates to `Projects that support 1.16.5 AND are modpacks`.
$index = downloads; // string | The sorting method used for sorting search results
$offset = 20; // int | The offset into the search. Skips this number of results
$limit = 20; // int | The number of results returned by the search

try {
    $result = $apiInstance->searchProjects($query, $facets, $index, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->searchProjects: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **query** | **string**| The query to search for | [optional] |
| **facets** | **string**| Facets are an essential concept for understanding how to filter out results.  These are the most commonly used facet types: - &#x60;project_type&#x60; - &#x60;categories&#x60; (loaders are lumped in with categories in search) - &#x60;versions&#x60; - &#x60;client_side&#x60; - &#x60;server_side&#x60; - &#x60;open_source&#x60;  Several others are also available for use, though these should not be used outside very specific use cases. - &#x60;title&#x60; - &#x60;author&#x60; - &#x60;follows&#x60; - &#x60;project_id&#x60; - &#x60;license&#x60; - &#x60;downloads&#x60; - &#x60;color&#x60; - &#x60;created_timestamp&#x60; (uses Unix timestamp) - &#x60;modified_timestamp&#x60; (uses Unix timestamp) - &#x60;date_created&#x60; (uses ISO-8601 timestamp) - &#x60;date_modified&#x60; (uses ISO-8601 timestamp)  In order to then use these facets, you need a value to filter by, as well as an operation to perform on this value. The most common operation is &#x60;:&#x60; (same as &#x60;&#x3D;&#x60;), though you can also use &#x60;!&#x3D;&#x60;, &#x60;&gt;&#x3D;&#x60;, &#x60;&gt;&#x60;, &#x60;&lt;&#x3D;&#x60;, and &#x60;&lt;&#x60;. Join together the type, operation, and value, and you&#39;ve got your string. &#x60;&#x60;&#x60; {type} {operation} {value} &#x60;&#x60;&#x60;  Examples: &#x60;&#x60;&#x60; categories &#x3D; adventure versions !&#x3D; 1.20.1 downloads &lt;&#x3D; 100 &#x60;&#x60;&#x60;  You then join these strings together in arrays to signal &#x60;AND&#x60; and &#x60;OR&#x60; operators.  ##### OR All elements in a single array are considered to be joined by OR statements. For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;, \&quot;versions:1.17.1\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 OR 1.17.1&#x60;.  ##### AND Separate arrays are considered to be joined by AND statements. For example, the search &#x60;[[\&quot;versions:1.16.5\&quot;], [\&quot;project_type:modpack\&quot;]]&#x60; translates to &#x60;Projects that support 1.16.5 AND are modpacks&#x60;. | [optional] |
| **index** | **string**| The sorting method used for sorting search results | [optional] [default to &#39;relevance&#39;] |
| **offset** | **int**| The offset into the search. Skips this number of results | [optional] [default to 0] |
| **limit** | **int**| The number of results returned by the search | [optional] [default to 10] |

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
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

try {
    $apiInstance->unfollowProject($id_slug);
} catch (Exception $e) {
    echo 'Exception when calling ProjectsApi->unfollowProject: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |

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
