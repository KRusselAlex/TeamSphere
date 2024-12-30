<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;


class NotificationController extends Controller
{
    public function index()
    {
        try {
            $notifications = DB::table('notifications')
                ->join('users', 'notifications.user_id', '=', 'users.id')
                ->select('notifications.*', 'users.username', 'users.fullname')
                ->paginate(30);

            if ($notifications->isNotEmpty()) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "Notifications" => NotificationResource::collection($notifications)
                    ],
                    'message' => "Notifications retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Notifications Available",
                    'errors' => ['notification' => 'No Notifications available']
                ], 200);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving Notifications,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    public function show($id)
    {

        try {
            $notification = Notification::find($id);

            if ($notification) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "notification" => new NotificationResource($notification)
                    ],
                    'message' => "Notification retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Notification not found',
                    'errors' => ['notification' => 'Notification not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving Notification,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
                'message' => 'required|string'
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Bad parameters',
                    'errors' => $validator->messages(),
                ], 400);
            }

            $notification = Notification::create([
                'user_id' => $request->user_id,
                'message' => $request->message
            ]);

            return response()->json([

                'success' => true,
                'data' => [
                    "notification" => $notification
                ],
                'message' => "Notification created successfully",
                'errors' => null

            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while creating Notification ,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $notification = Notification::find($id);

            if ($notification) {
                $validator = Validator::make($request->all(), [
                     'message' => 'required|string'
                ]);

                if ($validator->fails()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Missing required parameters',
                        'errors' => $validator->messages(),
                    ], 400);
                }

                $notification->update([ 'message' => $request->message]);
                return response()->json([

                    'success' => true,
                    'data' => [
                        "notification" => $notification
                    ],
                    "message" => "updated successfully",
                    'errors' => null

                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Notification not found',
                    'errors' => ['Notification' => 'Notification not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while updating Notification,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    public function search_Notifications($query)
    {

        try {
            $searchTerm =  strtolower($query);
            $notifications = DB::table('Notifications')
                ->join('users', 'Notifications.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.username', 'like', "%$searchTerm%")
                        ->orWhere('users.fullname', 'like', "%$searchTerm%");
                })
                ->select('Notifications.*', 'users.username', 'users.fullname')
                ->paginate(30);


            if ($notifications->isNotEmpty()) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "Notifications" => $notifications
                    ],
                    'message' => "Notifications retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Notifications Available",
                    'errors' => ['Notifications' => 'No users available']
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
            $Notification = Notification::find($id);

            if ($Notification) {
                $Notification->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Notification deleted successfully',
                    'errors' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification not found',
                    'errors' => ['Notification' => 'Notification not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while deleting Notification,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }
}
