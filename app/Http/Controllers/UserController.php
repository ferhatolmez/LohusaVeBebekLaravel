<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        // Require admin role for all methods implicitly via gate check below
    }

    public function index(): View
    {
        $this->authorizeAdmin();

        $users = User::with('roles')->latest()->paginate(20);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $this->authorizeAdmin();

        $roles = [
            Role::Admin->value => Role::Admin->label(),
            Role::Ebe->value => Role::Ebe->label(),
            Role::Student->value => Role::Student->label(),
        ];

        return view('users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,ebe,student'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    public function edit(User $user): View
    {
        $this->authorizeAdmin();

        $roles = [
            Role::Admin->value => Role::Admin->label(),
            Role::Ebe->value => Role::Ebe->label(),
            Role::Student->value => Role::Student->label(),
        ];

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'string', 'in:admin,ebe,student'],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorizeAdmin();

        if (auth()->id() === $user->id) {
            return back()->with('error', 'Kendi hesabınızı silemezsiniz.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Kullanıcı silindi.');
    }

    private function authorizeAdmin(): void
    {
        if (! auth()->user()->hasRole('admin')) {
            abort(403, 'Bu işlem için yetkiniz yok.');
        }
    }
}
