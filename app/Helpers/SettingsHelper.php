<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

use App\Models\Setting;

/**
 * Description of SettingsHelper
 *
 * @author moataz
 */
class SettingsHelper {

    const SETTINGS = [
        [
            'id' => 1,
            'name' => 'facial_recognition',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'Face Recognition',
            'default_value' => 1,
            'category' => Setting::TYPE['INPUT']
        ],
        [
            'id' => 2,
            'name' => 'rfid',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'RFID',
            'default_value' => 0,
            'category' => Setting::TYPE['INPUT']
        ],
        [
            'id' => 3,
            'name' => 'temperature_check',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'Temperature Check',
            'default_value' => 1,
            'category' => Setting::TYPE['CHECKS']
        ],
        [
            'id' => 4,
            'name' => 'check_type',
            'type' => 'radio',
            'parent_id' => 3,
            'label' => 'Temperature Check',
            'default_value' => 'rapid',
            'category' => Setting::TYPE['CHECKS']
        ],
        [
            'id' => 5,
            'name' => 'temperature_threshold',
            'type' => 'float',
            'parent_id' => 3,
            'label' => 'Temperature Threshold',
            'default_value' => '37.3f',
            'category' => Setting::TYPE['CHECKS']
        ],
        [
            'id' => 6,
            'name' => 'mask_check',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Mask Check',
            'default_value' => 1,
            'category' => Setting::TYPE['CHECKS']
        ],
        [
            'id' => 7,
            'name' => 'print_badge',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Print Badge',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 8,
            'name' => 'show_photo',
            'type' => 'boolean',
            'parent_id' => 7,
            'label' => 'Show Photo',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 9,
            'name' => 'show_name',
            'type' => 'boolean',
            'parent_id' => 7,
            'label' => 'Show Name',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 10,
            'name' => 'show_user_type',
            'type' => 'boolean',
            'parent_id' => 7,
            'label' => 'Show User Type',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 11,
            'name' => 'show_temperature',
            'type' => 'boolean',
            'parent_id' => 7,
            'label' => 'Show Temperature',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 12,
            'name' => 'show_company_name',
            'type' => 'boolean',
            'parent_id' => 7,
            'label' => 'Show Company Name',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 13,
            'name' => 'show_date_time',
            'type' => 'boolean',
            'parent_id' => 6,
            'label' => 'Show Date and Time',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 14,
            'name' => 'door_relay',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Door Relay',
            'default_value' => 0,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 15,
            'name' => 'door_relay',
            'type' => 'double',
            'parent_id' => 14,
            'label' => 'Delay',
            'default_value' => 5,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 16,
            'name' => 'mode',
            'type' => 'radio',
            'parent_id' => 14,
            'label' => 'Mode',
            'default_value' => 1,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 17,
            'name' => 'temperature_alert',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Temperature Alert',
            'default_value' => 0,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 18,
            'name' => 'send_via_email',
            'type' => 'boolean',
            'parent_id' => 17,
            'label' => 'Send Via Email',
            'default_value' => 0,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 19,
            'name' => 'send_to_email',
            'type' => 'string',
            'parent_id' => 17,
            'label' => 'Send To Email',
            'default_value' => '',
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 20,
            'name' => 'send_via_sms',
            'type' => 'boolean',
            'parent_id' => 17,
            'label' => 'Send Via SMS',
            'default_value' => 0,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 21,
            'name' => 'send_to_email_sms',
            'type' => 'string',
            'parent_id' => 17,
            'label' => 'Send To SMS',
            'default_value' => '',
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 22,
            'name' => 'mask_alert',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Mask Alert',
            'default_value' => 0,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 27,
            'name' => 'custom_smtp_server',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Custom SMTP Server',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 28,
            'name' => 'temperature_display_unit',
            'type' => 'Options',
            'parent_id' => null,
            'label' => 'Temperature display unit',
            'default_value' => 'c',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 29,
            'name' => 'temperature_offset',
            'type' => 'Decimal',
            'parent_id' => null,
            'label' => 'Temperature Offset',
            'default_value' => 0.0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 30,
            'name' => 'message_feedback',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Message',
            'default_value' => 1,
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 31,
            'name' => 'audio_feedback',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Audio',
            'default_value' => 1,
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 32,
            'name' => 'card_feedback',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Card',
            'default_value' => 1,
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 33,
            'name' => 'light_feedback',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Light',
            'default_value' => 1,
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 34,
            'name' => 'save_data',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Save Data',
            'default_value' => 1,
            'category' => Setting::TYPE['OUTPUTS']
        ],
        [
            'id' => 35,
            'name' => 'granted_message',
            'type' => 'String',
            'parent_id' => 1,
            'label' => 'Granted Message',
            'default_value' => 'Welcome',
            'category' => Setting::TYPE['CHECKS']
        ],
        [
            'id' => 36,
            'name' => 'denied_message',
            'type' => 'String',
            'parent_id' => 1,
            'label' => 'Denied Message',
            'default_value' => 'Please seek assistance',
            'category' => Setting::TYPE['CHECKS']
        ],
        [
            'id' => 37,
            'name' => 'show_logo_on_card',
            'type' => 'Boolean',
            'parent_id' => 32,
            'label' => 'Display company logo on card',
            'default_value' => 0,
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 38,
            'name' => 'card_logo_image',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'card logo',
            'default_value' => '',
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 39,
            'name' => 'kiosk_password',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'Kiosk Password',
            'default_value' => '123456',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 40,
            'name' => 'kiosk_volume',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'Kiosk Volume',
            'default_value' => 100,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 41,
            'name' => 'kiosk_brightness',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'Kiosk Brightness',
            'default_value' => 100,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 42,
            'name' => 'smtp_username',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'SMTP UserName',
            'default_value' => '',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 43,
            'name' => 'smtp_password',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'SMTP Password',
            'default_value' => '',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 44,
            'name' => 'smtp_address',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'SMTP Address',
            'default_value' => '',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 45,
            'name' => 'smtp_port',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'SMTP Port',
            'default_value' => '',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 46,
            'name' => 'smtp_tls',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'SMTP TLS',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 47,
            'name' => 'smtp_ssl',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'SMTP SSL',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 48,
            'name' => 'temperature_feedback',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Temperature',
            'default_value' => 0,
            'category' => Setting::TYPE['FEEDBACK']
        ],
        [
            'id' => 49,
            'name' => 'auto_update',
            'type' => 'Options',
            'parent_id' => null,
            'label' => 'Auto Update',
            'default_value' => 'OTA',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 50,
            'name' => 'schedule_reboot',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Schedule Reboot',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 51,
            'name' => 'schedule_reboot_time',
            'type' => 'time',
            'parent_id' => null,
            'label' => 'Schedule Reboot time',
            'default_value' => "03:00:00",
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 52,
            'name' => 'system_fan',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'System Fan',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 53,
            'name' => 'time_zone',
            'type' => 'string',
            'parent_id' => null,
            'label' => 'Time zone',
            'default_value' => 'Europe/Belfast',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 54,
            'name' => 'enable_company_logo',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'Company logo',
            'default_value' => 1,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 55,
            'name' => 'compliance_alert',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Compliance Alert',
            'default_value' => 0,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 56,
            'name' => 'living_body',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Living body',
            'default_value' => 1,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 57,
            'name' => 'show_status_bar',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'Show status bar',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 58,
            'name' => 'system_ui_gesture',
            'type' => 'boolean',
            'parent_id' => null,
            'label' => 'SystemUI Gesture',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 59,
            'name' => 'date_format',
            'type' => 'string',
            'parent_id' => null,
            'label' => 'Date Format',
            'default_value' => 'yyyy-MM-dd',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 60,
            'name' => 'weigand_output_type',
            'type' => 'string',
            'parent_id' => null,
            'label' => 'Weigand output type',
            'default_value' => 26,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 61,
            'name' => 'enable_weigand_output',
            'type' => 'boolean',
            'parent_id' => 61,
            'label' => 'Weigand output',
            'default_value' => 1,
            'category' => Setting::TYPE['OUTPUTS']
        ],
        [
            'id' => 62,
            'name' => 'weigand_output_settings',
            'type' => 'string',
            'parent_id' => 62,
            'label' => 'Weigand output',
            'default_value' => 'rfid',
            'category' => Setting::TYPE['OUTPUTS']
        ],
        [
            'id' => 63,
            'name' => 'rfid_counter',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'RFID counter',
            'default_value' => 3,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 64,
            'name' => 'record_retention',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'Data Retention Period',
            'default_value' => 1,
            'category' => Setting::TYPE['INPUT']
        ],
        [
            'id' => 65,
            'name' => 'facial_retention',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'Face Retention Period',
            'default_value' => 1,
            'category' => Setting::TYPE['INPUT']
        ],
        [
            'id' => 66,
            'name' => 'logging_level',
            'type' => 'String',
            'parent_id' => null,
            'label' => 'Logging Level',
            'default_value' => 'Error',
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 67,
            'name' => 'AUTO_DELETION',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'Automatic Deletion',
            'default_value' => 0,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 68,
            'name' => 'DISK_SPACE_THRESHOLD',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'Disk Space Threshold',
            'default_value' => 90,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 69,
            'name' => 'AMOUNT_DELETION_THRESHOLD',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'Amount Deletion Threshold',
            'default_value' => 25,
            'category' => Setting::TYPE['KIOSK']
        ],
        [
            'id' => 70,
            'name' => 'SCAN_RETENTION',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'Scan Rerention',
            'default_value' => 360,
            'category' => Setting::TYPE['USERTYPE']
        ],
        [
            'id' => 71,
            'name' => 'temperature_display_unit_for_company',
            'type' => 'Options',
            'parent_id' => null,
            'label' => 'Temperature display unit For Company',
            'default_value' => 'c',
            'category' => Setting::TYPE['ENTITY']
        ],
        [
            'id' => 72,
            'name' => 'data_retention',
            'type' => 'Int',
            'parent_id' => null,
            'label' => 'Data Retention Period',
            'default_value' => 0,
            'category' => Setting::TYPE['INPUT']
        ],
        [
            'id' => 73,
            'name' => 'save_scan_image',
            'type' => 'Boolean',
            'parent_id' => 7,
            'label' => 'Save Scan Image',
            'default_value' => 1,
            'category' => Setting::TYPE['ACTIONS']
        ],
        [
            'id' => 74,
            'name' => 'privacy_manager',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'privacy manager',
            'default_value' => 1,
            'category' => Setting::TYPE['ENTITY']
        ],
        [
            'id' => 75,
            'name' => 'qr_code',
            'type' => 'Boolean',
            'parent_id' => null,
            'label' => 'QR Code',
            'default_value' => 0,
            'category' => Setting::TYPE['INPUT']
        ],
    ];

}
