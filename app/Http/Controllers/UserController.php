<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userservice;

    public function __construct(UserRepository $userservice)
    {
        $this->userservice = $userservice;
    }

    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed'
        ]);

        $user = $this->userservice->store($request->all());

        if($user) {
        return response()->json([
            'token' => $user->createToken('tokens')->plainTextToken,
            'message' => 'User created successfully!',
            'data' => $user
        ],200);
    }
        return response()->json([
          'Message' => 'Registration failed!',
           'status' => 'error'
        ], 500);
   }

    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:4'
        ]);

        if (!Auth::attempt($validator)) {
            response()->json([
                'Message' => 'Credentials do not match!',
                'status' => 'error'
            ], 401);
        }
        return response()->json([
            'Message' => 'You have successfully logged in!',
             'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked',
            'status' => 'You have been successfully logged out'
        ]);
    }

}
