<?php

return [
    // 'create_users' => false,
    'truncate_tables' => true,
    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'sub_categories' => 'c,r,u,d',
            'company' => 'c,r,u,d',
            'product' => 'c,r,u,d',
            'mediationorder' => 'c,r,u,d',
            'service' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'colors' => 'c,r,u,d',
            'sizes' => 'c,r,u,d',
            'leadtimes' => 'c,r,u,d',
            'translationServices' => 'c,r,u,d',
            'ads' => 'c,r,u,d',
            'plans' => 'c,r,u,d',
            'about_us' => 'c,r,u,d',
            'tradeshows' => 'c,r,u,d',
            'home' => 'c,r,u,d',
            'helpcenters' => 'c,r,u,d',
            'polices' => 'c,r,u,d',
            'reports' => 'c,r,u,d',
            'contactus' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'mediations' => 'c,r,u,d',
            'clerks' => 'c,r,u,d',
            'shipment_order_news' => 'c,r,u,d',
            'chats' => 'c,r,u,d',
            'translations' => 'c,r,u,d',
            'newcat' => 'c,r,u,d',
            // 'contactSuppliers' => 'c,r,u,d',


        ],
        'company' => [
            'home' => 'c,r,u,d',
            'product' => 'c,r,u,d',
            'clerks' => 'c,r,u,d',
            'contactsuppliers' => 'c,r,u,d',
        ],
        'clerk' => [
            'home' => 'c,r,u,d',
            'contactsuppliers' => 'c,r,u,d',
        ],

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
