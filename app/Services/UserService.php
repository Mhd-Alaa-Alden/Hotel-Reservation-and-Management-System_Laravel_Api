<?php

namespace App\Services;

use  App\Models\User;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class UserService
{

    // public function appendRolesAndPermissions($user)
    // {
    //     $roles = [];
    //     foreach ($user->roles as $role) {
    //         $roles[] = $role->name;
    //     }
    //     unset($user['roles']);
    //     $user['roles'] = $roles;

    //     $permissions = [];
    //     foreach ($user->permissions as $permission) {
    //         $permissions[] = $permission->name;
    //     }
    //     unset($user['permissions']);
    //     $user['permissions'] = $permissions;

    //     return $user;
    // }
}
