<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $data = $request->validated();

        if (User::where('username', $data['username'])->exists()) {
            return response()->json([
                "errors" => [
                    'message' => 'Username already registered'
                ]
            ], 400);
        } else {
            $user = new User($data);
            $user->password = Hash::make($data['password']);
            $user->save();
            return (new UserResource($user))->response()->setStatusCode(201);
        }
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('username', $data['username'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                "errors" => [
                    'message' => 'username or password wrong'
                ]
            ], 401);
        }

        $user->token = Str::uuid()->toString();
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function get(Request $request)
    {
        $user = Auth::user();
        return (new UserResource($user));
    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        
        if (isset($data['name'])) {
            $user->name = $data['name'];
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->token = null;
        $user->save();

        return response()->json([
            "message" => "Logout success"
        ], 200);
    }
}
