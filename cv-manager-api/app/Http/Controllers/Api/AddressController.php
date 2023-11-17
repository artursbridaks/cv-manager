<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\UserData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function getAllAddressData()
    {

        $addressData = Address::all();
        if ($addressData->count() > 0) {
            return response()->json([
                'status' => 200,
                'addressData' => $addressData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Data Found!'
            ], 404);
        }
    }

    public function createAddressData(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'street' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'index' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $addressData = Address::create([
                'users_data_id' => $id,
                'country' => $request->country,
                'city' => $request->city,
                'street' => $request->street,
                'number' => $request->number,
                'index' => $request->index,
            ]);
        }

        if ($addressData) {
            return response()->json([
                'status' => 200,
                'addressData' => 'Address data created successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    public function getSingleAddressData($id)
    {
        $addressData = Address::find($id);

        if ($addressData) {
            return response()->json([
                'status' => 200,
                'addressData' => $addressData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }

    public function getAddressData($user_data_id)
    {
        $addressData = Address::where('users_data_id', $user_data_id)->get();

        if ($addressData) {
            return response()->json([
                'status' => 200,
                'addressData' => $addressData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No address data found for the specidic user!'
            ], 500);
        }
    }

    // public function updateSingleAddressData(Request $request, int $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'users_data_id' => 'required|integer|exists:users_data,id',
    //         'country' => 'required|string|max:191',
    //         'city' => 'required|string|max:191',
    //         'street' => 'required|string|max:191',
    //         'number' => 'required|string|max:191',
    //         'index' => 'required|string|max:191',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 422,
    //             'error' => $validator->messages()
    //         ], 422);
    //     } else {
    //         $addressData = Address::find($id);

    //         if ($addressData) {
    //             $addressData->update([
    //                 'country' => $request->country,
    //                 'city' => $request->city,
    //                 'street' => $request->street,
    //                 'number' => $request->number,
    //                 'index' => $request->index,
    //             ]);

    //             return response()->json([
    //                 'status' => 200,
    //                 'userData' => 'User data updated successfully!'
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'Something went wrong!'
    //             ], 404);
    //         }
    //     }
    // }

    public function updateSingleAddressData(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'sometimes|required|integer|exists:address,id',
            'users_data_id' => 'required|integer|exists:users_data,id',
            'country' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'street' => 'required|string|max:191',
            'number' => 'required|string|max:191',
            'index' => 'required|string|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }

        $addressData = Address::where('users_data_id', $id)->first();
        if (!$addressData) {
            return response()->json([
                'status' => 404,
                'message' => 'Address not found'
            ], 404);
        }

        $addressData->update($request->all());
        return response()->json([
            'status' => 200,
            'addressData' => 'Address data updated successfully!'
        ], 200);
    }


    public function deleteSingleAddressData($id)
    {

        $addressData = Address::find($id);
        if ($addressData) {
            $addressData->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Data deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }
}
