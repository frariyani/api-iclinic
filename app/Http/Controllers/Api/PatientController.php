<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

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
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        // $patient = Patient::create($patientData);
        $patient = Patient::firstOrCreate(
            ['fullname' => $req->fullname, 'address' => $req->address],
            ['birthdate' => $req->birthdate, 'weight' => $req->weight, 'gender' => $req->gender]
        );

        return response([
            'message' => 'Data pasien berhasil dibuat',
            'data' => $patient
        ], 200);

    }

    public function show(){
        $patient = Patient::select('*', DB::raw('DATE_FORMAT(FROM_DAYS(DATEDIFF(now(), birthdate)), "%Y")+0 as age'))
                    ->get();

        if(!is_null($patient)){
            return response([
                'message' => 'Patient retrieved successfuly',
                'data' => $patient
            ]);
        }
    }

    public function showMedicalRecord($id){
        $medicalRecord = Patient::query()
                         ->with(['medicalRecords' => function($query){
                            $query->select('*');
                         }])
                         ->find($id);

        if(!is_null($medicalRecord)){
            return response([
                'message' => 'Medical record retrieved',
                'data' => $medicalRecord
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
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $patient->fullname = $updateData['fullname'];
        $patient->address = $updateData['address'];
        $patient->weight = $updateData['weight'];
        $patient->birthdate = $updateData['birthdate'];
        $patient->gender = $updateData['gender'];

        if($patient->save()){
            return response([
                'message' => 'Data pasien berhasil diubah',
                'data' => $patient
            ], 200);
        }

        return response([
            'message' => 'Data pasien gagal diubah'
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
                'message' => 'Data pasien berhasil dihapus',
                'data' => $patient
            ], 200);
        }

        return response([
            'message' => 'Delete patient failed'
        ], 400);
    }
}
