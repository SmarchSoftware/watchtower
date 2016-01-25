<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Watchtower Navigation Menu
    |--------------------------------------------------------------------------
    |
    | The navigation links that run across the top of the Watchtower master 
    | layout? That's these options right here. Add as many of them as you
    | want to have appear.
    |
    */ 
    'navigation' => [ 
        [
            'group' => 'Users',
            'class' => 'fa fa-user fa-lg',
            'links' => [
                [
                  'title' => 'Add User',
                  'class' => 'fa fa-fw fa-plus',
                  'route' => 'watchtower.user.create'
                ],
                [
                  'title' => 'List Users',
                  'class' => 'fa fa-fw fa-th-list',
                  'route' => 'watchtower.user.index'
                ],

                'separator',
                
                [
                  'title' => 'User Matrix',
                  'class' => 'fa fa-fw fa-table',
                  'route' => 'watchtower.user.matrix'
                ]
            ]
        ],

        [
            'group' => 'Roles',
            'class' => 'fa fa-users fa-lg',
            'links' => [
                [
                  'title' => 'Add Role',
                  'class' => 'fa fa-fw fa-plus',
                  'route' => 'watchtower.role.create'
                ],
                [
                  'title' => 'List Roles',
                  'class' => 'fa fa-fw fa-th-list',
                  'route' => 'watchtower.role.index'
                ],

                  'separator',

                [
                  'title' => 'Role Matrix',
                  'class' => 'fa fa-fw fa-table',
                  'route' => 'watchtower.role.matrix'
                ]
            ]
        ],

        [
            'group' => 'Permissions',
            'class' => 'fa fa-key fa-lg',
            'links' => [
                [
                  'title' => 'Add Permission',
                  'class' => 'fa fa-fw fa-plus',
                  'route' => 'watchtower.permission.create'
                ],
                [
                  'title' => 'List Permissions',
                  'class' => 'fa fa-fw fa-th-list',
                  'route' => 'watchtower.permission.index'
                ],

                  'separator',
                  
                [
                  'title' => 'Role Matrix',
                  'class' => 'fa fa-fw fa-table',
                  'route' => 'watchtower.role.matrix'
                ]
            ]
        ],
    ],
];