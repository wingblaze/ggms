<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;
use App\Permission;

class ACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles();
        $this->permissions();

        $this->default_these_accounts_have_these_roles();
        $this->default_these_roles_have_these_permissions();
    }

    public function roles(){
    	DB::table('roles')->insert([
                [
                'name' => 'system_administrator',
                'display_name' => "System Administrator",
                'description' => "Manager in charge of facilities",
                ],
                [
                'name' => 'golf_ops_manager',
                'display_name' => "Golf Operations Manager",
                'description' => "Manager in charge of golf processes",
                ],
                [
                'name' => 'membership_manager',
                'display_name' => "Membership Manager",
                'description' => "Manager in charge of registration and application process",
                ],
                [
                'name' => 'marketing_manager',
                'display_name' => "Marketing Manager",
                'description' => "Manager in charge of events and reports",
                ],
                [
                'name' => 'employee',
                'display_name' => "Employee",
                'description' => "A generic employee",
                ],
                [
                'name' => 'user',
                'display_name' => "User",
                'description' => "A generic user",
                ]]
                );
    }

    public function permissions(){
        DB::table('permissions')->insert([
                // CRUD permissions for accounts
                [
                'name' => 'view_accounts',
                'display_name' => "View Accounts",
                'description' => "View all membership accounts",
                ],
                [
                'name' => 'create_account',
                'display_name' => "Create an Account",
                'description' => "Create a new membership account",
                ],
                [
                'name' => 'edit_account',
                'display_name' => "Edit an Account",
                'description' => "Edit an existing membership account",
                ],
                [
                'name' => 'delete_account',
                'display_name' => "Delete an Account",
                'description' => "Delete an existing membership account",
                ],

                // CRUD permissions for users
                [
                'name' => 'view_users',
                'display_name' => "View users",
                'description' => "View all users",
                ],
                [
                'name' => 'create_user',
                'display_name' => "Create an user",
                'description' => "Create a new user",
                ],
                [
                'name' => 'edit_user',
                'display_name' => "Edit an user",
                'description' => "Edit an existing user",
                ],
                [
                'name' => 'delete_user',
                'display_name' => "Delete an user",
                'description' => "Delete an existing user",
                ],

                // CRUD permissions for groups
                [
                'name' => 'view_groups',
                'display_name' => "View groups",
                'description' => "View all groups",
                ],
                [
                'name' => 'create_group',
                'display_name' => "Create a group",
                'description' => "Create a new group",
                ],
                [
                'name' => 'edit_group',
                'display_name' => "Edit a group",
                'description' => "Edit an existing group",
                ],
                [
                'name' => 'delete_group',
                'display_name' => "Delete a group",
                'description' => "Delete an existing group",
                ],

                // CRUD permissions for events
                [
                'name' => 'view_events',
                'display_name' => "View events",
                'description' => "View all events",
                ],
                [
                'name' => 'create_event',
                'display_name' => "Create an event",
                'description' => "Create a new event",
                ],
                [
                'name' => 'edit_event',
                'display_name' => "Edit an event",
                'description' => "Edit an existing event",
                ],
                [
                'name' => 'delete_event',
                'display_name' => "Delete an event",
                'description' => "Delete an existing event",
                ],

                // CRUD permissions for resources
                [
                'name' => 'view_resources',
                'display_name' => "View facilities",
                'description' => "View all facilities",
                ],
                [
                'name' => 'create_resource',
                'display_name' => "Create a facility",
                'description' => "Create a new facility",
                ],
                [
                'name' => 'edit_resource',
                'display_name' => "Edit a facility",
                'description' => "Edit an existing facility",
                ],
                [
                'name' => 'delete_resource',
                'display_name' => "Delete a facility",
                'description' => "Delete an existing facility",
                ],
                [
                'name' => 'rent_resource',
                'display_name' => "Rent a facility",
                'description' => "Rent a facility",
                ],

                // CRUD permissions for reports
                [
                'name' => 'view_reports',
                'display_name' => "View a report",
                'description' => "View a report",
                ]]
                );
    }

    public function default_these_roles_have_these_permissions()
    {
        // Roles

        $system_administrator = Role::where('name', 'system_administrator')->first();
        $golf_ops_manager = Role::where('name', 'golf_ops_manager')->first();
        $marketing_manager = Role::where('name', 'marketing_manager')->first();
        $membership_manager = Role::where('name', 'membership_manager')->first();
        $employee = Role::where('name', 'employee')->first();
        $user = Role::where('name', 'user')->first();


        // Permissions

        $view_accounts = Permission::where('name', 'view_accounts')->first();
        $create_account = Permission::where('name', 'create_account')->first();
        $edit_account = Permission::where('name', 'edit_account')->first();
        $delete_account = Permission::where('name', 'delete_account')->first();

        $membership_manager->attachPermission($view_accounts);
        $membership_manager->attachPermission($create_account);
        $membership_manager->attachPermission($edit_account);
        $membership_manager->attachPermission($delete_account);

        $view_users = Permission::where('name', 'view_users')->first();
        $create_user = Permission::where('name', 'create_user')->first();
        $edit_user = Permission::where('name', 'edit_user')->first();
        $delete_user = Permission::where('name', 'delete_user')->first();

        $membership_manager->attachPermission($view_users);
        $membership_manager->attachPermission($create_user);
        $membership_manager->attachPermission($edit_user);
        $membership_manager->attachPermission($delete_user);


        
        $view_groups = Permission::where('name', 'view_groups')->first();
        $create_group = Permission::where('name', 'create_group')->first();
        $edit_group = Permission::where('name', 'edit_group')->first();
        $delete_group = Permission::where('name', 'delete_group')->first();

        $membership_manager->attachPermission($view_groups);
        $membership_manager->attachPermission($create_group);
        $membership_manager->attachPermission($edit_group);
        $membership_manager->attachPermission($delete_group);



        
        
        $view_events = Permission::where('name', 'view_events')->first();
        $create_event = Permission::where('name', 'create_event')->first();
        $edit_event = Permission::where('name', 'edit_event')->first();
        $delete_event = Permission::where('name', 'delete_event')->first();

        $marketing_manager->attachPermission($view_events);
        $marketing_manager->attachPermission($create_event);
        $marketing_manager->attachPermission($edit_event);
        $marketing_manager->attachPermission($delete_event);

        $view_reports = Permission::where('name', 'view_reports')->first();
        $marketing_manager->attachPermission($view_reports);
        
        $view_resources = Permission::where('name', 'view_resources')->first();
        $create_resource = Permission::where('name', 'create_resource')->first();
        $edit_resource = Permission::where('name', 'edit_resource')->first();
        $delete_resource = Permission::where('name', 'delete_resource')->first();

        $system_administrator->attachPermission($view_resources);
        $system_administrator->attachPermission($create_resource);
        $system_administrator->attachPermission($edit_resource);
        $system_administrator->attachPermission($delete_resource);

        // Permissions for users
        $user->attachPermission($view_events);
        $user->attachPermission($view_resources);
        $user->attachPermission($view_groups);


    }

    public function default_these_accounts_have_these_roles()
    {
        // Roles
        $system_administrator = Role::where('name', 'system_administrator')->first();
        $golf_ops_manager = Role::where('name', 'golf_ops_manager')->first();
        $marketing_manager = Role::where('name', 'marketing_manager')->first();
        $membership_manager = Role::where('name', 'membership_manager')->first();
        $employee = Role::where('name', 'employee')->first();
        $user = Role::where('name', 'user')->first();

        User::findOrFail(1)->attachRole($system_administrator);
        User::findOrFail(1)->attachRole($employee);

        User::findOrFail(2)->attachRole($golf_ops_manager);
        User::findOrFail(2)->attachRole($employee);

        User::findOrFail(3)->attachRole($marketing_manager);
        User::findOrFail(3)->attachRole($employee);

        User::findOrFail(4)->attachRole($membership_manager);
        User::findOrFail(4)->attachRole($employee);

        // The rest of the defaults are users
        for ($i = 5; $i <= 14; $i++){
            User::findOrFail($i)->attachRole($user);
        }

    }
}
