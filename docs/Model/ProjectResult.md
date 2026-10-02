# ProjectResult

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**project_id** | **string** | The ID of the project, encoded as a base62 string |
**project_type** | **string** | The project type of the project |
**all_project_types** | **string[]** | All project types across every version of the project, unlike &#x60;project_type&#x60; which only reflects a version-specific type |
**title** | **string** | The title or name of the project |
**description** | **string** | A short sentence summarizing the project, no more than a sentence or two. |
**author** | **string** | The username of the project&#39;s author |
**categories** | **string[]** | A list of the featured categories that the project has. |
**display_categories** | **string[]** | A list of the featured categories that the project has. Equivalent to &#x60;categories&#x60; on the project itself. |
**versions** | **string[]** | A list of the minecraft versions supported by the project |
**downloads** | **int** | The total number of downloads of the project |
**follows** | **int** | The total number of users following the project |
**icon_url** | **string** | The URL of the project&#39;s icon |
**date_created** | **string** | The date the project was created |
**date_modified** | **string** | The date the latest version of the project was created |
**latest_version** | **string** | The ID of the latest version of the project |
**license** | **string** | The SPDX license ID of a project |
**environment** | [**\Aternos\ModrinthApi\Model\EnvironmentEnum[]**](EnvironmentEnum.md) | All the environments that versions of this project support. Not in any particular order, we recommend using the environment information on a version instead. For an explanation of each environment, see the blog post here: https://modrinth.com/news/article/new-environments/#new-system |
**disclosure_types** | [**\Aternos\ModrinthApi\Model\DisclosureTypeEnum[]**](DisclosureTypeEnum.md) | Disclosures listed on the project. |
**gallery** | **string[]** | A list of images that have been uploaded to the project&#39;s gallery |
**slug** | **string** | The slug of a project, used for vanity URLs. Regex: &#x60;&#x60;&#x60;^[\\w!@$()&#x60;.+,\&quot;\\-&#39;]{3,64}$&#x60;&#x60;&#x60; | [optional]
**author_id** | **string** | The ID of the project&#39;s author | [optional]
**organization** | **string** | The name of the organization that owns this project | [optional]
**organization_id** | **string** | The ID of the organization that owns this project | [optional]
**featured_gallery** | **string** | The featured gallery image of the project | [optional]
**color** | **int** | The RGB color of the project, automatically generated from the project icon | [optional]
**client_side** | **string** | Deprecated - use &#x60;environment&#x60; instead. The client side support of the project |
**server_side** | **string** | Deprecated - use &#x60;environment&#x60; instead. The server side support of the project |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
