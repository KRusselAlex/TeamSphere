<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            $user = User::Paginate(30);
            if ($user->count() > 0) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "users" => UserResource::collection($user)
                    ],
                    'message' => "Users retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Users Available",
                    'errors' => ['user' => 'No users available']
                ], 200);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving users,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    public function show($id)
    {

        try {
            $user = User::find($id);

            if ($user) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "user" => new UserResource($user)
                    ],
                    'message' => "User retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'User not found',
                    'errors' => ['user' => 'User not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving user,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function store(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:users,username',
                'fullname' => 'required|string|max:255',
                'department' => 'nullable|string|max:255',
                'role' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
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

            $imagePath = null;


            if ($request->hasFile('image')) {

                $imagePath = $request->file('image')->store('images', 'public');

            }

            $user = User::create([

                'username' => $request->username,
                'fullname' => $request->fullname,
                'department' => $request->department,
                'role' => $request->role ?? false,
                'email' => $request->email,
                'image' => $imagePath,
                'password' => $request->password,

            ]);

            return response()->json([

                'success' => true,
                'data' => [
                    "user" => $user
                ],
                'message' => "User created successfully",
                'errors' => null

            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while creating user ,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $user = User::find($id);
            if ($user) {
                $validator = Validator::make($request->all(), [
                    'username' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('users', 'username')->ignore($user->id),
                    ],
                    'fullname' => 'required|string|max:255',
                    'department' => 'nullable|string|max:255',
                    'role' => 'nullable|boolean',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
                    'email' => [
                        'required',
                        'email',
                        Rule::unique('users', 'email')->ignore($user->id),
                        'regex:/^[\w._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/',
                    ],
                    'password' => [
                        'string',
                        'min:8',
                        'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/',
                    ],
                    'currentpassword' => [
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

                $updated_data = [
                    'username' => $request->username,
                    'fullname' => $request->fullname,
                    'department' => $request->department,
                    'role' => $request->role,
                    'email' => $request->email,
                ];

                if ($request->image) {

                    $imagePath = $request->file('image')->store('images', 'public');
                    $updated_data['image'] = $imagePath;
                }


                if (Hash::check($request->input('currentpassword'), $user->password)) {

                    if ($request->input('password')) {

                        $updated_data['password'] = $request->password;
                    }

                    $user->update($updated_data);

                    return response()->json([

                        'success' => true,
                        'data' => [
                            "user" => $user
                        ],
                        "message" => "updated successfully",
                        'errors' => null

                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'data' => null,
                        "message" => "current password incorrect",
                        'errors' => ['password' => 'current password incorrect']
                    ], 401);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'User not found',
                    'errors' => ['user' => 'User not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while updating user,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function search_users($query)
    {

        try {
            $searchTerm =  strtolower($query);
            $users = DB::table('users')
                ->Where('username','like',"%$searchTerm%")
                ->orWhere('fullname','like',"%$searchTerm%")
                ->orWhere('department','like',"%$searchTerm%")
                ->orWhere('email','like',"%$searchTerm%")
                ->Paginate(30);

            if ($users->isNotEmpty()) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "users" => UserResource::collection($users)
                    ],
                    'message' => "Users retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Users Available",
                    'errors' => ['user' => 'No users available']
                ], 200);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving users,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }



    }



    public function destroy($id)
    {

        try {
            $user = User::find($id);

            if ($user) {
                $user->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'User deleted successfully',
                    'errors' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found',
                    'errors' => ['user' => 'User not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while deleting user,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }
}
