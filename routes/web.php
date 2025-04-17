<?php


use App\Http\Controllers\admincontroller;
use App\Http\Controllers\adminnavcontroller;
use App\Http\Controllers\hospitalcontroller;
use App\Http\Controllers\patient\patientaidcontroller;
use App\Http\Controllers\patient\patientrequestcontroller;
use App\Http\Controllers\SecureFileController;
use App\Http\Controllers\adminhousingcontroller;
use App\Http\Controllers\adminpatientcontroller;
use App\Http\Controllers\adminrequestcontroller;
use App\Http\Controllers\navigator\navcontroller;
use App\Http\Controllers\adminbroadcastcontroller;
use App\Http\Controllers\admintransportcontroller;
use App\Http\Controllers\patient\patientcontroller;
use App\Http\Controllers\adminfinancialaidcontroller;
use App\Http\Controllers\admin_individualnavcontroller;
use App\Http\Controllers\diagnosis_availablecontroller;
use App\Http\Controllers\navigator\navhousingcontroller;
use App\Http\Controllers\navigator\navpatientcontroller;
use App\Http\Controllers\navigator\navrequestcontroller;
use App\Http\Controllers\navigator\navbroadcastcontroller;
use App\Http\Controllers\navigator\navtransportcontroller;
use App\Http\Controllers\patient\patienthousingcontroller;
use App\Http\Controllers\admin_individualhousingcontroller;
use App\Http\Controllers\admin_individualpatientcontroller;
use App\Http\Controllers\navigator\individualnavcontroller;
use App\Http\Controllers\admin_individualhospitalcontroller;
use App\Http\Controllers\patient\patienttransportcontroller;
use App\Http\Controllers\admin_individualnavigatorcontroller;
use App\Http\Controllers\admin_individualtransportcontroller;
use App\Http\Controllers\navigator\navfinancialaidcontroller;
use App\Http\Controllers\patient\individualpatientcontroller;
use App\Http\Controllers\admin_individualcancertypecontroller;
use App\Http\Controllers\patient\patientfinancialaidcontroller;
use App\Http\Controllers\admin_individualfinancialaidcontroller;
use App\Http\Controllers\navigator\nav_individualpatientcontroller;



// use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/home', function () {
    return view('home');
})->name('login');



Route::get('/private-image/{filename}', [SecureFileController::class, 'showPrivateFile'])
    ->where('filename', '.*') // Allows slashes in filenames
    ->name('image.show');




