# # ProjectAllOf

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the project, encoded as a base62 string |
**team** | **string** | The ID of the team that has ownership of this project |
**body_url** | **string** | The link to the long description of the project. Always null, only kept for legacy compatibility. | [optional]
**moderator_message** | [**\Aternos\ModrinthApi\Model\ModeratorMessage**](ModeratorMessage.md) |  | [optional]
**published** | **string** | The date the project was published |
**updated** | **string** | The date the project was last updated |
**approved** | **string** | The date the project&#39;s status was set to an approved status | [optional]
**queued** | **string** | The date the project&#39;s status was submitted to moderators for review | [optional]
**followers** | **int** | The total number of users following the project |
**license** | [**\Aternos\ModrinthApi\Model\ProjectLicense**](ProjectLicense.md) |  | [optional]
**versions** | **string[]** | A list of the version IDs of the project (will never be empty unless &#x60;draft&#x60; status) | [optional]
**game_versions** | **string[]** | A list of all of the game versions supported by the project | [optional]
**loaders** | **string[]** | A list of all of the loaders supported by the project | [optional]
**gallery** | [**\Aternos\ModrinthApi\Model\GalleryImage[]**](GalleryImage.md) | A list of images that have been uploaded to the project&#39;s gallery | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
