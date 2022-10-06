<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Medicine;
use Hamcrest\Core\HasToString;
use PDF;

class PDFController extends Controller
{

    public function getDailyVisitor($month){
        // Carbon::setLocale('id');
        $dateParse = Carbon::parse($month)->locale('id');

        $numMonth = $dateParse->format('m');
        $year = Carbon::now()->format('Y');

        $dailyVisitor = DB::table('queues')
                        ->select(DB::raw('count(*) as visitors, DATE_FORMAT(date, "%d-%m-%Y") as date'))
                        ->whereMonth('date', $numMonth)
                        ->whereYear('date', $year)
                        ->groupBy('date')
                        ->get();
        return response([
            'data' => $dailyVisitor
        ]);
    }

    public function generatePDFDailyVisitor($date){
        Carbon::setLocale('id');

        $dateParse = Carbon::parse($date);

        $numMonth = $dateParse->format('m');
        $strMonth = $dateParse->translatedFormat('F Y');
        $year = $dateParse->format('Y');

        echo $strMonth;
 
        $dailyVisitor = DB::table('queues')
                        ->select(DB::raw('count(*) as visitors, DATE_FORMAT(date, "%d-%m-%Y") as date'))
                        ->whereMonth('date', $numMonth)
                        ->whereYear('date', $year)
                        ->groupBy('date')
                        ->get();

        $pdf = PDF::loadview('dailyVisitorPDF', ['visitors' => $dailyVisitor, 'month' => $strMonth]);
        // return $pdf->download('KunjunganHarian_'.$strMonth.'.pdf');
        return $pdf->output();
    }

    public function getTotalDailyIncome($month){
        $dateParse = Carbon::parse($month)->locale('id');

        $numMonth = $dateParse->format('m');
        $year = Carbon::now()->format('Y');

        $dailyIncome = DB::table('payments')
                       ->select(DB::raw('CONCAT("Rp", FORMAT(SUM(paymentTotal), 2, "id_ID")) as income, DATE_FORMAT(date, "%d-%m-%Y") as date'))
                       ->whereMonth('date', $numMonth)
                       ->whereYear('date', $year)
                       ->groupBy('date')
                       ->get();

        return response([
            'data' => $dailyIncome
        ]);
    }

    public function generatePDFDailyIncome($date){
        $dateParse = Carbon::parse($date);

        Carbon::setLocale('id');

        $numMonth = $dateParse->format('m');
        $strMonth = $dateParse->translatedFormat('F Y');
        $year = $dateParse->format('Y');

        $dailyIncome = DB::table('payments')
                        ->select(DB::raw('CONCAT("Rp", FORMAT(SUM(paymentTotal), 2, "id_ID")) as income, date'))
                        ->whereMonth('date', $numMonth)
                        ->whereYear('date', $year)
                        ->groupBy('date')
                        ->get();

        $pdf = PDF::loadview('dailyIncomePDF', ['incomes' => $dailyIncome, 'month' => $strMonth]);
        return $pdf->download('PendapatanHarian_'.$strMonth.'.pdf');
    }

    public function medicineUsageAndStock($month, $medicineID){
        $dateParse = Carbon::parse($month)->locale('id');

        $numMonth = $dateParse->format('m');
        $year = Carbon::now()->format('Y');

        $medicineUsage = DB::table('patient_medical_records')
                         ->join('prescriptions', 'patient_medical_records.medicalRecordID', '=', 'prescriptions.medicalRecordID')
                         ->join('medicines', 'medicines.medicineID', '=', 'prescriptions.medicineID')
                         ->select(DB::raw('SUM(prescriptions.quantity) as med_usage, DATE_FORMAT(patient_medical_records.date, "%d-%m-%Y") as date'))
                         ->whereMonth('patient_medical_records.date', $numMonth)
                         ->whereYear('patient_medical_records.date', $year)
                         ->where('medicines.medicineID', '=', $medicineID)
                         ->groupBy('patient_medical_records.date')
                         ->get();
    
        return response([
            'data' => $medicineUsage
        ]);
    }

