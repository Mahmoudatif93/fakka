<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'contacts' => 'c,r,u,d',
            'confirmpayment' => 'c,r,u,d',
            'virtual_gold' => 'c,r,u,d',
            'banks'=>'c,r,u,d',
            'wallet'=>'c,r,u,d',
            'withdrow_wallet'=>'c,r,u,d',
            'ingots'=>'c,r,u,d',
            'fees_caches'=>'c,r,u,d',


        ],
        'admin' => []

    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
