<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Paginate the roles and eager load the permissions
        $roles = Role::with('permissions')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all permissions for creating a role
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'nullable|array',
            'description' => 'nullable|string|max:255'
        ]);

        // Create the new role with optional description
        $role = Role::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null
        ]);

        // Sync permissions if provided
        if (isset($validatedData['permissions']) && count($validatedData['permissions']) > 0) {
            $role->syncPermissions($validatedData['permissions']);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        // Eager load permissions to avoid N+1 query
        $role->load('permissions');

        // Get users with this role
        $users = User::role($role->name)->paginate(10);

        return view('roles.show', compact('role', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // Eager load the permissions and get all available permissions
        $role->load('permissions');
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'description' => 'nullable|string|max:255'
        ]);

        // Update role with the validated data
        $role->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null
        ]);

        // Sync permissions if provided, or remove all permissions if none are selected
        if (isset($validatedData['permissions']) && count($validatedData['permissions']) > 0) {
            $role->syncPermissions($validatedData['permissions']);
        } else {
            $role->syncPermissions([]); // Remove all permissions if none are selected
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Prevent deletion of the 'admin' role
        if ($role->name === 'admin') {
            return redirect()->route('roles.index')
                ->with('error', 'Cannot delete the admin role.');
        }

        // Delete the role
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
