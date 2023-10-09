<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProfileControler;
use App\Http\Controllers\ApplictionController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LocumController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupportController;


Route::controller(AuthController::class)->group(function () {
    Route::get("/login", 'create')->name('login')->middleware('guest');
    Route::post("/login", 'login')->middleware('guest');
    Route::delete('/logout', 'destory')->name('logout')->middleware('auth');

    Route::post('/forgot-password', 'reset')->name('password.email')->middleware('guest');
    Route::get("/forgot-password", 'forgot')->name('password.request')->middleware('guest');
});

Route::get("/verification/notice", function () {
    return Inertia::render("Verification/Notice");
})->name('verification.notice');

Route::get('/reset-password/{token}', function ($token) {
    return Inertia::render('Auth/ResetPassword', compact('token'));
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'update'])->name('password.update')->middleware('guest');

// home page
Route::get("/", [WelcomeController::class, 'index']);

// organizationd downloading applicant attachments
Route::get("/download/{path}", function ($path) {
    return redirect(\Storage::disk('s3')->url('tmp/' . $path));
});


Route::get('/jobs', [JobListingController::class, 'index']);
Route::get("/jobs/{job}", [JobListingController::class, 'show']);

Route::group(['middleware' => ['auth', 'verified']], function () {
    // locums jobs
    Route::get("/jobs/create", [JobListingController::class, 'create']);
    Route::post('/jobs', [JobListingController::class, 'store']);

    // applying a job
    Route::post("/apply", [ApplictionController::class, 'store']);

    // profile page
    Route::get("/profile", [ProfileControler::class, 'index'])->can('view-profile');
    Route::put("/profile", [ProfileControler::class, 'update']);

    // applicants
    Route::get("/dashboard", [DashboardController::class, 'index'])->can('post-jobs');
    Route::get("/dashboard/healthcare-professionals", [DashboardController::class, 'professions'])->can('post-jobs');
    
    Route::get("/dashboard/payment", [DashboardController::class, 'payment'])->can('post-jobs');


    Route::get("/applicants", [ApplicantsController::class, 'index'])->can('post-jobs');
    Route::get("/applicants/{applicant}", [ApplicantsController::class, 'show'])->can('post-jobs');
  
}); 

Route::get('/im-a-locum', [LocumController::class, 'index']);

Route::group(['middleware' => 'guest'], function () {
    // locums
    Route::get('/locum/register', [LocumController::class, 'create']);
    Route::post('/locum', [LocumController::class, 'store']);

    // organization looking for locums
    Route::get('/looking-for-a-locum', [OrganizationController::class, 'index']);
    Route::get('/practices/register', [OrganizationController::class, 'create']);
    Route::post('/practices', [OrganizationController::class, 'store']);

});

// events Pages
Route::controller(EventsController::class)->group(function () {
    Route::get("/events", 'index');
    Route::post("/events", 'store');
    Route::get("/events/{event}", 'show');
    Route::get("/events/{event}/register", 'create');
});

// Static pages
Route::get("/register", function () {
    return Inertia::render("Register");
});

Route::get("/terms-and-conditions-locums", function () {
    return Inertia::render("Policy/Locums");
});

Route::get("/terms-and-conditions", function () {
    return Inertia::render("Policy/Organization");
});

Route::get("/privacy-policy", function () {
    return Inertia::render("Policy/Privacy");
});

Route::get("/success", function () {
    return Inertia::render('Success');
})->middleware('auth');

// contact support
Route::get("/support", function () {
    return Inertia::render('Support');
});

Route::post("/support", [SupportController::class, 'contact']);
