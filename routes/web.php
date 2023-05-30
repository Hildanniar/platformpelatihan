<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\MateriTaskController;;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttainmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TypeTrainingController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardParticipantController;
use App\Http\Controllers\MenuParticipantController;
use App\Http\Controllers\TrainingParticipantsController;

// halaman utama tanpa login
Route::get('/', [DashboardController::class, 'dashboardPublic']);
Route::post('/' , [DashboardController::class, 'survey']);
Route::get('/about', [DashboardController::class, 'about']);
Route::get('/attainment', [DashboardController::class, 'attainment']);
Route::get('/attainment/{attainment}', [DashboardController::class, 'show_attainment']);
Route::get('/training', [DashboardController::class, 'trainings']);
Route::get('/training/{type_training}', [DashboardController::class, 'show_training']);

//halaman register
Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('register/action', [AuthenticationController::class, 'actionregister'])->name('actionregister');

//halaman login
Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
Route::get('/login/reload-captcha', [AuthenticationController::class, 'reloadcaptcha']);
Route::post('/login' , [AuthenticationController::class, 'login']);

//logout
Route::post('/logout' , [AuthenticationController::class, 'logout']);

Route::middleware('level')->group(function () {
// dashboard admin dan mentor
Route::get('/admin', [DashboardController::class, 'dashboardAdmin']);

//update profile admin dan mentor
Route::get('/profile', [DashboardController::class, 'PUpdate'])->name('profile.update');
Route::post('/profile/update', [DashboardController::class, 'UpdateProfile'])->name('update.user.profile');

Route::middleware('can:is_admin')->group(function(){

// halaman data admin
Route::get('/admin/admin/dataadmin', [AdminController::class, 'getAdmins']);
Route::get('/admin/Admin/export_excel', [AdminController::class, 'export_excel']);
Route::get('/admin/Admin/export_pdf', [AdminController::class, 'export_pdf']);
Route::resource('/admin/admin', AdminController::class);

// halaman data peserta
Route::get('/admin/participant/dataparticipant', [ParticipantController::class, 'getParticipants']);
Route::get('/admin/participant/export_excel', [ParticipantController::class, 'export_excel']);
Route::get('/admin/participant/export_pdf', [ParticipantController::class, 'export_pdf']);
Route::resource('/admin/participant', ParticipantController::class);

// halaman data mentor
Route::get('/admin/mentor/datamentor', [MentorController::class, 'getMentors']);
Route::get('/admin/mentor/export_excel', [MentorController::class, 'export_excel']);
Route::get('/admin/mentor/export_pdf', [MentorController::class, 'export_pdf']);
Route::resource('/admin/mentor', MentorController::class);

// halaman data jenis pelatihan
Route::get('/admin/type_training/datatraining', [TypeTrainingController::class, 'getTrainings']);
Route::get('/admin/type_training/export_excel', [TypeTrainingController::class, 'export_excel']);
Route::get('/admin/type_training/export_pdf', [TypeTrainingController::class, 'export_pdf']);
Route::resource('/admin/type_training', TypeTrainingController::class);

// halaman data sertifikat
Route::get('/admin/certificate/datacertificate', [CertificateController::class, 'getCertificates']);
Route::resource('/admin/certificate', CertificateController::class);

// halaman data survey
Route::get('/admin/survey/datasurvey', [SurveyController::class, 'getSurveys']);
Route::resource('/admin/survey', SurveyController::class);
});

// halaman data materi & tugas pelatihan 
Route::get('/admin/materi_tasks/datamateritasks', [MateriTaskController::class, 'getMateriTasks']);
Route::resource('/admin/materi_tasks', MateriTaskController::class);

// halaman data jadwal pelatihan
Route::get('/admin/schedule/dataschedule', [ScheduleController::class, 'getSchedules']);
Route::get('/admin/schedule/export_excel', [ScheduleController::class, 'export_excel']);
Route::get('/admin/schedule/export_pdf', [ScheduleController::class, 'export_pdf']);
Route::resource('/admin/schedule', ScheduleController::class);

// halaman data hasil karya pelatihan
Route::get('/admin/attainment/dataattainment', [AttainmentController::class, 'getAttainment']);
Route::resource('/admin/attainment', AttainmentController::class);

// update komentar
Route::get('/admin/training_participants/datatrainingparticipants', [TrainingParticipantsController::class, 'getTrainingParticipants']);
Route::resource('/admin/training_participants', TrainingParticipantsController::class);
});

//peserta
Route::middleware('can:is_participant')->group(function(){
// halaman dashboard peserta
Route::get('/dashboard/participant', [DashboardParticipantController::class, 'index']);
Route::get('/dashboard/participant/start', [DashboardParticipantController::class, 'start']);
Route::get('/dashboard/participant/attainment', [DashboardParticipantController::class, 'attainment']);
Route::get('/dashboard/participant/attainment/{attainment}', [DashboardParticipantController::class, 'show_attainment']);
Route::get('/dashboard/participant/training', [DashboardParticipantController::class, 'type_training']);
Route::get('/dashboard/participant/training/{type_training}', [DashboardParticipantController::class, 'show_training']);

// pendaftaran pelatihan
Route::get('/regristration/{type_training}', [TrainingParticipantsController::class, 'regristration'])->name('regristration.training');
Route::post('/regristration/add/{type_training}', [TrainingParticipantsController::class, 'AddRegristration']);

// update profile peserta
Route::get('/participant/profile', [DashboardParticipantController::class, 'ProfileUpdate'])->name('update.profile');
Route::post('/participant/profile/update', [DashboardParticipantController::class, 'UpdateProfileParticipant'])->name('update.profile.participant');

//jenis pelatihan peserta
Route::get('/participant/training', [MenuParticipantController::class, 'training']);
Route::get('/participant/training/datatraining', [MenuParticipantController::class, 'getTraining']);

// jadwal pelatihan peserta
Route::get('/participant/schedule/{typeTraining}', [MenuParticipantController::class, 'schedule']);

// materi & task pelatihan peserta
Route::get('/participant/materi_task/{type_training}', [MenuParticipantController::class, 'materi_task_online']);
Route::get('/participant/information/{typeTraining}', [MenuParticipantController::class, 'materi_task_offline']);
Route::get('/participant/materi/{materi}', [MenuParticipantController::class, 'show_materi']);
Route::get('/download', [MenuParticipantController::class, 'download_materi']);

//sertifikat
Route::get('/participant/certificate/{typeTraining}', [MenuParticipantController::class, 'certificate']);

//hasil karya pelatihan peserta
Route::get('/participant/attainment', [MenuParticipantController::class, 'attainment']);
Route::get('/participant/attainment/show/{attainment}', [MenuParticipantController::class, 'show_attainment']);

//upload hasil karya untuk kelas online
Route::get('/participant/attainment/{materiTask}', [MenuParticipantController::class, 'UploadAttainmentOnline']);
Route::post('/participant/attainment/add/{materiTask}', [MenuParticipantController::class, 'CreateAttainmentOnline']);

//upload hasil karya untuk kelas offline
Route::get('/participant/attainments/{typeTraining}', [MenuParticipantController::class, 'UploadAttainmentOffline']);
Route::post('/participant/attainment/create/{typeTraining}', [MenuParticipantController::class, 'CreateAttainmentOffline']);

//komentar mengenai pelatihan yang sudah di ikuti
Route::get('/participant/comment/{typeTraining}', [TrainingParticipantsController::class, 'comment']);
Route::post('/participant/comment/create/{typeTraining}', [TrainingParticipantsController::class, 'create_comment'])->name('create.comment');

});