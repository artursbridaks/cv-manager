<?php

namespace App\Http\Controllers\Api;

use App\Models\UserData;
use App\Models\Employment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmploymentController extends Controller
{
    public function getEmploymentData()
    {
        $employmentData = Employment::all();
        if ($employmentData->count() > 0) {
            return response()->json([
                'status' => 200,
                'employmentData' => $employmentData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Data Found!'
            ], 404);
        }
    }

    public function createEmploymentData(Request $request, int $id)
    {    
        $employmentRecords = $request->input('employment');
        $createdRecords = 0;
    
        foreach ($employmentRecords as $employment) {
            $validator = Validator::make($employment, [
                'company' => 'required|string|max:191',
                'role' => 'required|string|max:191',
                'type' => 'required|string|max:191',
                'experience' => 'required|integer',
                'achievements' => 'nullable|string|max:191',
                'additional_skills' => 'nullable|string|max:191',
                // 'from' => 'nullable|date',
                // 'to' => 'nullable|date|after_or_equal:from',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }
    
            Employment::create([
                'users_data_id' => $id,
                'company' => $employment['company'],
                'role' => $employment['role'],
                'type' => $employment['type'],
                'experience' => $employment['experience'],
                'achievements' => $employment['achievements'],
                'additional_skills' => $employment['additional_skills'],
                // 'from' => $employment['from'],
                // 'to' => $employment['to']
            ]);
            $createdRecords++;
        }
    
        return response()->json([
            'status' => 200,
            'message' => "$createdRecords employment records created successfully!"
        ], 200);
    }

    public function getSingleEmploymentData($id)
    {
        $employmentData = Employment::find($id);

        if ($employmentData) {
            $user_data_id = $employmentData->users_data_id;

            return response()->json([
                'status' => 200,
                'employmentData' => $employmentData,
                'userDataId' => $user_data_id
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }

    public function getAllEmploymentDataByUser($user_data_id)
    {
        $employmentData = Employment::where('users_data_id', $user_data_id)->get();

        if ($employmentData->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'employmentData' => $employmentData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No employment data found for the specified user.'
            ], 404);
        }
    }

    public function updateEmploymentData(Request $request)
    {
        $employmentDataArray = $request->input('employmentData', []);

        $updatedRecords = 0;
        $createdRecords = 0;
        $errors = [];

        foreach ($employmentDataArray as $index => $employmentData) {
            $validator = Validator::make($employmentData, [
                'id' => 'sometimes|required|integer|exists:employment,id',
                'users_data_id' => 'required|integer|exists:users_data,id',
                'company' => 'required|string|max:191',
                'role' => 'required|string|max:191',
                'type' => 'required|string|max:191',
                'experience' => 'required|integer',
                'achievements' => 'nullable|string|max:191',
                'additional_skills' => 'nullable|string|max:191',
                'from' => 'nullable|date',
                'to' => 'nullable|date|after_or_equal:from',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'error' => $validator->messages()
                ], 422);
            }

            if (isset($employmentData['id'])) {
                $employmentRecord = Employment::find($employmentData['id']);
                if ($employmentRecord) {
                    $employmentRecord->update($employmentData);
                    $updatedRecords++;
                } else {
                    $errors[] = "Employment record not found for id: " . $employmentData['id'];
                }
            } else {
                Employment::create($employmentData);
                $createdRecords++;
            }
        }

        if (count($errors) > 0) {
            return response()->json([
                'status' => 422,
                'errors' => $errors
            ], 422);
        }

        return response()->json([
            'status' => 200,
            'message' => "$updatedRecords employment data updated, $createdRecords new records added successfully!"
        ], 200);
    }



    public function deleteSingleEmploymentData($id)
    {

        $employmentData = Employment::find($id);
        if ($employmentData) {
            $employmentData->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Employment data deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }
}
