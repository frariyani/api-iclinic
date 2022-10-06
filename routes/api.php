<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('logout', 'Api\AuthController@logout');

    // CRUD ROLE
    Route::post('role/create', 'Api\RoleController@store');
    Route::get('role/show', 'Api\RoleController@show');
    Route::post('role/update', 'Api\RoleController@update');
    Route::delete('role/delete/{id}', 'Api\RoleController@delete');
    
    // CRUD USER
    Route::post('user/create', 'Api\UserController@store');
    Route::get('user/show', 'Api\UserController@show');
    Route::get('user/profile/{id}', 'Api\UserController@showUserByID');
    Route::post('user/update', 'Api\UserController@update');
    Route::delete('user/delete/{id}', 'Api\UserController@delete');
    Route::get('user/auth', 'Api\UserController@showAuthUser');
    Route::post('user/changepassword', 'Api\UserController@changePassword');

    // CRUD PATIENT
    Route::post('patient/create', 'Api\PatientController@store');
    Route::get('patient/show', 'Api\PatientController@show');
    Route::get('patient/get/{id}', 'Api\PatientController@showPatientByID');
    Route::post('patient/update', 'Api\PatientController@update');
    Route::delete('patient/delete/{id}', 'Api\PatientController@delete');
    // ROute::get('patient/medrecord/{id}', 'Api\PatientController@showMedicalRecord');

    // CRUD ILLNESS
    Route::post('illness/create', 'Api\IllnessController@store');
    Route::get('illness/show', 'Api\IllnessController@show');
    Route::get('illness/get/{id}', 'Api\IllnessController@showIllnessByID');
    Route::post('illness/update', 'Api\IllnessController@update');
    Route::delete('illness/delete/{id}', 'Api\IllnessController@delete');

    //CRUD TREATMENT
    Route::post('treatment/create', 'Api\TreatmentController@store');
    Route::get('treatment/show', 'Api\TreatmentController@show');
    Route::post('treatment/update', 'Api\TreatmentController@update');
    Route::delete('treatment/delete/{id}', 'Api\TreatmentController@delete');

    //CRUD MEDICINE
    Route::post('medicine/create', 'Api\MedicineController@store');
    Route::get('medicine/show', 'Api\MedicineController@show');
    Route::post('medicine/update', 'Api\MedicineController@update');
    Route::delete('medicine/delete/{id}', 'Api\MedicineController@delete');
    Route::post('medicine/supply/add', 'Api\MedicineController@addStock');
    Route::get('medicine/get/{id}', 'Api\MedicineController@getMedicineByID');

    //CRUD QUEUE
    Route::post('queue/create', 'Api\QueueController@store');
    Route::get('queue/show', 'Api\QueueController@show');
    Route::get('queue/update-progress/{id}', 'Api\QueueController@updateToOnProgress');
    Route::get('queue/update-waiting/{id}', 'Api\QueueController@updateToWaiting');
    Route::get('queue/update-medicine/{id}', 'Api\QueueController@updateToWaitMedicine');
    Route::get('queue/delete/{id}', 'Api\QueueController@delete');
    Route::get('queue/print/{id}', 'Api\QueueController@print');

    //CRUD MEDICAL RECORD
    Route::post('medicalrecord/create', 'Api\MedicalRecordController@store');
    Route::get('medicalrecord/show', 'Api\MedicalRecordController@show');
    Route::get('medicalrecord/patient/{id}', 'Api\MedicalRecordController@getMedicalRecordByPatientID');
    Route::post('medicalrecord/update', 'Api\MedicalRecordController@update');
    Route::delete('medicalrecord/delete/{id}', 'Api\MedicalRecordController@delete');
    Route::get('medicalrecord/isdone/{id}', 'Api\MedicalRecordController@setIsDone');

    Route::get('medicalrecord/illness/{id}', 'Api\MedicalRecordController@showWithIllness');


    //DASHBOARD DATA
    Route::get('get/totalpatients', 'Api\ReportController@getTotalPatient');
    Route::get('get/visitbymonth', 'Api\ReportController@countMedicalRecordByMonth');
    Route::get('get/averageincome', 'Api\ReportController@getAvgIncome');
    Route::get('get/visitdaily', 'Api\ReportController@countVisitDaily');
    Route::get('get/topmedicine', 'Api\ReportController@get5TopMedicine');

    //REPORT
    Route::get('report/dailyvisitor/{month}', 'Api\PDFController@getDailyVisitor');
    Route::get('report/dailyincome/{month}', 'Api\PDFController@getTotalDailyIncome');
    Route::get('report/medicineusage/{month}/{medicineID}', 'Api\PDFController@medicineUsageAndStock');
    Route::get('report/monthly', 'Api\PDFController@monthlyReport');

    //GENERATE PDF
    Route::get('pdf/dailyvisitor/{date}', 'Api\PDFController@generatePDFDailyVisitor');
    Route::get('pdf/dailyincome/{date}', 'Api\PDFController@generatePDFDailyIncome');
    Route::get('pdf/medicineusage/{date}/{medicineID}', 'Api\PDFController@generatePDFMedicineUsage');
    Route::get('pdf/monthlyreport', 'Api\PDFController@generatePDFMonthlyReport');

    Route::get('get/menu', 'Api\MenuController@getMenu');

    //INCOMING STOCK
    Route::post('stock/add', 'Api\StockController@store');
    Route::get('stock/get/{id}', 'Api\StockController@show');
    Route::post('stock/update', 'Api\StockController@update');
    Route::get('stock/delete/{id}', 'Api\StockController@delete');

    //FILE 
    Route::post('file/create', 'Api\FileController@store');
    Route::get('file/show/{id}', 'Api\FileController@getFiles');
    Route::get('file/delete/{id}', 'Api\FileController@deleteFile');
    Route::get('file/donwload/{id}', 'Api\FileController@getDownload');

    //PRESCRIPTION QUEUE
    Route::get('prescription/queue', 'Api\PrescriptionQueueController@getPrescriptionQueue');
    Route::get('prescription/serve/{id}', 'Api\PrescriptionQueueController@servePrescription');

    //PAYMENT
    Route::get('payment/get', 'Api\PaymentController@show');
    Route::get('payment/detail/{id}', 'Api\PaymentController@showDetail');
    Route::post('payment/update', 'Api\PaymentController@update');
    Route::get('payment/print/{id}', 'Api\PaymentController@printBill');
});

Route::get('dashboard', 'Api\ReportController@dashboard');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
