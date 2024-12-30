<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PresenceResource;
use App\Models\Presence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;

class PresenceController extends Controller
{

    public function index()
    {
        try {
            $presences = DB::table('presences')
                ->join('users', 'presences.user_id', '=', 'users.id')
                ->select('presences.*', 'users.username', 'users.fullname')
                ->paginate(30);

            if ($presences->isNotEmpty()) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "presences" => PresenceResource::collection($presences)
                    ],
                    'message' => "Presences retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Presences Available",
                    'errors' => ['Presence' => 'No Presences available']
                ], 200);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving Presences,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    public function show($id)
    {

        try {
            $presence = Presence::find($id);

            if ($presence) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "presence" => new PresenceResource($presence)
                    ],
                    'message' => "Presence retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Presence not found',
                    'errors' => ['Presence' => 'Presence not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while retrieving Presence,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function store(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer|exists:users,id',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Missing required parameters',
                    'errors' => $validator->messages(),
                ], 400);
            }

            $presence = Presence::create([
                'user_id' => $request->user_id,
            ]);

            return response()->json([

                'success' => true,
                'data' => [
                    "presence" => $presence
                ],
                'message' => "Presence created successfully",
                'errors' => null

            ], 201);
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while creating Presence ,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $presence = Presence::find($id);

            if ($presence) {
                $validator = Validator::make($request->all(), [
                    'status' => 'required|boolean',
                ]);

                if ($validator->fails()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Missing required parameters',
                        'errors' => $validator->messages(),
                    ], 400);
                }

                $presence->update(['status' => $request->status]);
                return response()->json([

                    'success' => true,
                    'data' => [
                        "presence" => $presence
                    ],
                    "message" => "updated successfully",
                    'errors' => null

                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Presence not found',
                    'errors' => ['presence' => 'Presence not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while updating Presence,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }

    public function search_presences($query)
    {

        try {
            $searchTerm =  strtolower($query);
            $presences = DB::table('presences')
                ->join('users', 'presences.user_id', '=', 'users.id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.username', 'like', "%$searchTerm%")
                        ->orWhere('users.fullname', 'like', "%$searchTerm%");
                })
                ->select('presences.*', 'users.username', 'users.fullname')
                ->paginate(30);


            if ($presences->isNotEmpty()) {

                return response()->json([
                    'success' => true,
                    'data' => [
                        "presences" => $presences
                    ],
                    'message' => "Presences retrieved successfully",
                    'errors' => null
                ], 200);
            } else {

                return response()->json([
                    'success' => false,
                    'data' =>  null,
                    'message' => "No Presences Available",
                    'errors' => ['presences' => 'No users available']
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
            $presence = Presence::find($id);

            if ($presence) {
                $presence->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Presence deleted successfully',
                    'errors' => null
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Presence not found',
                    'errors' => ['presence' => 'Presence not found']
                ], 404);
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => null,
                'message' => "An error occurred while deleting Presence,database error",
                'errors' => ['exception' => $e->getMessage()]
            ], 500);
        }
    }
}
