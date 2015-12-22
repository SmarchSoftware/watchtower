<?php

namespace Smarch\Watchtower\Seeds;

use DB;

use Illuminate\Database\Seeder;

class WatchtowerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles
        $roles = [
            [ 
                'name'          => 'Administrators',
                'slug'          => 'admin',
                'description'   => 'Have all access to all areas',
                'special'       => 'all-access',
            ],

            [
                'name'          => 'Moderators',
                'slug'          => 'moderator',
                'description'   => 'Some admin area access',
                'special'       => null,
            ],

            [
                'name'          => 'General Users',
                'slug'          => 'user',
                'description'   => 'No admin access',
                'special'       => null,
            ],

            [
                'name'          => 'Banned',
                'slug'          => 'banned',
                'description'   => 'Have no access to any areas',
                'special'       => 'no-access',
            ]
        ];
        
        // insert roles
        DB::table('roles')->insert($roles);

        // is there a user
        $any = DB::table('users')->get();
        if ( empty($any) ) {
            DB::table('users')
                ->insert( [ 
                    'name' => 'admin',
                    'email' => 'admin@change.me',
                    'password' => bcrypt('password')
                ]
            );
        }

        //associate first user with admin role
        DB::table('role_user')->insert( ['role_id' => 1, 'user_id'=> 1] );

         // permissions
        $permissions = [
            [ 
                'name'          => 'Show Watchtower Dashboard',
                'slug'          => 'show.watchtower.index',
                'description'   => 'View the watchtower dashboard shortcuts page'
            ],

            [ 
                'name'          => 'Show user list',
                'slug'          => 'show.user.index',
                'description'   => 'Can show the user list on the index page'
            ],

            [ 
                'name'          => 'Create user',
                'slug'          => 'create.user',
                'description'   => 'Create a user'
            ],

            [ 
                'name'          => 'View user',
                'slug'          => 'show.user',
                'description'   => 'See an individual user info'
            ],

            [ 
                'name'          => 'Edit user',
                'slug'          => 'edit.user',
                'description'   => 'Edit an existing user'
            ],

            [ 
                'name'          => 'Destroy user',
                'slug'          => 'destroy.user',
                'description'   => 'Remove a user permanently'
            ],

            [ 
                'name'          => 'Synchronize users with roles',
                'slug'          => 'sync.user.roles',
                'description'   => 'Used for both the user matrix and user role pages.'
            ],

            [ 
                'name'          => 'User search',
                'slug'          => 'search.user',
                'description'   => 'Able to search users'
            ],

            [ 
                'name'          => 'Show role list',
                'slug'          => 'show.role.index',
                'description'   => 'Can show the role list on the index page'
            ],

            [ 
                'name'          => 'Create role',
                'slug'          => 'create.role',
                'description'   => 'Create a role'
            ],

            [ 
                'name'          => 'View role',
                'slug'          => 'show.role',
                'description'   => 'See an individual role info'
            ],

            [ 
                'name'          => 'Edit role',
                'slug'          => 'edit.role',
                'description'   => 'Edit an existing role'
            ],

            [ 
                'name'          => 'Destroy role',
                'slug'          => 'destroy.role',
                'description'   => 'Remove a role permanently'
            ],

            [ 
                'name'          => 'Synchronize roles with users',
                'slug'          => 'sync.role.users',
                'description'   => 'Syncs a role with multiple users.'
            ],

            [ 
                'name'          => 'Synchronize roles with permissions',
                'slug'          => 'sync.role.permissions',
                'description'   => 'Used for both the role matrix and role permissions pages.'
            ],

            [ 
                'name'          => 'role search',
                'slug'          => 'search.role',
                'description'   => 'Able to search roles'
            ],

            [ 
                'name'          => 'Show permission list',
                'slug'          => 'show.permission.index',
                'description'   => 'Can show the permission list on the index page'
            ],

            [ 
                'name'          => 'Create permission',
                'slug'          => 'create.permission',
                'description'   => 'Create a permission'
            ],

            [ 
                'name'          => 'View permission',
                'slug'          => 'show.permission',
                'description'   => 'See an individual permission info'
            ],

            [ 
                'name'          => 'Edit permission',
                'slug'          => 'edit.permission',
                'description'   => 'Edit an existing permission'
            ],

            [ 
                'name'          => 'Destroy permission',
                'slug'          => 'destroy.permission',
                'description'   => 'Remove a permission permanently'
            ],

            [ 
                'name'          => 'Synchronize permissions with roles',
                'slug'          => 'sync.permission.roles',
                'description'   => 'Syncs a permission with multiple roles.'
            ],

            [ 
                'name'          => 'permission search',
                'slug'          => 'search.permission',
                'description'   => 'Able to search permissions'
            ],
        ];

        //insert permissions    
        DB::table('permissions')->insert($permissions);
    }
        
}
