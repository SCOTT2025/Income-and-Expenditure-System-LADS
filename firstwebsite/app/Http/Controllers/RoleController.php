<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Role::with('permissions')->select(sprintf('%s.*', (new Role)->getTable()));

            return DataTables::of($query)
                ->addColumn('permissions', function ($row) {
                    return $row->permissions->pluck('name')->map(function ($name) {
                        return '<span class="badge bg-info text-dark">' . $name . '</span>';
                    })->implode(' ');
                })
                ->addColumn('actions', function ($row) {
                    return view('roles.partials.actions', compact('row'))->render();
                })
                ->rawColumns(['permissions', 'actions'])
                ->make(true);
        }

        // ✅ Fix: Pass roles to the view if not AJAX
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('success', 'Role deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate(['ids' => 'required|array']);
        Role::whereIn('id', $request->ids)->delete();

        return response()->json(['success' => true]);
    }
}