    public function generatePDFMedicineUsage($date, $medicineID){
        $dateParse = Carbon::parse($date);

        Carbon::setLocale('id');

        $numMonth = $dateParse->format('m');
        $strMonth = $dateParse->translatedFormat('F Y');
        $year = $dateParse->format('Y');

        $medicineName = Medicine::select('medicineName')->where('medicineID', '=', $medicineID)->first()->medicineName;

        $medicineUsage = DB::table('patient_medical_records')
                         ->join('prescriptions', 'patient_medical_records.medicalRecordID', '=', 'prescriptions.medicalRecordID')
                         ->join('medicines', 'medicines.medicineID', '=', 'prescriptions.medicineID')
                         ->select(DB::raw('SUM(prescriptions.quantity) as med_usage, patient_medical_records.date'))
                         ->whereMonth('patient_medical_records.date', $numMonth)
                         ->whereYear('patient_medical_records.date', $year)
                         ->where('medicines.medicineID', '=', $medicineID)
                         ->groupBy('patient_medical_records.date')
                         ->get();

        $pdf = PDF::loadview('dailyMedicineUsage', ['usages' => $medicineUsage, 'month' => $strMonth, 'medicineName' => $medicineName]);
        return $pdf->download('PenggunaanObat_'.$medicineName.'_'.$strMonth.'.pdf');
    }

    public function monthlyReport(){
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $monthlyVisitor = DB::table('patient_medical_records')
                  ->select(DB::raw('count(*) as monthly_visitor'))
                  ->whereMonth('date', $month)
                  ->whereYear('date', $year)
                  ->get();

        $monthlyIncome = DB::table('patient_medical_records')
                         ->select(DB::raw('FORMAT(SUM(paymentTotal), 2, "id_ID") as monthly_income'))
                         ->whereMonth('date', $month)
                         ->whereYear('date', $year)
                         ->get();

        $medicineUsage = DB::table('patient_medical_records')
                         ->join('prescriptions', 'patient_medical_records.medicalRecordID', '=', 'prescriptions.medicalRecordID')
                         ->join('medicines', 'medicines.medicineID', '=', 'prescriptions.medicineID')
                         ->select(DB::raw('SUM(prescriptions.quantity) as med_usage, medicines.supply, medicines.medicineName'))
                         ->whereMonth('patient_medical_records.date', $month)
                         ->whereYear('patient_medical_records.date', $year)
                         ->groupBy('medicines.supply', 'medicines.medicineName')
                         ->get();

        return response([
            'monthlyVisitor' => $monthlyVisitor[0]->monthly_visitor, 
            'monthlyIncome' => $monthlyIncome[0]->monthly_income, 
            'medicineUsage' => $medicineUsage
        ]);
    }

    public function generatePDFMonthlyReport(){
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        Carbon::setLocale('id');

        $dateStr = Carbon::now()->translatedFormat('F Y');

        $monthlyVisitor = DB::table('patient_medical_records')
                  ->select(DB::raw('count(*) as monthly_visitor'))
                  ->whereMonth('date', $month)
                  ->whereYear('date', $year)
                  ->get();

        $monthlyIncome = DB::table('patient_medical_records')
                         ->select(DB::raw('FORMAT(SUM(paymentTotal), 2, "id_ID") as monthly_income'))
                         ->whereMonth('date', $month)
                         ->whereYear('date', $year)
                         ->get();

        $medicineUsage = DB::table('patient_medical_records')
                         ->join('prescriptions', 'patient_medical_records.medicalRecordID', '=', 'prescriptions.medicalRecordID')
                         ->join('medicines', 'medicines.medicineID', '=', 'prescriptions.medicineID')
                         ->select(DB::raw('SUM(prescriptions.quantity) as med_usage, medicines.supply, medicines.medicineName'))
                         ->whereMonth('patient_medical_records.date', $month)
                         ->whereYear('patient_medical_records.date', $year)
                         ->groupBy('medicines.supply', 'medicines.medicineName')
                         ->get();

        $pdf = PDF::loadview('monthlyReport', ['monthlyVisitor' => $monthlyVisitor[0]->monthly_visitor, 
                                               'monthlyIncome' => $monthlyIncome[0]->monthly_income, 
                                               'medicineUsage' => $medicineUsage,
                                               'date' => $dateStr
                            ]);

        return $pdf->download('LaporanBulanan_'.$dateStr.'.pdf');
    }
}
