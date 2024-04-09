<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePassword;
use App\Http\Requests\StoreUpdateRole;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function UpdateCreateUser(StoreUpdateUser $request) {
        try {
            $user = User::updateOrCreate(["id" => $request->user],[
                'full_name' => $request->full_name,
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $user->syncRoles($request->role);
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "User records saved successfully!"]);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function ChangeUserPassword(StoreUpdatePassword $password) {
        try {
            $user = User::find($password->id);
                $user->update(['password' => Hash::make($password->password)]);
                return response()->json(['status' => JsonResponse::HTTP_OK, 'message' => 'Password changed successfully!']);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function UpdateCreateUserRole(StoreUpdateRole $request) {
        try {
            if ($request->ajax()) {
                Role::updateOrCreate(['id' => $request->role],['name' => $request->group])->syncPermissions($request->permission);
                return response()->json(['status'=>JsonResponse::HTTP_OK,'message'=>'User role records saved successfully!']);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
