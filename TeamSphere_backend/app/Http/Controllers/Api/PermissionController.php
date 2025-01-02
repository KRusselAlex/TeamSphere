<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;
use App\Http\Resources\PermissionResource;
// use App\Models\Notification;
use Illuminate\Support\Facades\Notification;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Notifications\PermissionNotification;
use Exception;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        try {

            $user = $request->user();


            if ($user->role == 1) {

                $permissions = DB::table('permissions')
                ->join('users', 'permissions.user_id', '=', 'users.id')
                ->select('permissions.*', 'users.username', 'users.fullname')
                ->paginate(30);
            } else {

                $permissions = DB::table('permissions')
                ->where('permissions.user_id', '=', $user->id)
                    ->join('users', 'permissions.user_id', '=', 'users.id')
                    ->select('permissions.*', 'users.username', 'users.fullname')
                    ->paginate(30);
            }


            if ($permissions->isNotEmpty()) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        "permissions" => PermissionResource::collection($permissions)
                    ],
                    'message' => "Permissions retrieved successfully",
                    'errors' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => "No Permissions Available",
                    'errors' => ['permission' => 'No Permissions available']
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving Permissions, database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function show($id)
    {

        try {
            $permission = Permission::find($id);

            if ($permission) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "permission" => $permission
                    ],
                    'message' => "Permission retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Permission not found',
                    'errors' => ['permission' => 'Permission not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving Permission,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'permission_type' => 'required|in:sick,vacation,personal,other',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required|string',
                'justification' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            ]);



            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Missing required parameters',
                    'errors' => $validator->messages(),
                ], 400);
            }

            $justificationPath = null;
            if ($request->hasFile('justification')) {

                $justificationPath = $request->file('justification')->store('justifications', 'public');
            }

            $permission = Permission::create([
                'user_id' => $request->user_id,
                'permission_type' => $request->permission_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => $request->reason,
                'justification' => $justificationPath
            ]);

            return response()->json([

                'success' => true,
                'data' => [
                    "permission" => $permission
                ],
                'message' => "Permission created successfully",
                'errors' => null

            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while creating Permission ,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $permission = Permission::with('user')->find($id);


            if ($permission) {
                $validator = Validator::make($request->all(), [
                    'status' => 'required|string',
                    'admin_id' => 'required|exists:users,id',

                ]);

                $admin = User::find($request->admin_id);
                if ($validator->fails()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Missing required parameters',
                        'errors' => $validator->messages(),
                    ], 400);
                }

                $permission_ok = $permission->update([
                    "status" => $request->status,
                    "admin_id" => $request->admin_id,
                    "notification_sent" => true
                ]);

                if ($permission_ok) {
                    Notification::route('mail', $permission->user->email)->notify(
                        new PermissionNotification($permission->status, $permission->permission_type, $permission->user->fullname, $admin->fullname)
                    );
                }


                //  if($permission_ok){
                //     $notification = Notification::create([
                //         'user_id' => $permission->user_id,
                //         'message' => "alex on refuse"
                //     ]);
                //  }

                return response()->json([

                    'success' => true,
                    'data' => [
                        "permission" => $permission,
                        // 'notifiaction'=> new NotificationResource($notification)
                    ],
                    "message" => "Permission request updated and notification sent",
                    'errors' => null

                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Permission not found',
                    'errors' => ['permission' => 'Permission not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while updating Permission,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    public function search_permissions($query)
    {

        try {
            $searchTerm =  strtolower($query);
            $permissions = DB::table('permissions')
                ->join('users', 'permissions.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.username', 'like', "%$searchTerm%")
                        ->orWhere('users.fullname', 'like', "%$searchTerm%");
                })
                ->select('permissions.*', 'users.username', 'users.fullname')
                ->paginate(30);


            if ($permissions->isNotEmpty()) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "permissions" => $permissions
                    ],
                    'message' => "Permissions retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Permissions Available",
                    'errors' => ['permissions' => 'No users available']
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
            $Permission = Permission::find($id);

            if ($Permission) {
                $Permission->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Permission deleted successfully',
                    'errors' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Permission not found',
                    'errors' => ['permission' => 'Permission not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while deleting Permission,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }
}
