# # ThreadMessageBody

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** | The type of message |
**body** | **string** | The actual message text. **Only present for &#x60;text&#x60; message type** | [optional]
**private** | **bool** | Whether the message is only visible to moderators. **Only present for &#x60;text&#x60; message type** | [optional]
**replying_to** | **string** | The ID of the message being replied to by this message. **Only present for &#x60;text&#x60; message type** | [optional]
**old_status** | **string** | The old status of the project. **Only present for &#x60;status_change&#x60; message type** | [optional]
**new_status** | **string** | The new status of the project. **Only present for &#x60;status_change&#x60; message type** | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
