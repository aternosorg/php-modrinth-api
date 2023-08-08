# # VersionAllOf

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the version, encoded as a base62 string |
**project_id** | **string** | The ID of the project this version is for |
**author_id** | **string** | The ID of the author who published this version |
**date_published** | **string** |  |
**downloads** | **int** | The number of times this version has been downloaded |
**changelog_url** | **string** | A link to the changelog for this version. Always null, only kept for legacy compatibility. | [optional]
**files** | [**\Aternos\ModrinthApi\Model\VersionFile[]**](VersionFile.md) | A list of files available for download for this version |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
