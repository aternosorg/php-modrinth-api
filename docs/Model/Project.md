# Project

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The ID of the project, encoded as a base62 string |
**team** | **string** | The ID of the team that has ownership of this project |
**title** | **string** | The title or name of the project |
**description** | **string** | A short sentence summarizing the project, no more than a sentence or two. |
**body** | **string** | A long form description of the project |
**status** | **string** | The status of the project |
**project_type** | **string** | The project type of the project |
**categories** | **string[]** | A list of the featured categories that the project has. |
**additional_categories** | **string[]** | A list of additional categories that the project also has. These are supplementary to the featured categories, and does not include them again. |
**environment** | [**\Aternos\ModrinthApi\Model\EnvironmentEnum[]**](EnvironmentEnum.md) | All the environments that versions of this project support. Not in any particular order, we recommend using the environment information on a version instead. For an explanation of each environment, see the blog post here: https://modrinth.com/news/article/new-environments/#new-system |
**game_versions** | **string[]** | A list of all of the game versions supported by the project |
**loaders** | **string[]** | A list of all of the loaders supported by the project. These vary based on project type. |
**versions** | **string[]** | A list of the version IDs of the project |
**license** | [**\Aternos\ModrinthApi\Model\ProjectLicense**](ProjectLicense.md) |  |
**published** | **string** | The date the project was created |
**updated** | **string** | The date the latest version of the project was created |
**downloads** | **int** | The total number of downloads of the project |
**followers** | **int** | The total number of users following the project |
**gallery** | [**\Aternos\ModrinthApi\Model\GalleryImage[]**](GalleryImage.md) | A list of images that have been uploaded to the project&#39;s gallery |
**thread_id** | **string** | The ID of the moderation thread associated with this project |
**monetization_status** | **string** |  |
**slug** | **string** | The slug of a project, used for vanity URLs. Regex: &#x60;&#x60;&#x60;^[\\w!@$()&#x60;.+,\&quot;\\-&#39;]{3,64}$&#x60;&#x60;&#x60; | [optional]
**organization** | **string** | The ID of the organization that owns this project | [optional]
**requested_status** | **string** | The requested status when submitting for review or scheduling the project for release. Approved status refers to \&quot;Public\&quot; visibility. | [optional]
**approved** | **string** | The date the project was first published | [optional]
**queued** | **string** | The date the project&#39;s status was submitted to moderators for review | [optional]
**icon_url** | **string** | The URL of the project&#39;s icon | [optional]
**raw_icon_url** | **string** | The URL of the project&#39;s icon without CDN transforms applied | [optional]
**color** | **int** | The RGB color of the project, automatically generated from the project icon | [optional]
**issues_url** | **string** | An optional link to where to submit bugs or issues with the project | [optional]
**source_url** | **string** | An optional link to the source code of the project | [optional]
**wiki_url** | **string** | An optional link to the project&#39;s wiki page or other relevant information | [optional]
**discord_url** | **string** | An optional invite link to the project&#39;s discord. | [optional]
**donation_urls** | [**\Aternos\ModrinthApi\Model\ProjectDonationURL[]**](ProjectDonationURL.md) | A list of donation links for the project | [optional]
**client_side** | **string** | Deprecated - use &#x60;environment&#x60; instead. |
**server_side** | **string** | Deprecated - use &#x60;environment&#x60; instead. |
**body_url** | **string** | Deprecated - The link to the long description of the project. Always null, only kept for legacy compatibility. | [optional]
**moderator_message** | [**\Aternos\ModrinthApi\Model\ModeratorMessage**](ModeratorMessage.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
