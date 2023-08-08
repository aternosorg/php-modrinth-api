# # ModifiableProject

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**slug** | **string** | The slug of a project, used for vanity URLs. Regex: &#x60;&#x60;&#x60;^[\\w!@$()&#x60;.+,\&quot;\\-&#39;]{3,64}$&#x60;&#x60;&#x60; | [optional]
**title** | **string** | The title or name of the project | [optional]
**description** | **string** | A short description of the project | [optional]
**categories** | **string[]** | A list of the categories that the project has | [optional]
**client_side** | **string** | The client side support of the project | [optional]
**server_side** | **string** | The server side support of the project | [optional]
**body** | **string** | A long form description of the project | [optional]
**status** | **string** | The status of the project | [optional]
**requested_status** | **string** | The requested status when submitting for review or scheduling the project for release | [optional]
**additional_categories** | **string[]** | A list of categories which are searchable but non-primary | [optional]
**issues_url** | **string** | An optional link to where to submit bugs or issues with the project | [optional]
**source_url** | **string** | An optional link to the source code of the project | [optional]
**wiki_url** | **string** | An optional link to the project&#39;s wiki page or other relevant information | [optional]
**discord_url** | **string** | An optional invite link to the project&#39;s discord | [optional]
**donation_urls** | [**\Aternos\ModrinthApi\Model\ProjectDonationURL[]**](ProjectDonationURL.md) | A list of donation links for the project | [optional]
**license_id** | **string** | The SPDX license ID of a project | [optional]
**license_url** | **string** | The URL to this license | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
