<?php

return [
    'name' => 'User',
    'admin_full_name' => env('ADMIN_FULL_NAME', 'Admin'),
    'admin_username' => env('ADMIN_USERNAME', 'admin'),
    // No fallback values for email/password: a real admin account must never
    // be created with a guessable default. These must be set in .env.
    'admin_email' => env('ADMIN_EMAIL'),
    'admin_password' => env('ADMIN_PASSWORD'),
    //    'default_profile_picture' => module_path('User', 'Database/Seeders/data/images/profile_picture.jpg')
    'default_profile_picture' => [
        'file_path' => public_path('seeders/images/profile_picture.jpg'),
        'file_link' => asset('seeders/images/profile_picture.jpg'),
        'alt_text' => 'Default Profile Picture',
    ],
];
