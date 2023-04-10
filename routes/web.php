<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\MateriTaskController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttainmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TypeTrainingController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;

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
Route::get('/', [DashboardController::class, 'dashboard']);
Route::post('/' , [DashboardController::class, 'survey']);
Route::get('/tentang', function () {
    return view('dashboard.layouts.about');
});

//login
Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
Route::get('/login/reload-captcha', [AuthenticationController::class, 'reloadcaptcha']);
Route::post('/login' , [AuthenticationController::class, 'login']);

//logout
Route::post('/logout' , [AuthenticationController::class, 'logout']);

Route::middleware('level')->group(function () {
// dashboard
Route::get('/admin', [DashboardController::class, 'index']);

//user profile
Route::get('/admin/profile', [AuthenticationController::class, 'PUpdate'])->name('profile.update');
Route::post('/admin/profile/update', [AuthenticationController::class, 'UpdateProfile'])->name('update.user.profile');

Route::middleware('can:is_admin')->group(function(){
// user
Route::get('/admin/pengguna/datapengguna', [PenggunaController::class, 'getUsers']);
Route::get('/admin/pengguna/export_excel', [PenggunaController::class, 'export_excel']);
Route::get('/admin/pengguna/export_pdf', [PenggunaController::class, 'export_pdf']);
Route::resource('/admin/pengguna', PenggunaController::class);

// peserta
Route::get('/admin/participant/dataparticipant', [ParticipantController::class, 'getParticipants']);
Route::get('/admin/participant/export_excel', [ParticipantController::class, 'export_excel']);
Route::get('/admin/participant/export_pdf', [ParticipantController::class, 'export_pdf']);
Route::resource('/admin/participant', ParticipantController::class);

// mentor
Route::get('/admin/mentor/datamentor', [MentorController::class, 'getMentors']);
Route::get('/admin/mentor/export_excel', [MentorController::class, 'export_excel']);
Route::get('/admin/mentor/export_pdf', [MentorController::class, 'export_pdf']);
Route::resource('/admin/mentor', MentorController::class);

// jenis pelatihan
Route::get('/admin/type_training/datatraining', [TypeTrainingController::class, 'getTrainings']);
Route::get('/admin/type_training/export_excel', [TypeTrainingController::class, 'export_excel']);
Route::get('/admin/type_training/export_pdf', [TypeTrainingController::class, 'export_pdf']);
Route::resource('/admin/type_training', TypeTrainingController::class);

// sertifikat
Route::get('/admin/certificate/datacertificate', [CertificateController::class, 'getCertificates']);
Route::resource('/admin/certificate', CertificateController::class);

// survey
Route::get('/admin/survey/datasurvey', [SurveyController::class, 'getSurveys']);
Route::resource('/admin/survey', SurveyController::class);
});

// materi & tugas
Route::get('/admin/materi_tasks/datamateritasks', [MateriTaskController::class, 'getMateriTasks']);
Route::resource('/admin/materi_tasks', MateriTaskController::class);

// jadwal
Route::get('/admin/schedule/dataschedule', [ScheduleController::class, 'getSchedules']);
Route::get('/admin/schedule/export_excel', [ScheduleController::class, 'export_excel']);
Route::get('/admin/schedule/export_pdf', [ScheduleController::class, 'export_pdf']);
Route::resource('/admin/schedule', ScheduleController::class);

// hasil karya
Route::get('/admin/attainment/dataattainment', [AttainmentController::class, 'getAttainment']);
Route::resource('/admin/attainment', AttainmentController::class);

});