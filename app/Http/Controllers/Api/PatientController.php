<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Patient;
use Carbon\Carbon;

class PatientController extends Controller
{
    //
    public function store(Request $req){
        $patientData = $req->all();

        $validate = Validator::make($patientData, [
            'fullname' => 'required|max:255',
            'address' => 'required|max:255',
            'weight' => 'required|integer',
            'birthdate' => 'required|date',
            'gender' => 'required|max:50'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $patient = Patient::create($patientData);

        return response([
            'message' => 'Patient created successfuly',
            'data' => $patient
        ], 200);

    }

    public function show(){
        $patient = Patient::all();

        if(!is_null($patient)){
            return response([
                'message' => 'Patient retrieved successfuly',
                'data' => $patient
            ]);
        }
    }

    public function showPatientByID($id){
        $patient = Patient::find($id);

        if(!is_null($patient)){
            return response([
                'message' => 'Retrieve patient successful',
                'data' => $patient
            ], 200);
        }

        return response([
            'message' => 'Patient not found'
        ], 404);
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['patientID'];

        $patient = Patient::find($id);

        if(is_null($patient)){
            return response([
                'message' => 'Patient not found',
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'fullname' => 'required|max:255',
            'address' => 'required|max:255',
            'weight' => 'required|integer',
            'birthdate' => 'required|date',
            'gender' => 'required|max:50'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $patient->fullname = $updateData['fullname'];
        $patient->address = $updateData['address'];
        $patient->weight = $updateData['weight'];
        $patient->birthdate = $updateData['birthdate'];
        $patient->gender = $updateData['gender'];

        if($patient->save()){
            return response([
                'message' => 'Update patient successful',
                'data' => $patient
            ], 200);
        }

        return response([
            'message' => 'Update patient failed'
        ], 400);
    }

    public function delete($id){
        $patient = Patient::find($id);

        if(is_null($patient)){
            return response([
                'message' => 'Patient table is empty'
            ], 404);
        }

        if($patient->delete()){
            return response([
                'message' => 'Patient deleted successfuly',
                'data' => $patient
            ], 200);
        }

        return response([
            'message' => 'Delete patient failed'
        ], 400);
    }
}