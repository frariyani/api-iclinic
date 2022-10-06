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
        // return $patients;
    }

    public function countMedicalRecordByMonth(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $medicalRecord = DB::table('queues')
                         ->whereMonth('date', $month)
                         ->whereYear('date', $year)
                         ->count();

        return response([
            'data' => $medicalRecord
        ]);
        // return $medicalRecord;
    }

    public function getAvgIncome(){
        $avgIncome = DB::table('payments')
                     ->avg('paymentTotal');

        
        return response([
            'data' => number_format($avgIncome, 2, ',', '.')
        ]);
        // return number_format($avgIncome, 2, ',', '.');
    }

    public function countVisitDaily(){
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        
        $medicalRecord = DB::table('queues')
                         ->select(DB::raw('count(*) as daily_visitor, date'))
                         ->whereMonth('date', $month)
                         ->whereYear('date', $year)
                         ->groupBy('date')
                         ->get();
        
        return response([
            'data' => $medicalRecord
        ]);
        // return $medicalRecord;
    }

    public function get5TopMedicine(){
        $medicines = DB::table('medicines')
                     ->join('prescriptions', 'medicines.medicineID', '=', 'prescriptions.medicineID')
                     ->select('medicines.medicineName', DB::raw('SUM(prescriptions.quantity) as qty'))
                     ->where('prescriptions.status', '=', 1)
                     ->orderBy('qty', 'desc')
                     ->groupBy('medicines.medicineName')
                     ->limit(5)
                     ->get();

        return response([
            'data' => $medicines
        ]);
        // return $medicines;
    }

    // public function dashboard(){
    //     $totalPatient = $this->getTotalPatient();
    //     $monthlyVisitor = $this->countMedicalRecordByMonth();
    //     $averageIncome = $this->getAvgIncome();
    //     $dailyVisitor = $this->countVisitDaily();
    //     $top5Medicines = $this->get5TopMedicine();

    //     return response([
    //         'totalPatient' => $totalPatient,
    //         'monthlyVisitor' => $monthlyVisitor,
    //         'averageIncome' => $averageIncome,
    //         'dailyVisitor' => $dailyVisitor,
    //         'top5Medicines' => $top5Medicines
    //     ]);
    // }

    
}
