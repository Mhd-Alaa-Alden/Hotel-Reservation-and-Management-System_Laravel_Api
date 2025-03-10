<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class AuthnController extends Controller

{
    use HasApiTokens;


    private function appendRolesAndPermissions($user)
    {
        $roles = [];
        foreach ($user->roles as $role) {
            $roles[] = $role->name;
        }
        unset($user['roles']);
        $user['roles'] = $roles;

        $permissions = [];
        foreach ($user->permissions as $permission) {
            $permissions[] = $permission->name;
        }
        unset($user['permissions']);
        $user['permissions'] = $permissions;

        return $user;
    }

    public function register(RegisterRequest  $request)
    {

        $validated = $request->validated();
        $validated['loyalty_level'] = 1;
        $validated['total_points'] = 10;

        //Start Uploading images 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = Storage::disk('public')->put('Users_image', $image);
            // $path = $image->store('Products_images', 'public');  logic 2 -> store   طريقة 2
            $validated['image'] = $path;
            //End Uploading images 
        }
        $user = User::create($validated);

        // for search role client and assignrole for user
        $clientRole = Role::query()->where('name', 'client')->first();
        $user->assignRole($clientRole);
        //permission 
        $permission = $clientRole->permissions()->pluck('name')->toArray();
        $user->givepermissionTo($permission);

        //load the users role and permissions (list)
        $user->load('roles', 'permissions');

        //reload the user instance to get update roles and permissions
        $user = User::query()->find($user['id']);
        $user = $this->appendRolesAndPermissions($user);


        event(new Registered($user));
        // $request->user()->sendEmailVerificationNotification();

        $token = $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'status' => 1,
            'token' => $token,
            'message' => 'User Register successfully',
            'user' => $user
        ]);
    }


    // -----------------------------------------------------------------------------------------------


    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            return $this->getAuthData($user, "User logged in successfully");
        }

        if (Auth::guard('employee')->attempt($validated)) {
            $employee = Auth::guard('employee')->user();
            return $this->getAuthData($employee, "Employee logged in successfully");
        }

        return response()->json([
            'status' => 0,
            'message' => 'Email & Password Do Not Match Our Records.'
        ], 401);
    }

    private function getAuthData($user, $message)
    {
        $token = $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'status' => 1,
            'message' => $message,
            'token' => $token,
            'user_data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'salary' => $user->salary ?? null,
                'contactinfo' => $user->contactinfo ?? null,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
            'role' => $user->getRoleNames()->first(),
            'permissions' => $user->getAllPermissions()->pluck('name')->toArray()
        ], 200);
    }


    // -------------------------------------------------------

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 1,
            'message' => 'User logged out successfully.'
        ]);
    }
    // -----------------------------------------------------------
    // Verify Email 
    public function VerifyNotice()
    {
        return response()->json(['message' => 'VerifyNotice successfully'], 201);
    }

    public function VerifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return response()->json(['message' => 'verfiy Email Handling successfully'], 201);
    }


    public function ResendEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent!'], 201);
    }
}
