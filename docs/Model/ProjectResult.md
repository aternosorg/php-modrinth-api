# # ProjectResult

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**slug** | **string** | The slug of a project, used for vanity URLs. Regex: &#x60;&#x60;&#x60;^[\\w!@$()&#x60;.+,\&quot;\\-&#39;]{3,64}$&#x60;&#x60;&#x60; |
**title** | **string** | The title or name of the project |
**description** | **string** | A short description of the project |
**categories** | **string[]** | A list of the categories that the project has | [optional]
**client_side** | **string** | The client side support of the project |
**server_side** | **string** | The server side support of the project |
**project_type** | **string** | The project type of the project |
**downloads** | **int** | The total number of downloads of the project |
**icon_url** | **string** | The URL of the project&#39;s icon | [optional]
**color** | **int** | The RGB color of the project, automatically generated from the project icon | [optional]
**thread_id** | **string** | The ID of the moderation thread associated with this project | [optional]
**monetization_status** | **string** |  | [optional]
**project_id** | **string** | The ID of the project |
**author** | **string** | The username of the project&#39;s author |
**display_categories** | **string[]** | A list of the categories that the project has which are not secondary | [optional]
**versions** | **string[]** | A list of the minecraft versions supported by the project |
**follows** | **int** | The total number of users following the project |
**date_created** | **string** | The date the project was added to search |
**date_modified** | **string** | The date the project was last modified |
**latest_version** | **string** | The latest version of minecraft that this project supports | [optional]
**license** | **string** | The SPDX license ID of a project |
**gallery** | **string[]** | All gallery images attached to the project | [optional]
**featured_gallery** | **string** | The featured gallery image of the project | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
