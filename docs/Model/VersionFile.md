# # VersionFile

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**hashes** | [**\Aternos\ModrinthApi\Model\VersionFileHashes**](VersionFileHashes.md) |  |
**url** | **string** | A direct link to the file |
**filename** | **string** | The name of the file |
**primary** | **bool** | Whether this file is the primary one for its version. Only a maximum of one file per version will have this set to true. If there are not any primary files, it can be inferred that the first file is the primary one. |
**size** | **int** | The size of the file in bytes |
**file_type** | **string** | The type of the additional file, used mainly for adding resource packs to datapacks | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
