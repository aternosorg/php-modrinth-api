# # BaseVersion

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | The name of this version | [optional]
**version_number** | **string** | The version number. Ideally will follow semantic versioning | [optional]
**changelog** | **string** | The changelog for this version | [optional]
**dependencies** | [**\Aternos\ModrinthApi\Model\VersionDependency[]**](VersionDependency.md) | A list of specific versions of projects that this version depends on | [optional]
**game_versions** | **string[]** | A list of versions of Minecraft that this version supports | [optional]
**version_type** | **string** | The release channel for this version | [optional]
**loaders** | **string[]** | The mod loaders that this version supports | [optional]
**featured** | **bool** | Whether the version is featured or not | [optional]
**status** | **string** |  | [optional]
**requested_status** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
