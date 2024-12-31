<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'fullname' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[\w._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Missing required parameters',
                'errors' => $validator->messages(),
            ], 400);
        }


        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        event(new Registered($user));

        //create token
        // $token = $user->createToken('token_for' . $user->email)->plainTextToken;



        return response()->json([

            'success' => true,
            'data' => [
                'user' => [
                    "username" => $user->username,
                    "email" => $user->email
                ],

            ],
            'message' => "User Registered successfully",
            'errors' => null

        ], 201);
    }
}
