<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SystemDataController;
use App\Http\Controllers\Admin\SurveyController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes(['verify' => true]);

// Public welcome
Route::get('/', fn() => view('welcome'))->name('welcome');

// Auth (guest only)
Route::middleware('guest')->group(function(){
    Route::get('login',    [LoginController::class,'showLoginForm'])->name('login');
    Route::post('login',   [LoginController::class,'login']);
    Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('register',[RegisterController::class,'register']);
});

// Logout
Route::post('logout', [LoginController::class,'logout'])
     ->middleware('auth')
     ->name('logout');

// Home (for non-admins)
Route::get('/home', function() {
     return redirect('/dashboard');
})->middleware('auth')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
     //showQuestionnaire
     Route::get('questionnaire/show', [StudentController::class, 'showQuestionnaire'])
         ->name('student.questionnaire.show');

    /** Dashboard (after login) */
    Route::get('/dashboard', [StudentController::class, 'dashboard'])
         ->name('dashboard');                           // ← matches LoginController

    /** Profile */
    Route::get('profile',  [StudentController::class, 'editProfile'])
         ->name('student.profile.edit');
    Route::post('profile', [StudentController::class, 'updateProfile'])
         ->name('student.profile.update');

    /** Questionnaire */
    Route::get('questionnaire',  [StudentController::class, 'startQuestionnaire'])
         ->name('student.questionnaire.start');
    Route::post('questionnaire', [StudentController::class, 'submitQuestionnaire'])
         ->name('student.questionnaire.submit');

    
    /** Results + PDF download */
    Route::get('results',               [StudentController::class, 'results'])
         ->name('student.results');
    Route::get('results/download',     [StudentController::class, 'downloadResults'])
          ->name('student.results.download');
    
    /** Survey submission */
    Route::post('survey/submit',       [StudentController::class, 'submitSurvey'])
         ->name('student.survey.submit');
});


Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])
         ->name('dashboard');

    // Users CRUD
    Route::get('users',             [UserController::class, 'index'])->name('users.index');
    Route::get('users/create',      [UserController::class, 'create'])->name('users.create');
    Route::post('users',            [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}',      [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}',   [UserController::class, 'destroy'])->name('users.destroy');

    // Questions CRUD
    Route::get('questions',                [QuestionController::class, 'index'])->name('questions.index');
    Route::get('questions/create',         [QuestionController::class, 'create'])->name('questions.create');
    Route::post('questions',               [QuestionController::class, 'store'])->name('questions.store');
    Route::get('questions/{question}/edit',[QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('questions/{question}',     [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('questions/{question}',  [QuestionController::class, 'destroy'])->name('questions.destroy');

    // Surveys
    Route::get('surveys',                  [SurveyController::class, 'index'])->name('surveys.index');
    Route::get('surveys/export',           [SurveyController::class, 'export'])->name('surveys.export');
    Route::delete('surveys/{survey}',      [SurveyController::class, 'destroy'])->name('surveys.destroy');

    // System Data & Retrain
    Route::get('system',                   [SystemDataController::class, 'dashboard'])
         ->name('system.index');
    Route::post('system/retrain',          [SystemDataController::class, 'retrain'])
         ->name('system.retrain');

           Route::get('system', [SystemDataController::class, 'dashboard'])
         ->name('system.dashboard');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