// --------------------ADMIN------------------------
Route::prefix('admin')->group(function () {


    Route::get('/login', [admincontroller::class, 'adminlogin'])->name('adminlogin');
    Route::post('/login', [admincontroller::class, 'adminloginprocess']);

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/dashboard', [admincontroller::class, 'admindashboard'])->name('admindashboard');
        Route::get('/broadcast', [admincontroller::class, 'adminbroadcast'])->name('adminbroadcast');
        Route::get('/profile', [admincontroller::class, 'adminprofile'])->name('adminprofile');
        Route::get('/logout', [admincontroller::class, 'adminlogout'])->name('adminlogout');

        Route::post('/dashboard/navbroadcast', [adminbroadcastcontroller::class, 'navbroadcast'])->name('adminnavbroadcast');
        Route::post('/dashboard/patientbroadcast', [adminbroadcastcontroller::class, 'patientbroadcast'])->name('adminpatientbroadcast');

        Route::get('/testingpage', [adminbroadcastcontroller::class, 'testing'])->name('testing');

        // fetch the navigators according to the hospital id in the add patient form in admin role
        Route::get('/hospital/{id}/navigators', [adminpatientcontroller::class, 'getNavigators']);
        // Route::get('/get-cancer-types/{hospitalId}', [adminpatientcontroller::class, 'getCancerTypes'])->name('hospital.cancertypes');
        Route::get('/admin/hospital/{id}/cancer-types', [adminpatientcontroller::class, 'getCancerTypes']);


        // delete broadcast from admin dashboard doesn't matter customer or driver
        Route::get('/dashboard/{deletebroadcastid}', [adminbroadcastcontroller::class, 'deletebroadcast'])->name('deletebroadcast');


        Route::get('/navigator-accounts', [adminnavcontroller::class, 'show_navigators'])->name('navigatoraccounts');


        // this will show the form to add new navigator
        Route::get('/add-navigator', [adminnavcontroller::class, 'show_addnavigator'])->name('show_addnavigator');
        Route::post('/add-navigator', [adminnavcontroller::class, 'addnavigator']);


        Route::get('/patient-accounts', [adminpatientcontroller::class, 'patientaccounts'])->name('patientaccounts');

        // this will show add patient form
        Route::get('/add-patient', [adminpatientcontroller::class, 'show_addpatient'])->name('show_addpatient');
        Route::post('/add-patient', [adminpatientcontroller::class, 'addpatientprocess']);
        Route::get('/patient-account/show/{patientid}', [admin_individualpatientcontroller::class, 'showEachPatientDetails'])->name('individualpatientdetails');

        // update each patient details
        // Route::get('/patients/{id}/edit', [admin_individualpatientcontroller::class, 'edit'])->name('patients.edit');
        Route::put('/patients/{id}', [admin_individualpatientcontroller::class, 'updatepatient'])->name('patients.update');

        // this will show the add hospital form
        Route::get('/add-hospital', [hospitalcontroller::class, 'show_addhospital'])->name('addhospital');
        Route::post('/add-hospital', [hospitalcontroller::class, 'addhospital']);

        // show all existing hospital details in a table
        Route::get('/show-hospitals', [hospitalcontroller::class, 'show_hospital'])->name('showhospitals');

        // this will show the add diagnosis form
        Route::get('/add-diagnosis', [diagnosis_availablecontroller::class, 'show_adddiagnosis'])->name('adddiagnosis');
        Route::post('/add-diagnosis', [diagnosis_availablecontroller::class, 'adddiagnosis']);

        // show the existing diagnosis in a table
        Route::get('/show-diagnosis', [diagnosis_availablecontroller::class, 'availablediagnosis'])->name('showdiagnosis');


        // this will show the add transport form
        Route::get('/add-transport', [admintransportcontroller::class, 'show_addtransport'])->name('addtransport');
        Route::post('/add-transport', [admintransportcontroller::class, 'addtransport']);

        // show the existing/available transports in a table
        Route::get('/show-transport', [admintransportcontroller::class, 'availabletransport'])->name('showtransport');

        // this will show the add housing form
        Route::get('/add-housing', [adminhousingcontroller::class, 'show_addhousing'])->name('addhousing');
        Route::post('/add-housing', [adminhousingcontroller::class, 'addhousing']);

        // show the existing/available housings in a table
        Route::get('/show-housing', [adminhousingcontroller::class, 'availablehousing'])->name('showhousing');


        // this will show the add finaicial aid providers form
        Route::get('/add-financialaid', [adminfinancialaidcontroller::class, 'show_addfinancialaid'])->name('addfinancialaid');
        Route::post('/add-financialaid', [adminfinancialaidcontroller::class, 'addfinancialaid']);

        // show the existing/available finaincial aids in a table
        Route::get('/show-financialaid', [adminfinancialaidcontroller::class, 'availablefinancialaid'])->name('showfinancialaid');



        // show individual transport details, their available services
        Route::get('/available-transports/show/{transportid}', [admin_individualtransportcontroller::class, 'showEachTransportDetails'])->name('individualtransportdetails');
        // Route::get('/transport/{id}/edit', [admin_individualtransportcontroller::class, 'edit'])->name('transport.edit');
        Route::put('/transport/{id}', [admin_individualtransportcontroller::class, 'update'])->name('transport.update');



        // show individual housing details for each housing providers after clicking one housing provider from the list of all housing providers
        Route::get('/available-housings/show/{housingid}', [admin_individualhousingcontroller::class, 'showEachHousingDetails'])->name('individualhousingdetails');
        Route::put('/updatehousing/{id}', [admin_individualhousingcontroller::class, 'updateHousing'])->name('updatehousing');



        // show individual cancer type details, allow admin to edit the existing details
        Route::get('/available-cancertype/show/{cancertypeid}', [admin_individualcancertypecontroller::class, 'showEachCancerTypeDetails'])->name('individualcancertypedetails');
        Route::get('/cancer-types/{id}/edit', [admin_individualcancertypecontroller::class, 'showEachCancerTypeDetails'])->name('cancer-types.edit');
        Route::put('/cancer-types/{id}', [admin_individualcancertypecontroller::class, 'update'])->name('cancer-types.update');


        // show individual financial aid provider details and response from api
        Route::get('/available-financialaid/show/{financialid}', [admin_individualfinancialaidcontroller::class, 'showEachFinancialAidDetails'])->name('individualfinancialaiddetails');
        Route::put('/financialaid/{id}', [admin_individualfinancialaidcontroller::class, 'update'])->name('updatefinancialaid');



        // now clicking individual custId and then seeing the individual details of them.
        Route::get('/navigator-account/show/{navid}', [admin_individualnavcontroller::class, 'showEachNavigatorDetails'])->name('showEachNavigatorDetails');
        Route::put('/navigator/{id}/update', [admin_individualnavcontroller::class, 'update'])->name('navigator.update');
        Route::get('/navigator/{id}/edit', [admin_individualnavcontroller::class, 'showEachNavigatorDetails'])->name('navigator.edit');


        Route::get('/show/{navid}', [admin_individualhospitalcontroller::class, 'showEachHospitalDetails'])->name('showEachHospitalDetails');
        // Route::put('/hospital/{id}/update', [admin_individualnavcontroller::class, 'update'])->name('hospital.update');
        // Route::get('/hospital/{id}/edit', [admin_individualnavcontroller::class, 'edit'])->name('hospital.edit');
        Route::put('/hospital/{id}/update', [admin_individualhospitalcontroller::class, 'update'])->name('hospital.update');



        Route::get('/nav-requests', [adminrequestcontroller::class, 'navrequests'])->name('shownavrequests');
        Route::delete('/navigator-requests/{id}', [adminrequestcontroller::class, 'deleteNavigatorRequest'])->name('admin.navigator.requests.delete');
        // Show form to edit request
        Route::get('/navigator/requests/show/{id}', [adminrequestcontroller::class, 'editnavreq'])->name('admin.navigator.requests.edit');
        // Handle the update
        Route::put('/navigator/requests/update/{id}', [adminrequestcontroller::class, 'updatenavreq'])->name('admin.navigator.requests.update');


        Route::get('/patient-requests', [adminrequestcontroller::class, 'patientrequests'])->name('showpatientrequests');
        Route::delete('/patient-requests/{id}', [adminrequestcontroller::class, 'deletePatientRequest'])->name('admin.patient.requests.delete');

        // Show form to edit request ie displaying individual request details after clicking on one request among the other requests displayed in table
        Route::get('/patient/requests/show/{id}', [adminrequestcontroller::class, 'editpatientreq'])->name('admin.patient.requests.edit');
        // Handle the update
        Route::put('/patient/requests/update/{id}', [adminrequestcontroller::class, 'updatepatientreq'])->name('admin.patient.requests.update');



    });
});


