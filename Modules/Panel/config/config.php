<?php

return [
    'sidebar_menus' => [
        'panel' => [
            'title' => 'ড্যাশবোর্ড',
            'icon' => 'icon-home',
            'url' => route(config('app.panel_prefix', 'panel').'.index'),
        ],

        'article' => [
            'title' => 'সংবাদ ব্যবস্থাপনা',
            'icon' => 'icon-globe',
            'url' => route(config('app.panel_prefix', 'panel').'.articles.index'),
            'permissions' => config('permissions_list.ARTICLE_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.articles.create',
                config('app.panel_prefix', 'panel').'.articles.edit',
                config('app.panel_prefix', 'panel').'.articles.seo-settings',
            ],
        ],

        'category' => [
            'title' => 'বিভাগ (ক্যাটাগরি)',
            'icon' => 'icon-grid',
            'url' => route(config('app.panel_prefix', 'panel').'.categories.index'),
            'permissions' => config('permissions_list.CATEGORY_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.categories.create',
                config('app.panel_prefix', 'panel').'.categories.edit',
                config('app.panel_prefix', 'panel').'.categories.seo-settings',
            ],
        ],

        'tag' => [
            'title' => 'ট্যাগ',
            'icon' => 'icon-tag',
            'url' => route(config('app.panel_prefix', 'panel').'.tags.index'),
            'permissions' => config('permissions_list.TAG_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.tags.create',
                config('app.panel_prefix', 'panel').'.tags.edit',
                config('app.panel_prefix', 'panel').'.tags.seo-settings',
            ],
        ],

        'comment' => [
            'title' => 'মন্তব্য',
            'icon' => 'icon-bubbles',
            'url' => route(config('app.panel_prefix', 'panel').'.comments.index'),
            'permissions' => config('permissions_list.COMMENT_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.comments.show',
            ],
        ],

        'menu_builder' => [
            'title' => 'মেনু ম্যানেজার',
            'icon' => 'icon-menu',
            'url' => route(config('app.panel_prefix', 'panel').'.menus.index'),
            'permissions' => config('permissions_list.MENU_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.menus.create',
                config('app.panel_prefix', 'panel').'.menus.edit',
                config('app.panel_prefix', 'panel').'.menus.category-menu.create',
                config('app.panel_prefix', 'panel').'.menus.category-menu.edit',
            ],
        ],

        'page_builder' => [
            'title' => 'পেজ বিল্ডার',
            'icon' => 'fas fa-laptop-file',
            'url' => route(config('app.panel_prefix', 'panel').'.pages.index'),
            'permissions' => config('permissions_list.PAGE_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.pages.create',
                config('app.panel_prefix', 'panel').'.pages.edit',
            ],
        ],

        'file_manager' => [
            'title' => 'মিডিয়া (ছবি/ভিডিও)',
            'icon' => 'icon-folder-alt',
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.images.index',
                config('app.panel_prefix', 'panel').'.images.create',
                config('app.panel_prefix', 'panel').'.images.edit',
                config('app.panel_prefix', 'panel').'.videos.index',
                config('app.panel_prefix', 'panel').'.videos.create',
                config('app.panel_prefix', 'panel').'.videos.edit',
            ],
            'permissions' => [
                config('permissions_list.IMAGE_INDEX_ALL', false),
                config('permissions_list.IMAGE_INDEX_OWN', false),
                config('permissions_list.VIDEO_INDEX_ALL', false),
                config('permissions_list.VIDEO_INDEX_OWN', false),
            ],
            'children' => [
                [
                    'title' => 'ছবি',
                    'icon' => 'icon-picture',
                    'url' => route(config('app.panel_prefix', 'panel').'.images.index'),
                    'permissions' => [
                        config('permissions_list.IMAGE_INDEX_ALL', false),
                        config('permissions_list.IMAGE_INDEX_OWN', false),
                    ],
                    'active_routes' => [
                        config('app.panel_prefix', 'panel').'.images.create',
                        config('app.panel_prefix', 'panel').'.images.edit',
                    ],
                ],
                [
                    'title' => 'ভিডিও',
                    'icon' => 'icon-film',
                    'url' => route(config('app.panel_prefix', 'panel').'.videos.index'),
                    'permissions' => [
                        config('permissions_list.VIDEO_INDEX_ALL', false),
                        config('permissions_list.VIDEO_INDEX_OWN', false),
                    ],
                    'active_routes' => [
                        config('app.panel_prefix', 'panel').'.videos.create',
                        config('app.panel_prefix', 'panel').'.videos.edit',
                    ],
                ],
            ],
        ],

        'user' => [
            'title' => 'ব্যবহারকারী',
            'icon' => ' icon-people',
            'url' => route(config('app.panel_prefix', 'panel').'.users.index'),
            'permissions' => config('permissions_list.USER_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.users.create',
                config('app.panel_prefix', 'panel').'.users.edit',
                config('app.panel_prefix', 'panel').'.users.role-assignment',
                config('app.panel_prefix', 'panel').'.users.seo-settings',
            ],
        ],

        'role' => [
            'title' => 'রোল ও পারমিশন',
            'icon' => 'fas fa-arrow-down-up-lock',
            'url' => route(config('app.panel_prefix', 'panel').'.roles.index'),
            'permissions' => config('permissions_list.ROLE_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.roles.create',
                config('app.panel_prefix', 'panel').'.roles.edit',
            ],
        ],

        'profile' => [
            'title' => 'প্রোফাইল',
            'icon' => 'icon-user',
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.profile.edit',
                config('app.panel_prefix', 'panel').'.profile.email.change',
                config('app.panel_prefix', 'panel').'.profile.password.change',
                config('app.panel_prefix', 'panel').'.profile.social-networks',
            ],
            'permissions' => [
                config('permissions_list.PROFILE_EDIT', false),
                config('permissions_list.PROFILE_CHANGE_PASSWORD', false),
                config('permissions_list.PROFILE_CHANGE_EMAIL', false),
            ],
            'children' => [
                [
                    'title' => 'প্রোফাইল সম্পাদনা',
                    'icon' => 'icon-note',
                    'url' => route(config('app.panel_prefix', 'panel').'.profile.edit'),
                    'permissions' => config('permissions_list.PROFILE_EDIT', false),
                ],
                [
                    'title' => 'পাসওয়ার্ড পরিবর্তন',
                    'icon' => 'icon-key',
                    'url' => route(config('app.panel_prefix', 'panel').'.profile.password.change'),
                    'permissions' => config('permissions_list.PROFILE_CHANGE_PASSWORD', false),
                ],
                [
                    'title' => 'ইমেইল পরিবর্তন',
                    'icon' => 'icon-envelope-letter',
                    'url' => route(config('app.panel_prefix', 'panel').'.profile.email.change'),
                    'permissions' => config('permissions_list.PROFILE_CHANGE_EMAIL', false),
                ],
                [
                    'title' => 'সোশ্যাল মিডিয়া লিংক',
                    'icon' => 'icon-link',
                    'url' => route(config('app.panel_prefix', 'panel').'.profile.social-networks.edit'),
                    'permissions' => config('permissions_list.PROFILE_SOCIAL_NETWORKS', false),
                ],
            ],
        ],

        'user_activity' => [
            'title' => 'ব্যবহারকারীর কার্যকলাপ',
            'icon' => 'icon-chart',
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.users-track.index',
                config('app.panel_prefix', 'panel').'.requests-track.index',
                config('app.panel_prefix', 'panel').'.requests-track.visits-stats',
            ],
            'permissions' => [
                config('permissions_list.USER_TRACK_INDEX', false),
                config('permissions_list.REQUEST_TRACK_INDEX', false),
            ],
            'children' => [
                [
                    'title' => 'ব্যবহারকারী ট্র্যাকিং',
                    'icon' => 'fas fa-users-viewfinder',
                    'url' => route(config('app.panel_prefix', 'panel').'.users-track.index'),
                    'permissions' => config('permissions_list.USER_TRACK_INDEX', false),
                ],
                [
                    'title' => 'ভিজিট ট্র্যাকিং',
                    'icon' => 'fas fa-arrows-to-eye',
                    'url' => route(config('app.panel_prefix', 'panel').'.requests-track.index'),
                    'permissions' => config('permissions_list.REQUEST_TRACK_INDEX', false),
                ],
                [
                    'title' => 'ভিজিট পরিসংখ্যান',
                    'icon' => 'icon-eye',
                    'url' => route(config('app.panel_prefix', 'panel').'.requests-track.visits-stats'),
                    'permissions' => config('permissions_list.REQUEST_TRACK_INDEX', false),
                ],
            ],
        ],

        'contact_us' => [
            'title' => 'যোগাযোগ',
            'icon' => 'icon-earphones-alt',
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.contact-us.info.edit',
                config('app.panel_prefix', 'panel').'.contact-us.messages.index',
                config('app.panel_prefix', 'panel').'.contact-us.messages.show',
            ],
            'permissions' => [
                config('permissions_list.CONTACT_INFO', false),
                config('permissions_list.CONTACT_MESSAGES', false),
            ],
            'children' => [
                [
                    'title' => 'যোগাযোগের তথ্য',
                    'icon' => 'icon-call-in',
                    'url' => route(config('app.panel_prefix', 'panel').'.contact-us.info.edit'),
                    'permissions' => config('permissions_list.CONTACT_INFO', false),
                ],
                [
                    'title' => 'ব্যবহারকারীর বার্তা',
                    'icon' => 'icon-envelope',
                    'url' => route(config('app.panel_prefix', 'panel').'.contact-us.messages.index'),
                    'permissions' => config('permissions_list.CONTACT_MESSAGES', false),
                    'active_routes' => [
                        config('app.panel_prefix', 'panel').'.contact-us.messages.show',
                    ],
                ],
            ],
        ],

        'ads' => [
            'title' => 'বিজ্ঞাপন',
            'icon' => 'fas fa-bullhorn',
            'url' => route(config('app.panel_prefix', 'panel').'.ads.index'),
            'permissions' => config('permissions_list.AD_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.ads.create',
                config('app.panel_prefix', 'panel').'.ads.edit',
            ],
        ],

        'newsletter' => [
            'title' => 'নিউজলেটার',
            'icon' => 'icon-paper-plane',
            'url' => route(config('app.panel_prefix', 'panel').'.newsletters.index'),
            'permissions' => config('permissions_list.NEWSLETTER_INDEX', false),
        ],

        'redirect' => [
            'title' => 'রিডাইরেক্ট',
            'icon' => 'fas fa-link',
            'url' => route(config('app.panel_prefix', 'panel').'.redirects.index'),
            'permissions' => config('permissions_list.REDIRECT_INDEX', false),
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.redirects.create',
                config('app.panel_prefix', 'panel').'.redirects.edit',
            ],
        ],

        'setting' => [
            'title' => 'সাইট কনফিগারেশন',
            'icon' => 'icon-settings',
            'active_routes' => [
                config('app.panel_prefix', 'panel').'.settings.site-details.edit',
                config('app.panel_prefix', 'panel').'.settings.social-networks.edit',
                config('app.panel_prefix', 'panel').'.settings.about-us.edit',
                config('app.panel_prefix', 'panel').'.settings.cache-management.index',
            ],
            'permissions' => [
                config('permissions_list.SETTING_SITE_DETAILS', false),
                config('permissions_list.SETTING_SOCIAL_NETWORKS', false),
                config('permissions_list.SETTING_ABOUT_US', false),
                config('permissions_list.CACHE_INDEX', false),
            ],
            'children' => [
                [
                    'title' => 'সাইটের তথ্য',
                    'icon' => 'icon-wrench',
                    'url' => route(config('app.panel_prefix', 'panel').'.settings.site-details.edit'),
                    'permissions' => config('permissions_list.SETTING_SITE_DETAILS', false),
                ],
                [
                    'title' => 'সোশ্যাল মিডিয়া লিংক',
                    'icon' => 'icon-link',
                    'url' => route(config('app.panel_prefix', 'panel').'.settings.social-networks.edit'),
                    'permissions' => config('permissions_list.SETTING_SOCIAL_NETWORKS', false),
                ],
                [
                    'title' => 'আমাদের সম্পর্কে',
                    'icon' => 'icon-question',
                    'url' => route(config('app.panel_prefix', 'panel').'.settings.about-us.edit'),
                    'permissions' => config('permissions_list.SETTING_ABOUT_US', false),
                ],
                [
                    'title' => 'ক্যাশ ব্যবস্থাপনা',
                    'icon' => 'icon-layers',
                    'url' => route(config('app.panel_prefix', 'panel').'.settings.cache-management.index'),
                    'permissions' => config('permissions_list.CACHE_INDEX', false),
                ],
            ],
        ],
    ],
];
