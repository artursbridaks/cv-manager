<?php

namespace App\Http\Controllers\Api;

use App\Models\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserDataController extends Controller
{
    public function getUsersData() {

        $usersData = UserData::all();
        if($usersData->count() > 0) {
            return response()->json([
                'status' => 200,
                'userData' => $usersData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Data Found!'
            ], 404);
        }
    }

    public function createUsersData (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone_number' => 'required|digits:8',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $usersData = UserData::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);
        }

        if ($usersData) {
            return response()->json([
                'status' => 200,
                'userData' => 'User data created successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    public function getSingleUserData ($id) {
        $userData = UserData::find($id);

        if ($userData) {
            return response()->json([
                'status' => 200,
                'userData' => $userData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }

    public function editSingleUserData ($id) {
        $userData = UserData::find($id);

        if ($userData) {
            return response()->json([
                'status' => 200,
                'userData' => $userData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }

    public function updateSingleUserData (Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone_number' => 'required|digits:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $usersData = UserData::find($id);

            if ($usersData) {
                $usersData->update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                ]);
    
                return response()->json([
                    'status' => 200,
                    'userData' => 'User data updated successfully!'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Something went wrong!'
                ], 404);
            }
        }
    }


    public function deleteSingleUserData ($id) {

        $userData = UserData::find($id);
        if ($userData) {
            $userData->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Data deleted successfully!'
            ], 500);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }
}
