<?php
USE \App\Http\Controllers\api\v1\LoginController;
use App\Http\Controllers\api\v1\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\zoneController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
//

//AUTHENTIFICATION

    Route::post('/login' , [LoginController::class , 'login']);
Route::post('/forgot' , [LoginController::class , 'recoverPassword']);
    Route::post('/register' , [\App\Http\Controllers\api\v1\RegisterController::class , 'register']);

Route::post('/colb' ,  [\App\Http\Controllers\api\v1\CollaborateurController::class , 'addCollaborateur']);
Route::post('/colbs' ,  [\App\Http\Controllers\api\v1\CollaborateurController::class , 'collaborators']);
// Users

Route::middleware('auth:api')->group( function (){

    Route::prefix('users')->group(function(){
        Route::get('all' , [\App\Http\Controllers\api\v1\UserController::class , 'index']);

    });

    // DOCUMENT ROUTES
    Route::post('zones' ,  [zoneController::class , 'getZoneByProjectId']);
    Route::post('document' , [\App\Http\Controllers\api\v1\DocumentController::class , 'store']);
    Route::get('documentByUser' , [\App\Http\Controllers\api\v1\DocumentController::class , 'getDocumentsByUser']);
    Route::post('documentByProject' , [\App\Http\Controllers\api\v1\DocumentController::class , 'getDocumentByProject']);
    Route::post('documentDelete' , [\App\Http\Controllers\api\v1\DocumentController::class , 'deleteDocument']);
    Route::post('documentsDelete' , [\App\Http\Controllers\api\v1\DocumentController::class , 'deleteDocuments']);

    // PROJECT ROUTE

    Route::post('project' , [\App\Http\Controllers\api\v1\ProjectController::class , 'addProject']);
    Route::post('projectUpdate' , [\App\Http\Controllers\api\v1\ProjectController::class , 'updateProject']);
    Route::post('projectDelete' , [\App\Http\Controllers\api\v1\ProjectController::class , 'deleteProject']);
    Route::get('project' , [\App\Http\Controllers\api\v1\ProjectController::class , 'getProjectById']);
    Route::get('projectUser/{id}' , [\App\Http\Controllers\api\v1\ProjectController::class , 'getProjectByUser']);

    // MEETING ROUTE
    Route::post('meeting' , [\App\Http\Controllers\api\v1\MeetingController::class , 'store']);
    Route::post('getMeeting' , [\App\Http\Controllers\api\v1\MeetingController::class , 'getMeetingsByProject']);
    Route::post('updateMeeting' , [\App\Http\Controllers\api\v1\MeetingController::class , 'updateMeeting']);
    Route::post('deleteMeeting' , [\App\Http\Controllers\api\v1\MeetingController::class , 'deleteMeeting']);
    Route::post('generateQrCode' , [\App\Http\Controllers\api\v1\MeetingController::class , 'generateQrCode']);

    // ZONE ROUTES

    Route::post('zone' ,  [\App\Http\Controllers\api\v1\zoneController::class , 'addZone']);
    Route::post('updateZone' ,  [\App\Http\Controllers\api\v1\zoneController::class , 'update']);


    // COLLABORATEUR



    // PLANS
    Route::post('plan' ,  [\App\Http\Controllers\api\v1\planController::class , 'addPlan']);
    Route::post('plans' ,  [\App\Http\Controllers\api\v1\planController::class , 'getZonePlans']);
    Route::post('zoneDocuments' ,  [\App\Http\Controllers\api\v1\planController::class , 'getZoneDocuments']);

    // PLANNING

    Route::post('planning' , [\App\Http\Controllers\api\v1\PlanningController::class , 'addPlanning']);
    Route::post('updatePlanning' , [\App\Http\Controllers\api\v1\PlanningController::class , 'updatePlanning']);
    Route::post('deletePlanning' , [\App\Http\Controllers\api\v1\PlanningController::class , 'deletePlanning']);
    Route::post('getPlannings' , [\App\Http\Controllers\api\v1\PlanningController::class , 'getPlannings']);

    // OBSERVATION

    Route::post('observation' , [\App\Http\Controllers\api\v1\observationController::class , 'addObservation']);
    Route::put('test' , [\App\Http\Controllers\api\v1\test::class , 'test']);
    Route::post('deleteObservation' , [\App\Http\Controllers\api\v1\observationController::class , 'delete']);
    Route::post('getObservations' , [\App\Http\Controllers\api\v1\observationController::class , 'getObservationByProjectId']);

    // LET LOTS DE TRAVAIL

    Route::post('lots' , [\App\Http\Controllers\api\v1\LotController::class , 'lotDescription']);
    Route::post('addlot' , [\App\Http\Controllers\api\v1\LotController::class , 'addLot']);
    Route::post('getLots' , [\App\Http\Controllers\api\v1\LotController::class , 'getLots']);

    /// PDF
    ///
    Route::post('pdfGenerate' , [\App\Http\Controllers\api\v1\PdfController::class , 'generateRapport' ]);







});

// PAYPAL ROUTES

Route::get('handle-payment', [\App\Http\Controllers\api\v1\PayPalController::class , 'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [\App\Http\Controllers\api\v1\PayPalController::class , 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [\App\Http\Controllers\api\v1\PayPalController::class , 'paymentSuccess'])->name('success.payment');

Route::get('send-mail', [MailController::class, 'index']);
