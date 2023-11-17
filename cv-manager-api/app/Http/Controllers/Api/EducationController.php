<?php

namespace App\Http\Controllers\Api;

use App\Models\UserData;
use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    public function getEducationData()
    {
        $educationData = Education::all();
        if ($educationData->count() > 0) {
            return response()->json([
                'status' => 200,
                'educationData' => $educationData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Data Found!'
            ], 404);
        }
    }

    public function createEducationData(Request $request, int $id)
    {
        $educationRecords = $request->input('education');
        $createdRecords = 0;

        foreach ($educationRecords as $education) {
            $validator = Validator::make($education, [
                'school_name' => 'required|string|max:191',
                'faculty' => 'required|string|max:191',
                'course' => 'required|string|max:191',
                'degree' => 'required|string|max:191',
                'status' => 'required|string|max:191',
                // 'from' => 'required|date',
                // 'to' => 'required|date|after_or_equal:from',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }

            Education::create([
                'users_data_id' => $id,
                'school_name' => $education['school_name'],
                'faculty' => $education['faculty'],
                'course' => $education['course'],
                'degree' => $education['degree'],
                'status' => $education['status'],
                // 'from' => $education['from'],
                // 'to' => $education['to']
            ]);
            $createdRecords++;
        }

        return response()->json([
            'status' => 200,
            'message' => "$createdRecords education records created successfully!"
        ], 200);
    }

    public function getSingleEducationData($id)
    {
        $educationData = Education::find($id);

        if ($educationData) {
            $user_data_id = $educationData->users_data_id;

            return response()->json([
                'status' => 200,
                'educationData' => $educationData,
                'userDataId' => $user_data_id
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }

    public function getAllEducationDataByUser($user_data_id)
    {
        $educationData = Education::where('users_data_id', $user_data_id)->get();

        if ($educationData->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'educationData' => $educationData
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No education data found for the specified user.'
            ], 404);
        }
    }

    public function updateEducationData(Request $request)
    {
        $educationDataArray = $request->input('educationData', []);

        $updatedRecords = 0;
        $createdRecords = 0;
        $errors = [];

        foreach ($educationDataArray as $index => $educationData) {
            $validator = Validator::make($educationData, [
                'id' => 'sometimes|required|integer|exists:education,id',
                'users_data_id' => 'required|integer|exists:users_data,id',
                'school_name' => 'required|string|max:191',
                'faculty' => 'required|string|max:191',
                'course' => 'required|string|max:191',
                'degree' => 'required|string|max:191',
                'status' => 'required|string|max:191',
                // 'from' => 'required|date',
                // 'to' => 'required|date|after_or_equal:from',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'error' => $validator->messages()
                ], 422);
            }

            if (isset($educationData['id'])) {
                $educationRecord = Education::find($educationData['id']);
                if ($educationRecord) {
                    $educationRecord->update($educationData);
                    $updatedRecords++;
                } else {
                    $errors[] = "Education record not found for id: " . $educationData['id'];
                }
            } else {
                Education::create($educationData);
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
            'message' => "$updatedRecords education data updated, $createdRecords new records added successfully!"
        ], 200);
    }

    public function deleteSingleEducationData($id)
    {

        $educationData = Education::find($id);
        if ($educationData) {
            $educationData->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Education data deleted successfully!'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No user data found!'
            ], 500);
        }
    }
}
