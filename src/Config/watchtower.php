<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Overview of config
    |--------------------------------------------------------------------------
    |
    | This config might look a little long, but it allows a lot of flexibility.
    | You can choose your own views for each page, and the permissions (if
    | any at all) required to access all the different sections.
    |
    |--------------------------------------------------------------------------
    | Title for this user admin section
    |--------------------------------------------------------------------------
    |
    | The name of your site (or whatever) you want displayed on the header.
    |
    */
	'site_title' => 'Watchtower',


    /*
    |--------------------------------------------------------------------------
    | Default model to use
    |--------------------------------------------------------------------------
    |
    | By default, watchtower uses its own internal User model. If you have a 
    | User model you would rather use, provide the name here.
    |
    | To provide additional Validation rules to the default Update or Store 
    | form request, place them under the rules heading. By default, the
    | rules for password, password confirmation and username are part
    | of the request already. But you can override them with yours.
    |
    */
    'user' => [
        'model' => \Smarch\Watchtower\Models\User::class,
        'rules' => [
            'update' => [],
            'store'  => [],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Default bootstrap theme
    |--------------------------------------------------------------------------
    |
    | Choose the one you want from https://www.bootstrapcdn.com/bootswatch/
    |
    | Watchtower will check if there is a "theme" defined in Auth->user()
    | and use that one if one is found, othewise it uses the default.
    |
    */
   'default_theme' => 'spacelab',


    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    |
    | Laravel 5.2 changed the routes that they always used for authentication. 
    | Watchtower will try to detect (below) which route to choose, however,
    | you can specify the authentication routes your app will use.
    |
    | Laravel 5.1 default:
    |   /auth/login, /auth/logout and /auth/register
    |
    | Laravel 5.2 default:
    |   /login, /logout and /register
    |
    */
    'auth_routes' => [
        'login'     => (str_contains( app()->version(), '5.2') ? '' : '/auth').'/login',
        'logout'    => (str_contains( app()->version(), '5.2') ? '' : '/auth').'/logout',
        'register'  => (str_contains( app()->version(), '5.2') ? '' : '/auth').'/register',
    ],


    /*
    |--------------------------------------------------------------------------
    | Watchtower Permissions
    |--------------------------------------------------------------------------
    |
    | Watchtower comes ready to go with pre-defined permissions to access all
    | the different areas. Feel free to change them to match your needs, if 
    | you wish. Can be a permission slug from shinobi's tables, or even a
    | boolean true/false to globally enable/disable permission. However,
    | the permissions in watchtower will return "false" for security
    | if nothing else is supplied in a config file.
    |
    */   
   'acl' => [
        'user' => [
            'index'         => 'show.user.index',
            'create'        => 'create.user',
            'show'          => 'show.user',
            'edit'          => 'edit.user',
            'destroy'       => 'destroy.user',
            'role'          => 'sync.user.roles',
            'usermatrix'    => 'sync.user.roles',
            'viewmatrix'    => 'show.user.index',
            'search'        => 'search.user'
        ],

        'role' => [
            'index'         => 'show.role.index',
            'create'        => 'create.role',
            'show'          => 'show.role',
            'edit'          => 'edit.role',
            'destroy'       => 'destroy.role',
            'users'         => 'sync.role.users',
            'viewmatrix'    => 'show.role.index',
            'rolematrix'    => 'sync.role.permissions',
            'permissions'   => 'sync.role.permissions',
            'search'        => 'search.role'
        ],

        'permission' => [
            'index'         => 'show.permission.index',
            'create'        => 'create.permission',
            'show'          => 'show.permission',
            'edit'          => 'edit.permission',
            'destroy'       => 'destroy.permission',
            'role'          => 'sync.permission.roles',
            'search'        => 'search.permission'
        ],

        'watchtower' => [
            'index'         => 'show.watchtower.index'
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Watchtower Views
    |--------------------------------------------------------------------------
    |
    | Watchtower comes pre-equipped with views that will work out of the box.
    | However, you are free to define you own views here instead.
    |
    */   
   'views' => [
        'layouts' => [
            'master'        => 'watchtower::layouts.master',
            'flash'         => 'watchtower::partials.flash',
            'modal'         => 'watchtower::partials.modal',
            'search'        => 'watchtower::partials.search',
            'dashboard'     => 'watchtower::watchtower.index',
            'adminlinks'    => 'watchtower::watchtower.links',
            'unauthorized'  => 'watchtower::partials.unauthorized',
        ],

        'users' => [
            'index'     => 'watchtower::user.index',            
            'create'    => 'watchtower::user.create',
            'show'      => 'watchtower::user.edit',
            'edit'      => 'watchtower::user.edit',
            'role'      => 'watchtower::user.role',
            'usermatrix'=> 'watchtower::user.matrix'
        ],

        'roles' => [
            'index'     => 'watchtower::role.index',            
            'create'    => 'watchtower::partials.create',
            'show'      => 'watchtower::partials.edit',
            'edit'      => 'watchtower::partials.edit',
            'user'      => 'watchtower::role.user',
            'rolematrix'=> 'watchtower::role.matrix',
            'permission'=> 'watchtower::role.permission'
        ],

        'permissions' => [
            'index'     => 'watchtower::permission.index',            
            'create'    => 'watchtower::partials.create',
            'show'      => 'watchtower::partials.edit',
            'edit'      => 'watchtower::partials.edit',
            'role'      => 'watchtower::permission.role'
        ]
    ],


    /*
    |--------------------------------------------------------------------------
    | Watchtower dashboard
    |--------------------------------------------------------------------------
    |
    | This is the main index page of the Watchtower. Everyone seems to like
    | the term dashboard, so we stuck with that. However, you are free to
    | add your own links to different admin sections of your application
    | if you wish. Make sure your route is a named route for proper
    | linkage.
    |
    */ 
   'dashboard' => [
        'users' => [
            'name'  => "Users",            
            'route' => 'watchtower.user.index',
            'icon'  => 'fa fa-user fa-5x',
            'colour'=> 'primary'
        ],

        'roles' => [
            'name'  => "Roles",
            'route' => 'watchtower.role.index',
            'icon'  => 'fa fa-users fa-5x',
            'colour'=> 'info'
        ],

        'permissions' => [
            'name'  => "Permissions",
            'route' => 'watchtower.permission.index',
            'icon'  => 'fa fa-5x fa-key',
            'colour'=> 'success'
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Watchtower pagination
    |--------------------------------------------------------------------------
    |
    | The default is to show 15 items per page. Change this to whatever
    | value you prefer. Note, doesn't apply to matrices.
    |
    */
    'pagination' => [
        'users'         => '15',
        'roles'         => '15',
        'permissions'   => '15',
    ],


    /*
    |--------------------------------------------------------------------------
    | Route Options
    |--------------------------------------------------------------------------
    | Prefix :
    |-------------------------
    |
    | If you want to prefix all your watchtower routes, enter the prefix here.
    | https://laravel.com/docs/5.2/routing#route-group-prefixes for info.
    | 
    | i.e 'route_prefix' => 'admin' will change your urls to look
    | like 'http://<yoursite>/admin/watchtower/user' instead of
    | 'http://<yoursite>/watchtower/user'. Default is none.
    |
    |-------------------------
    | Middleware :
    |-------------------------
    | An array of middlewares you wish to pass in to the group. Laravel 5.2
    | by default requires that the "web" middleware be use for any routes
    | that need access to session (or 'logged in' won't stay that way.)
    |
    | Laravel 5.1 uses "auth" for authentication and so that is passed.
    |
    |-------------------------
    | As :
    |-------------------------
    | If you want to use something other than "watchtower" in your named routes
    | you can specify it here.
    |
    */
    'route' => [
        'prefix'    => '',
        'as'        => 'watchtower.',
        'middleware'=> ( str_contains( app()->version(), '5.2') ? ['web'] : ['auth'] )
    ]
];