// --------------------NAVIGATOR------------------------
Route::prefix('navigator')->group(callback: function () {
    Route::get('/login', [navcontroller::class, 'navlogin'])->name('nav.login');
    // process the login details, checking in db and all backend
    Route::post('/login', [navcontroller::class, 'navloginprocess']);

    Route::middleware(['auth:navigator'])->group(function () {
        Route::get('/profile', [navcontroller::class, 'navprofile'])->name('nav.profile');
        Route::post('/profile', [navcontroller::class, 'updateProfile']);

        Route::get('/logout', [navcontroller::class, 'navlogout'])->name('nav.logout');
        Route::get('/dashboard', [navcontroller::class, 'navdashboard'])->name('nav.dashboard');

        // delete broadcast from admin dashboard doesn't matter customer or driver
        Route::get('/dashboard/{deletebroadcastid}', [navbroadcastcontroller::class, 'deletebroadcast'])->name('nav.deletebroadcast');

        // show broadcast form and details of broadcasts from navigator
        Route::get('/broadcast', [navbroadcastcontroller::class, 'navbroadcast'])->name('nav.broadcast');
        Route::post('/broadcast', [navbroadcastcontroller::class, 'patientbroadcastbynav_process']);


        // ----------------------------------------------------------------------------------------
        // NAVIGATOR PATIENT ROUTES
        // ----------------------------------------------------------------------------------------
        Route::get('/patient-accounts', [navpatientcontroller::class, 'patientaccounts'])->name('nav.patientaccounts');

        // this will show add patient form for navigators
        Route::get('/add-patient', [navpatientcontroller::class, 'nav_show_addpatient'])->name('nav.show_addpatient');
        Route::post('/add-patient', [navpatientcontroller::class, 'addpatientprocess']);

        // this will show one patient at a time, their every details
        Route::get('/patient-account/show/{patientid}', [nav_individualpatientcontroller::class, 'showEachPatientDetails'])->name('nav.individualpatientdetails');
        // Route::get('/patients/{id}/edit', [nav_individualpatientcontroller::class, 'edit'])->name('nav.patients.edit');
        Route::put('/patients/{id}', [nav_individualpatientcontroller::class, 'updatepatient'])->name('nav.patients.update');


        Route::get('/show-transport', [navtransportcontroller::class, 'availabletransport'])->name('nav.showtransport');
        Route::get('/available-transports/show/{transportid}', [navtransportcontroller::class, 'showEachTransportDetails'])->name('nav.individualtransportdetails');


        Route::get('/show-financialaid', [navfinancialaidcontroller::class, 'availablefinancialaid'])->name('nav.showfinancialaid');
        Route::get('/available-financialaid/show/{financialid}', [navfinancialaidcontroller::class, 'showEachFinancialAidDetails'])->name('nav.individualfinancialaiddetails');


        // show the existing/available housings in a table
        Route::get('/show-housing', [navhousingcontroller::class, 'availablehousing'])->name('nav.showhousing');
        Route::get('/available-housings/show/{housingid}', [navhousingcontroller::class, 'showEachHousingDetails'])->name('nav.individualhousingdetails');


        // this will be used by navigator to request something to admin
        Route::get('/nav2admin-requests', [navrequestcontroller::class, 'nav2adminreqform'])->name('nav.nav2adminrequest');
        Route::post('/nav2admin-requests', [navrequestcontroller::class, 'submitNavigatorRequest']);


        // using these, navigator will view all the requests from patients
        Route::get('/patient-requests', [navrequestcontroller::class, 'showpatientrequests'])->name('nav.patient_requests');
        Route::delete('/patient-requests/{id}', [navrequestcontroller::class, 'deletePatientRequest'])->name('nav.patient.requests.delete');

        // Show form to edit request ie displaying individual patient request details after clicking on one request among the other requests displayed in table
        Route::get('/patient/requests/show/{id}', [navrequestcontroller::class, 'editpatientreq'])->name('nav.patient.requests.edit');
        // Handle the update
        Route::put('/patient/requests/update/{id}', [navrequestcontroller::class, 'updatepatientreq'])->name('nav.patient.requests.update');

    });
});


