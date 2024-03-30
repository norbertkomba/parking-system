<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function CreateUpdateUser(Request $request)
    {
        try {
            $user = User::updateOrCreate(
                ["id" => $request->user],
                [
                    'full_name' => $request->full_name,
                    'username' => $request->username,
                    'password' => !is_null($request->password) ? Hash::make($request->password) : false
                ]
            );
            $user->assignRole($request->role);
            return response()->json(["status" => JsonResponse::HTTP_OK, "message" => "User records saved successfully!"]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
