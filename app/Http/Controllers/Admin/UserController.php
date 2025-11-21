<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        // Ambil stats
        $stats = [
            'total' => User::count(),
            'superadmin' => User::role('super admin')->count(),
            'admin' => User::role('admin')->count(),
        ];
        
        // Ambil daftar user
        $users = User::with('roles')->latest()->paginate(15);

        return view('admin.users.index', compact('stats', 'users'));
    }
    
    public function create()
    {
        // Ambil role "admin" dan "super admin" saja
        $roles = Role::whereIn('name', ['admin', 'super admin'])->pluck('name', 'name');
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password_option' => ['required', 'in:auto,manual'],
            'password' => ['required_if:password_option,manual', 'nullable', 'string', 'min:8'],
            'role' => ['required', 'exists:roles,name'],
        ]);

        // Tentukan password
        $password = '';
        if ($request->password_option == 'auto') {
            $password = Str::random(10); // Buat 10 karakter acak
        } else {
            $password = $request->password;
        }

        // Buat User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        // Berikan Role
        $user->assignRole($request->role);

        // Redirect dengan info login (untuk notifikasi copy-paste)
        return redirect()->route('admin.users.index')->with('newUser', [
            'email' => $user->email,
            'password' => $password
        ]);
    }

    public function edit(User $user)
    {
        // PROTEKSI BACKEND: Cek apakah user mencoba mengedit diri sendiri
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'Anda tidak dapat mengedit akun Anda sendiri dari halaman ini.');
        }

        $roles = Role::whereIn('name', ['admin', 'super admin'])->pluck('name', 'name');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.users.index')
                             ->with('error', 'Anda tidak dapat mengedit akun Anda sendiri dari halaman ini.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'exists:roles,name'],
            'password' => ['nullable', 'string', 'min:8'], // Password opsional
        ]);

        // Update data dasar
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password HANYA JIKA diisi
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // Sinkronkan role
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // PROTEKSI BACKEND: Cek apakah user mencoba menghapus diri sendiri
        if (Auth::id() == $user->id) {
            return redirect()->route('admin.users.index')
                            ->with('error', 'Error: Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete(); // Ini akan otomatis soft delete

        return redirect()->route('admin.users.index')
                        ->with('success', 'User berhasil dihapus (soft delete).');
    }

    public function trash()
    {
        // Perintah 'onlyTrashed()' adalah kebalikan dari 'all()'
        // Dia HANYA mengambil data yang punya 'deleted_at'
        $users = User::onlyTrashed()->with('roles')->latest()->paginate(15);
        
        return view('admin.users.trash', compact('users'));
    }

    public function restore(User $user)
    {
        // Karena kita pakai ->withTrashed() di route, 
        // Laravel akan otomatis menemukan user-nya.
        
        $user->restore(); // Perintah ajaib untuk "un-delete"

        return redirect()->route('admin.users.trash')
                         ->with('success', 'User berhasil di-restore (dikembalikan).');
    }

    public function forceDelete(User $user)
    {
        // 'forceDelete()' akan menghapus data secara permanen, 
        // mengabaikan SoftDeletes.
        
        $user->forceDelete();

        return redirect()->route('admin.users.trash')
                         ->with('success', 'User berhasil dihapus permanen dari database.');
    }
}