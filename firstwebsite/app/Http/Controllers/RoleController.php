<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of roles.
     * If it's an AJAX request (like from DataTables), return JSON data.
     * Otherwise, return the roles.index view.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch roles with their permissions
            $query = Role::with('permissions')->select(sprintf('%s.*', (new Role)->getTable()));

            return DataTables::of($query)
                // Show each permission as a badge
                ->addColumn('permissions', function ($row) {
                    return $row->permissions->pluck('name')->map(function ($name) {
                        return '<span class="badge bg-info text-dark">' . $name . '</span>';
                    })->implode(' ');
                })
                // Add actions column (Edit/Delete buttons)
                ->addColumn('actions', function ($row) {
                    return view('roles.partials.actions', compact('row'));
                })
                // Mark these columns as raw HTML
                ->rawColumns(['permissions', 'actions'])
                ->make(true);
        }

        // Show the main roles listing page
        return view('roles.index');
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        // Get all available permissions to show in the form
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in the database.
     */
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'title' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        // Create the new role
        $role = Role::create(['name' => $request->title]);

        // Assign selected permissions to the role
        $role->syncPermissions($request->permissions);

        // Redirect to roles list with a success message
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    /**
     * Display the details of a specific role.
     */
    public function show(Role $role)
    {
        // Load the role's permissions
        $role->load('permissions');
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing an existing role.
     */
    public function edit(Role $role)
    {
        // Get all permissions and load the role's existing ones
        $permissions = Permission::all();
        $role->load('permissions');
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified role in the database.
     */
    public function update(Request $request, Role $role)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        // Update role name
        $role->update(['name' => $request->title]);

        // Sync selected permissions
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    /**
     * Delete the specified role.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', 'Role deleted successfully!');
    }

    /**
     * Bulk delete multiple roles at once (from checkbox selection).
     */
    public function massDestroy(Request $request)
    {
        Role::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => "Roles deleted successfully."]);
    }
}
