<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    /**
     * @OA\Get(
     * path="/api/users",
     * tags={"Users"},
     * summary="Get list of users",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(15);
        return $this->sendResponse($users, 'Data user berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/users",
     * tags={"Users"},
     * summary="Create new user",
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "email", "role", "password_option"},
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="email", type="string", format="email"),
     * @OA\Property(property="role", type="string"),
     * @OA\Property(property="password_option", type="string", enum={"auto", "manual"}),
     * @OA\Property(property="password", type="string")
     * )
     * ),
     * @OA\Response(response=200, description="Created successfully")
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password_option' => ['required', 'in:auto,manual'],
            'password' => ['required_if:password_option,manual', 'nullable', 'string', 'min:8'],
            'role' => ['required', 'exists:roles,name'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $password = $request->password_option == 'auto' ? Str::random(10) : $request->password;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole($request->role);

        return $this->sendResponse([
            'user' => $user,
            'generated_password' => $password
        ], 'User berhasil dibuat.');
    }

    /**
     * @OA\Get(
     * path="/api/users/{id}",
     * tags={"Users"},
     * summary="Get specific user",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function show($id)
    {
        $user = User::with('roles')->find($id);
        if (is_null($user)) {
            return $this->sendError('User tidak ditemukan.');
        }
        return $this->sendResponse($user, 'Detail user berhasil diambil.');
    }

    /**
     * @OA\Put(
     * path="/api/users/{id}",
     * tags={"Users"},
     * summary="Update user",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\JsonContent(
     * required={"name", "email", "role"},
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="email", type="string", format="email"),
     * @OA\Property(property="role", type="string"),
     * @OA\Property(property="password", type="string", description="Optional")
     * )
     * ),
     * @OA\Response(response=200, description="Updated successfully")
     * )
     */
    public function update(Request $request, User $user)
    {
        if (Auth::id() == $user->id) {
            return $this->sendError('Forbidden.', ['error' => 'Anda tidak dapat mengedit akun Anda sendiri melalui endpoint ini.'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'exists:roles,name'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles([$request->role]);

        return $this->sendResponse($user, 'User berhasil diperbarui.');
    }

    /**
     * @OA\Delete(
     * path="/api/users/{id}",
     * tags={"Users"},
     * summary="Soft delete user",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Deleted successfully")
     * )
     */
    public function destroy(User $user)
    {
        if (Auth::id() == $user->id) {
            return $this->sendError('Forbidden.', ['error' => 'Anda tidak dapat menghapus akun Anda sendiri.'], 403);
        }

        $user->delete();
        return $this->sendResponse([], 'User berhasil dihapus (soft delete).');
    }

    /**
     * @OA\Get(
     * path="/api/users/trash",
     * tags={"Users"},
     * summary="Get trashed users",
     * security={{"bearerAuth":{}}},
     * @OA\Response(response=200, description="Successful operation")
     * )
     */
    public function trash()
    {
        $users = User::onlyTrashed()->with('roles')->latest()->paginate(15);
        return $this->sendResponse($users, 'Data sampah user berhasil diambil.');
    }

    /**
     * @OA\Post(
     * path="/api/users/{id}/restore",
     * tags={"Users"},
     * summary="Restore trashed user",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Restored successfully")
     * )
     */
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        if (!$user) {
            return $this->sendError('User tidak ditemukan.');
        }
        $user->restore();
        return $this->sendResponse($user, 'User berhasil dikembalikan.');
    }

    /**
     * @OA\Delete(
     * path="/api/users/{id}/force",
     * tags={"Users"},
     * summary="Force delete user permanently",
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Permanently deleted")
     * )
     */
    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);
        if (!$user) {
            return $this->sendError('User tidak ditemukan.');
        }
        $user->forceDelete();
        return $this->sendResponse([], 'User berhasil dihapus permanen.');
    }
}