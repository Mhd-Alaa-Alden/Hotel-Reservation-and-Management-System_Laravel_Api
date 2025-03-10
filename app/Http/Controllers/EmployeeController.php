<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $employee = Employee::all();
        return response()->json(['message' => 'All Employee', 'Employee' => $employee], 200);
    }

    // funcftion Search employees
    public function searchemployee(SearchRequest $request)
    {
        $query = Employee::query();

        if ($request->filled('role')) {
            $query->where('role', 'LIKE', '%' . $request->role . '%');
        }
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }


        if ($request->filled('sortby') && $request->filled('sortorder')) {
            $allowedSortFields = ['price', 'created_at', 'name']; //  حماية من SQL Injection
            $sortField = in_array($request->sortby, $allowedSortFields) ? $request->sortby : 'created_at';
            $sortOrder = in_array(strtolower($request->sortorder), ['asc', 'desc']) ? $request->sortorder : 'asc';

            $query->orderBy($sortField, $sortOrder);
        }

        $filteredemployee = clone $query; 


        $employee = $filteredemployee->paginate(3);

        if ($employee->isEmpty()) {
            return response()->json([
                'status' => '0',
                'message' => 'No employee found matching your criteria.',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => '1',
            'message' => 'success',
            'data' => $filteredemployee->paginate(5),
            'allAvailableEmployee' => Employee::paginate(5),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(EmployeeRequest $request)
    {
        $validated =  $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        $employee = Employee::create($validated);

        $role = Role::where('name', $validated['role'])->where('guard_name', 'employee')->first();
        if ($role) {
            $employee->assignRole($role);
            $employee->load('roles.permissions');

            $roles = $employee->roles->pluck('name');
            $permissions = $employee->roles->flatMap->permissions->pluck('name');

            $token = $employee->createToken("API TOKEN")->plainTextToken;


            return response()->json([
                'message' => 'Successfully added to Employee',
                'employee' => [
                    'id' => $employee->id,
                    'token' => $token,
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'role' => $employee->role,
                    'salary' => $employee->salary,
                    'contactinfo' => $employee->contactinfo,
                    'created_at' => $employee->created_at,
                    'updated_at' => $employee->updated_at,
                    'roles' => $roles,
                    'permissions' => $permissions
                ]
            ], 200);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json([
                'message' => 'employee not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee Show successfully.',
            'Employee_Details' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id); {
            $vaildated = $request->validated();
            $employee->update($vaildated);

            return response()->json($employee, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        Employee::destroy($id);

        return response()->json([

            'status' => '1',
            'message' => 'Employee Deleted Successfully',
            'status' => '200',
        ]);
    }
}
