# # TeamMember

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**team_id** | **mixed** | The ID of the team this team member is a member of |
**user** | **mixed** |  |
**role** | **mixed** | The user&#39;s role on the team |
**permissions** | **mixed** | The user&#39;s permissions in bitfield format (requires authorization to view)  In order from first to tenth bit, the bits are: - UPLOAD_VERSION - DELETE_VERSION - EDIT_DETAILS - EDIT_BODY - MANAGE_INVITES - REMOVE_MEMBER - EDIT_MEMBER - DELETE_PROJECT - VIEW_ANALYTICS - VIEW_PAYOUTS | [optional]
**accepted** | **mixed** | Whether or not the user has accepted to be on the team (requires authorization to view) |
**payouts_split** | **mixed** | The split of payouts going to this user. The proportion of payouts they get is their split divided by the sum of the splits of all members. | [optional]
**ordering** | **mixed** | The order of the team member. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