// --------------------PATIENT------------------------
Route::prefix('patient')->group(function () {
    Route::get('/login', [patientcontroller::class, 'patientlogin'])->name('patientlogin');
    // process the login details, checking in db and all backend
    Route::post('/login', [patientcontroller::class, 'patientloginprocess']);

    Route::middleware(['auth:patient'])->group(function () {
        Route::get('/profile', [patientcontroller::class, 'patientprofile'])->name('patient.profile');
        Route::get('/logout', [patientcontroller::class, 'patientlogout'])->name('patient.logout');
        Route::get('/dashboard', [patientcontroller::class, 'patientdashboard'])->name('patient.dashboard');


        Route::get('/show-transport', [patienttransportcontroller::class, 'p_availabletransport'])->name('patient.showtransport');
        Route::get('/available-transports/show/{transportid}', [patienttransportcontroller::class, 'showEachTransportDetails'])->name('patient.individualtransportdetails');


        Route::get('/show-financialaid', [patientfinancialaidcontroller::class, 'availablefinancialaid'])->name('patient.showfinancialaid');
        Route::get('/available-financialaid/show/{financialid}', [patientfinancialaidcontroller::class, 'showEachFinancialAidDetails'])->name('patient.individualfinancialaiddetails');


        // show the existing/available housings in a table
        Route::get('/show-housing', [patienthousingcontroller::class, 'availablehousing'])->name('patient.showhousing');
        Route::get('/available-housings/show/{housingid}', [patienthousingcontroller::class, 'showEachHousingDetails'])->name('patient.individualhousingdetails');


        // this will be used by patients to request something to navigator
        Route::get('/patient2nav-requests', [patientrequestcontroller::class, 'patient2navreqform'])->name('patient.patient2navrequest');
        Route::post('/patient2nav-requests', [patientrequestcontroller::class, 'submitPatientRequest']);


        Route::get('/patient/eligible-aids', [patientaidcontroller::class, 'showEligibleAids'])->name('patient.eligibleAids');




    });
});