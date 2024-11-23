<?php

return [
  'account_sid' => env('TWILIO_ACCOUNT_SID'),
  'auth_token' => env('TWILIO_AUTH_TOKEN'),
  'new_message_url' => env('TWILIO_NEW_MESSAGE_URL'),
  'from' => env('WHATSAPP_FROM'),
  'new_user_notification_sid' => env('TWILIO_NEW_USER_SID'),
  'subscribed_notification_sid' => env('TWILIO_SUBSCRIBED_SID'),
];
