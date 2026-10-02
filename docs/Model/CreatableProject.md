# CreatableProject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**slug** | **string** | The slug of a project, used for vanity URLs. Regex: &#x60;&#x60;&#x60;^[\\w!@$()&#x60;.+,\&quot;\\-&#39;]{3,64}$&#x60;&#x60;&#x60; |
**title** | **string** | The title or name of the project |
**description** | **string** | A short sentence summarizing the project, no more than a sentence or two. |
**body** | **string** | A long form description of the project |
**categories** | **string[]** | A list of the featured categories that the project has. |
**additional_categories** | **string[]** | A list of additional categories that the project also has. These are supplementary to the featured categories, and does not include them again. | [optional]
**status** | **string** | The status of the project | [optional]
**requested_status** | **string** | The requested status when submitting for review or scheduling the project for release. Approved status refers to \&quot;Public\&quot; visibility. | [optional]
**issues_url** | **string** | An optional link to where to submit bugs or issues with the project | [optional]
**source_url** | **string** | An optional link to the source code of the project | [optional]
**wiki_url** | **string** | An optional link to the project&#39;s wiki page or other relevant information | [optional]
**discord_url** | **string** | An optional invite link to the project&#39;s discord. | [optional]
**donation_urls** | [**\Aternos\ModrinthApi\Model\ProjectDonationURL[]**](ProjectDonationURL.md) | A list of donation links for the project | [optional]
**client_side** | **string** | Deprecated - use &#x60;environment&#x60; instead. |
**server_side** | **string** | Deprecated - use &#x60;environment&#x60; instead. |
**license_id** | **string** | The SPDX license ID of a project |
**license_url** | **string** | The URL to this license | [optional]
**project_type** | **string** | The project type of the project |
**initial_versions** | [**\Aternos\ModrinthApi\Model\EditableVersion[]**](EditableVersion.md) | A list of initial versions to upload with the created project. Deprecated - please upload version files after initial upload. | [optional]
**is_draft** | **bool** | Whether the project should be saved as a draft instead of being sent to moderation for review. Deprecated - please always mark this as true. | [optional]
**gallery_items** | [**\Aternos\ModrinthApi\Model\CreatableProjectGalleryItem[]**](CreatableProjectGalleryItem.md) | Gallery images to be uploaded with the created project. Deprecated - please upload gallery images after initial upload. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
