# # CreatableVersion

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of this version |
**version_number** | **string** | The version number. Ideally will follow semantic versioning |
**changelog** | **string** | The changelog for this version | [optional]
**dependencies** | [**\Aternos\ModrinthApi\Model\VersionDependency[]**](VersionDependency.md) | A list of specific versions of projects that this version depends on |
**game_versions** | **string[]** | A list of versions of Minecraft that this version supports |
**version_type** | **string** | The release channel for this version |
**loaders** | **string[]** | The mod loaders that this version supports. In case of resource packs, use \&quot;minecraft\&quot; |
**featured** | **bool** | Whether the version is featured or not |
**status** | **string** |  | [optional]
**requested_status** | **string** |  | [optional]
**project_id** | **string** | The ID of the project this version is for |
**file_parts** | **string[]** | An array of the multipart field names of each file that goes with this version |
**primary_file** | **string** | The multipart field name of the primary file | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
