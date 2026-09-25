<?php

return [
    'name' => 'Auth',

    // Public self-registration (/register). Defaults to enabled so existing
    // behaviour and tests are unaffected. Set REGISTRATION_ENABLED=false in
    // .env for a production site where only known editors/admins get accounts.
    'registration_enabled' => env('REGISTRATION_ENABLED', true),
];
