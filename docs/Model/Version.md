# # Version

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of this version |
**version_number** | **string** | The version number. Ideally will follow semantic versioning |
**changelog** | **string** | The changelog for this version | [optional]
**dependencies** | [**\Aternos\ModrinthApi\Model\VersionDependency[]**](VersionDependency.md) | A list of specific versions of projects that this version depends on | [optional]
**game_versions** | **string[]** | A list of versions of Minecraft that this version supports |
**version_type** | **string** | The release channel for this version |
**loaders** | **string[]** | The mod loaders that this version supports |
**featured** | **bool** | Whether the version is featured or not |
**status** | **string** |  | [optional]
**requested_status** | **string** |  | [optional]
**id** | **string** | The ID of the version, encoded as a base62 string |
**project_id** | **string** | The ID of the project this version is for |
**author_id** | **string** | The ID of the author who published this version |
**date_published** | **string** |  |
**downloads** | **int** | The number of times this version has been downloaded |
**changelog_url** | **string** | A link to the changelog for this version. Always null, only kept for legacy compatibility. | [optional]
**files** | [**\Aternos\ModrinthApi\Model\VersionFile[]**](VersionFile.md) | A list of files available for download for this version |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
