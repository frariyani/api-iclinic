<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    //
    public function getTotalPatient(){
        $patients = DB::table('patients')->count();
        
        return response([
            'data' => $patients
        ]);
    }

    public function countMedicalRecordByMonth(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $medicalRecord = DB::table('patient_medical_records')
                         ->whereMonth('date', $month)
                         ->whereYear('date', $year)
                         ->count();

        return response([
            'data' => $medicalRecord
        ]);
    }

    public function getAvgIncome(){
        $avgIncome = DB::table('patient_medical_records')
                     ->avg('paymentTotal');

        
        return response([
            'data' => number_format($avgIncome, 2, ',', '.')
        ]);
    }

    public function countVisitDaily(){
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        
        $medicalRecord = DB::table('patient_medical_records')
                         ->select(DB::raw('count(*) as daily_visitor, date'))
                         ->whereMonth('date', $month)
                         ->whereYear('date', $year)
                         ->groupBy('date')
                         ->get();
        
        return response([
            'data' => $medicalRecord
        ]);
    }

    public function get5TopMedicine(){
        $medicines = DB::table('medicines')
                     ->join('prescriptions', 'medicines.medicineID', '=', 'prescriptions.medicineID')
                     ->select('medicines.medicineName', DB::raw('SUM(prescriptions.quantity) as qty'))
                     ->orderBy('qty', 'desc')
                     ->groupBy('medicines.medicineName')
                     ->limit(5)
                     ->get();

        return response([
            'data' => $medicines
        ]);
    }

    
}
