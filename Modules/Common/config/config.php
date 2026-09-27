<?php

return [
    'name' => 'Common',
    'datetime_format' => 'Y/m/d H:i:s',
    'front_date_format' => 'd F Y',
    'front_datetime_format' => 'd F Y - H:i',
    'default_image' => [
        'file_path' => public_path('seeders/images/default.jpg'),
        'file_link' => asset('seeders/images/default.jpg'),
        'alt_text' => 'Default Image',
    ],
    'default_logo' => [
        'file_path' => public_path('seeders/images/logo.png'),
        'file_link' => asset('seeders/images/logo.png'),
        'alt_text' => 'Default Logo',
    ],
    'default_logo_white' => [
        // White-text variant of the logo, for use on dark backgrounds (e.g. the footer)
        'file_path' => public_path('seeders/images/logo-white.png'),
        'file_link' => asset('seeders/images/logo-white.png'),
        'alt_text' => 'Default Logo (white)',
    ],
    'default_favicon' => [
        'file_path' => public_path('seeders/images/favicon.ico'),
        'file_link' => asset('seeders/images/favicon.ico'),
        'alt_text' => 'Default Favicon',
    ],
];
