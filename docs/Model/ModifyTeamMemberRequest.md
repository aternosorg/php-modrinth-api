# # ModifyTeamMemberRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**role** | **mixed** |  | [optional]
**permissions** | **mixed** | The user&#39;s permissions in bitfield format  In order from first to tenth bit, the bits are: - UPLOAD_VERSION - DELETE_VERSION - EDIT_DETAILS - EDIT_BODY - MANAGE_INVITES - REMOVE_MEMBER - EDIT_MEMBER - DELETE_PROJECT - VIEW_ANALYTICS - VIEW_PAYOUTS | [optional]
**payouts_split** | **mixed** | The split of payouts going to this user. The proportion of payouts they get is their split divided by the sum of the splits of all members. | [optional]
**ordering** | **mixed** | The order of the team member. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
