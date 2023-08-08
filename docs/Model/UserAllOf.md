# # UserAllOf

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The user&#39;s ID |
**avatar_url** | **string** | The user&#39;s avatar url |
**created** | **string** | The time at which the user was created |
**role** | **string** | The user&#39;s role |
**badges** | **int** | Any badges applicable to this user. These are currently unused and undisplayed, and as such are subject to change  In order from first to seventh bit, the current bits are: - (unused) - EARLY_MODPACK_ADOPTER - EARLY_RESPACK_ADOPTER - EARLY_PLUGIN_ADOPTER - ALPHA_TESTER - CONTRIBUTOR - TRANSLATOR | [optional]
**auth_providers** | **string[]** | A list of authentication providers you have signed up for (only displayed if requesting your own account) | [optional]
**email_verified** | **bool** | Whether your email is verified (only displayed if requesting your own account) | [optional]
**has_password** | **bool** | Whether you have a password associated with your account (only displayed if requesting your own account) | [optional]
**has_totp** | **bool** | Whether you have TOTP two-factor authentication connected to your account (only displayed if requesting your own account) | [optional]
**github_id** | **int** | Deprecated - this is no longer public for security reasons and is always null | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
