# # Notification

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The id of the notification |
**user_id** | **string** | The id of the user who received the notification |
**type** | **string** | The type of notification | [optional]
**title** | **string** | The title of the notification |
**text** | **string** | The body text of the notification |
**link** | **string** | A link to the related project or version |
**read** | **bool** | Whether the notification has been read or not |
**created** | **string** | The time at which the notification was created |
**actions** | [**\Aternos\ModrinthApi\Model\NotificationAction[]**](NotificationAction.md) | A list of actions that can be performed |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
