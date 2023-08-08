# # Project

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**slug** | **string** | The slug of a project, used for vanity URLs. Regex: &#x60;&#x60;&#x60;^[\\w!@$()&#x60;.+,\&quot;\\-&#39;]{3,64}$&#x60;&#x60;&#x60; |
**title** | **string** | The title or name of the project |
**description** | **string** | A short description of the project |
**categories** | **string[]** | A list of the categories that the project has |
**client_side** | **string** | The client side support of the project |
**server_side** | **string** | The server side support of the project |
**body** | **string** | A long form description of the project |
**status** | **string** | The status of the project |
**requested_status** | **string** | The requested status when submitting for review or scheduling the project for release | [optional]
**additional_categories** | **string[]** | A list of categories which are searchable but non-primary | [optional]
**issues_url** | **string** | An optional link to where to submit bugs or issues with the project | [optional]
**source_url** | **string** | An optional link to the source code of the project | [optional]
**wiki_url** | **string** | An optional link to the project&#39;s wiki page or other relevant information | [optional]
**discord_url** | **string** | An optional invite link to the project&#39;s discord | [optional]
**donation_urls** | [**\Aternos\ModrinthApi\Model\ProjectDonationURL[]**](ProjectDonationURL.md) | A list of donation links for the project | [optional]
**project_type** | **string** | The project type of the project |
**downloads** | **int** | The total number of downloads of the project |
**icon_url** | **string** | The URL of the project&#39;s icon | [optional]
**color** | **int** | The RGB color of the project, automatically generated from the project icon | [optional]
**thread_id** | **string** | The ID of the moderation thread associated with this project | [optional]
**monetization_status** | **string** |  | [optional]
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
