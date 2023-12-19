# Aternos\ModrinthApi\MiscApi

All URIs are relative to https://api.modrinth.com/v2, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**forgeUpdates()**](MiscApi.md#forgeUpdates) | **GET** /updates/{id|slug}/forge_updates.json | Forge Updates JSON file |
| [**statistics()**](MiscApi.md#statistics) | **GET** /statistics | Various statistics about this Modrinth instance |


## `forgeUpdates()`

```php
forgeUpdates($id_slug): \Aternos\ModrinthApi\Model\ForgeUpdates
```
### URI(s):
- https://api.modrinth.com Production server- https://staging-api.modrinth.com Staging server
Forge Updates JSON file

If you're a Forge mod developer, your Modrinth mods have an automatically generated `updates.json` using the [Forge Update Checker](https://docs.minecraftforge.net/en/latest/misc/updatechecker/).  The only setup is to insert the URL into the `[[mods]]` section of your `mods.toml` file as such:  ```toml [[mods]] # the other stuff here - ID, version, display name, etc.  updateJSONURL = \"https://api.modrinth.com/updates/{slug|ID}/forge_updates.json\" ```  Replace `{slug|id}` with the slug or ID of your project.  Modrinth will handle the rest! When you update your mod, Forge will notify your users that their copy of your mod is out of date.  Make sure that the version format you use for your Modrinth releases is the same as the version format you use in your `mods.toml`. If you use a format such as `1.2.3-forge` or `1.2.3+1.19` with your Modrinth releases but your `mods.toml` only has `1.2.3`, the update checker may not function properly.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new Aternos\ModrinthApi\Api\MiscApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_slug = ["AABBCCDD","my_project"]; // string | The ID or slug of the project

$hostIndex = 0;
$variables = [
];

try {
    $result = $apiInstance->forgeUpdates($id_slug, $hostIndex, $variables);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MiscApi->forgeUpdates: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_slug** | **string**| The ID or slug of the project | |
| hostIndex | null|int | Host index. Defaults to null. If null, then the library will use $this->hostIndex instead | [optional] |
| variables | array | Associative array of variables to pass to the host. Defaults to empty array. | [optional] |


### Return type

[**\Aternos\ModrinthApi\Model\ForgeUpdates**](../Model/ForgeUpdates.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `statistics()`

```php
statistics(): \Aternos\ModrinthApi\Model\Statistics
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

[**\Aternos\ModrinthApi\Model\Statistics**](../Model/Statistics.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
