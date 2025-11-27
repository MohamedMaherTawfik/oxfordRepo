<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index()
    {
        $staff = User::where('role', 'staff')
            ->with('staffPermissions')
            ->get();
        
        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'manage_users' => 'boolean',
            'manage_teachers' => 'boolean',
            'manage_courses' => 'boolean',
            'manage_categories' => 'boolean',
            'manage_diplomas' => 'boolean',
            'manage_payments' => 'boolean',
            'manage_certificates' => 'boolean',
            'manage_applies' => 'boolean',
            'manage_homepage' => 'boolean',
            'manage_footer' => 'boolean',
            'manage_staff' => 'boolean',
        ]);

        // Create user with staff role
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
        ]);

        // Create staff permissions
        Staff::create([
            'user_id' => $user->id,
            'manage_users' => $request->has('manage_users'),
            'manage_teachers' => $request->has('manage_teachers'),
            'manage_courses' => $request->has('manage_courses'),
            'manage_categories' => $request->has('manage_categories'),
            'manage_diplomas' => $request->has('manage_diplomas'),
            'manage_payments' => $request->has('manage_payments'),
            'manage_certificates' => $request->has('manage_certificates'),
            'manage_applies' => $request->has('manage_applies'),
            'manage_homepage' => $request->has('manage_homepage'),
            'manage_footer' => $request->has('manage_footer'),
            'manage_staff' => $request->has('manage_staff'),
        ]);

        return redirect()->route('admin.staff.index')
            ->with('success', 'تم إنشاء الموظف بنجاح');
    }

    /**
     * Display the specified staff member.
     */
    public function show(string $id)
    {
        $staff = User::where('role', 'staff')
            ->with('staffPermissions')
            ->findOrFail($id);
        
        return view('admin.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit(string $id)
    {
        $staff = User::where('role', 'staff')
            ->with('staffPermissions')
            ->findOrFail($id);
        
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff member in storage.
     */
    public function update(Request $request, string $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'manage_users' => 'boolean',
            'manage_teachers' => 'boolean',
            'manage_courses' => 'boolean',
            'manage_categories' => 'boolean',
            'manage_diplomas' => 'boolean',
            'manage_payments' => 'boolean',
            'manage_certificates' => 'boolean',
            'manage_applies' => 'boolean',
            'manage_homepage' => 'boolean',
            'manage_footer' => 'boolean',
            'manage_staff' => 'boolean',
        ]);

        // Update user
        $staff->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($request->filled('password')) {
            $staff->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        // Update permissions
        $permissions = $staff->staffPermissions;
        if ($permissions) {
            $permissions->update([
                'manage_users' => $request->has('manage_users'),
                'manage_teachers' => $request->has('manage_teachers'),
                'manage_courses' => $request->has('manage_courses'),
                'manage_categories' => $request->has('manage_categories'),
                'manage_diplomas' => $request->has('manage_diplomas'),
                'manage_payments' => $request->has('manage_payments'),
                'manage_certificates' => $request->has('manage_certificates'),
                'manage_applies' => $request->has('manage_applies'),
                'manage_homepage' => $request->has('manage_homepage'),
                'manage_footer' => $request->has('manage_footer'),
                'manage_staff' => $request->has('manage_staff'),
            ]);
        } else {
            Staff::create([
                'user_id' => $staff->id,
                'manage_users' => $request->has('manage_users'),
                'manage_teachers' => $request->has('manage_teachers'),
                'manage_courses' => $request->has('manage_courses'),
                'manage_categories' => $request->has('manage_categories'),
                'manage_diplomas' => $request->has('manage_diplomas'),
                'manage_payments' => $request->has('manage_payments'),
                'manage_certificates' => $request->has('manage_certificates'),
                'manage_applies' => $request->has('manage_applies'),
                'manage_homepage' => $request->has('manage_homepage'),
                'manage_footer' => $request->has('manage_footer'),
                'manage_staff' => $request->has('manage_staff'),
            ]);
        }

        return redirect()->route('admin.staff.index')
            ->with('success', 'تم تحديث الموظف بنجاح');
    }

    /**
     * Remove the specified staff member from storage.
     */
    public function destroy(string $id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        
        // Delete permissions
        if ($staff->staffPermissions) {
            $staff->staffPermissions->delete();
        }
        
        // Delete user
        $staff->delete();

        return redirect()->route('admin.staff.index')
            ->with('success', 'تم حذف الموظف بنجاح');
    }
}
