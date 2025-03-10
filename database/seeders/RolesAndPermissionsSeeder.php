<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create roles
        $managerrole = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'employee']);
        $adminrole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'employee']);
        $roomservicesrole = Role::firstOrCreate(['name' => 'service', 'guard_name' => 'employee']);
        $finacialrole = Role::firstOrCreate(['name' => 'financial', 'guard_name' => 'employee']);
        $clientrole = Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);



        // Create All Permissions
        $permissions_wishlist = ['wishlist.index', 'wishlist.create', 'wishlist.delete'];
        $permissions_user = ['user.index', 'user.show', 'user.delete'];
        $permissions_services = ['services.index', 'services.create', 'services.update', 'services.delete', 'services.Filter'];
        $permissions_reservation = ['reservation.index', 'reservation.show', 'reservation.create', 'reservation.update', 'reservation.delete'];
        $permissions_room = ['rooms.index', 'rooms.create', 'rooms.show', 'rooms.update', 'rooms.delete', 'room.Filter'];
        $permissions_review = ['review.index', 'review.store', 'review.delete'];
        $permissions_loyalty = ['loyalty.index', 'loyalty.show', 'loyalty.store', 'loyalty.update', 'loyalty.delete'];
        $permissions_financial = ['financial.manage', 'financial.index', 'financial.store', 'financial.update', 'financial.delete'];
        $permissions_employee = ['employee.index', 'employee.show', 'employee.store', 'employee.update', 'employee.delete', 'employee.Filter'];
        $permissions_category = ['category.index', 'category.show', 'category.store', 'category.update', 'category.delete'];

        // Merager  AllPermissions
        $allPermissions = array_merge(
            $permissions_wishlist,
            $permissions_user,
            $permissions_services,
            $permissions_room,
            $permissions_review,
            $permissions_reservation,
            $permissions_loyalty,
            $permissions_financial,
            $permissions_employee,
            $permissions_category
        );

        // Create Permissions

        foreach ($allPermissions as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'employee']);
        }

        $managerPermissions = Permission::where('guard_name', 'employee')->get();
        $managerrole->syncPermissions($managerPermissions);



        $userPermissions = array_diff($permissions_user, ['user.delete']);
        $categoryPermissions = array_diff($permissions_category, ['category.delete', 'category.create']);
        $roomPermissions = array_diff($permissions_room, ['rooms.delete', 'rooms.store']);
        $alladminpermissions = array_merge(
            $userPermissions,
            $permissions_services,
            $roomPermissions,
            $permissions_review,
            $permissions_reservation,
            $categoryPermissions
        );

        $adminPermissions = Permission::whereIn('name', $alladminpermissions)
            ->where('guard_name', 'employee')
            ->get();
        $adminrole->syncPermissions($adminPermissions);


        // asign permissions for client
        $filteredRoomPermissions = array_diff($permissions_room, ['room.delete', 'room.create', 'room.update']); //  ضمنتها فوق حطله صلاحية للبحث
        $filteredservicesPermissions = array_diff($permissions_services, ['services.delete', 'services.create', 'services.update']); // حطيت فوق ضمنت حطله صلاحية للبحث
        $filtereduserPermissions = array_diff($permissions_user, ['user.index']);

        $allClientPermissions = array_merge(
            $permissions_review,
            $permissions_wishlist,
            $permissions_reservation,
            $filtereduserPermissions,
            $filteredservicesPermissions,
            $filteredRoomPermissions,
        );
        $ClientPermissions = Permission::whereIn('name', $allClientPermissions)
            ->where('guard_name', 'web')
            ->get();
        $clientrole->syncPermissions($ClientPermissions);


        // asign permissions for finincial Employee

        $finacialPermissions = Permission::whereIn('name', $permissions_financial)
            ->where('guard_name', 'employee')
            ->get();
        $finacialrole->syncPermissions($finacialPermissions);


        // asign permissions for roomservices
        $roomservicesPermissions = array_diff($permissions_services, ['services.delete']);
        $roomservicesPermissions = Permission::whereIn('name', $roomservicesPermissions)
            ->where('guard_name', 'employee')
            ->get();
        $roomservicesrole->syncPermissions($roomservicesPermissions);




        //  create seeder  Account Manager

        $manager = Employee::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Example Manager User',
                'contactinfo' => '0934442050',
                'password' => bcrypt('0934442050'),
                'salary' => '0',
                'role' => 'manager',
            ]
        );
        $manager->assignRole('manager');


        //  create seeder  Account Admin

        $admin = Employee::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'contactinfo' => '0964442050',
                'password' => bcrypt('0964442050'),
                'salary' => '100',
                'role' => 'admin',

            ]
        );
        $admin->assignRole('admin');
    }
}
