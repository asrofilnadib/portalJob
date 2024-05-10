<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UploadResumeController;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobListingController::class, 'index'])
  ->name('home');
Route::get('/jobs/{listing:slug}', [JobListingController::class, 'show'])
  ->name('job.show');

Route::post('/resume/upload', [UploadResumeController::class, 'store'])
  ->name('resume.upload');

Route::get('/dashboard', function () {
  $user = auth()->user();

  return view('dashboard', [
    'user' => $user,
  ]);
})->middleware(['auth', 'verified', 'isPremiumUser'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
  Route::get('/user/profile', [ProfilesController::class, 'edit'])
    ->name('profiles.edit');
  Route::post('/user/profile', [ProfilesController::class, 'update'])
    ->name('profiles.update');
  Route::delete('/user/profile', [ProfilesController::class, 'destroy'])
    ->name('profiles.delete');

  Route::get('/user/profile/seeker', [ProfileController::class, 'profileSeeker'])
    ->name('profile.seeker');
  Route::post('/user/password', [ProfileController::class, 'changePassword'])
    ->name('user.password');
  Route::post('/upload/resume', [ProfileController::class, 'uploadResume'])
    ->name('upload.resume');
});
Route::middleware(['isPremiumUser'])->group(function () {
  Route::get('/job/create', [PostJobController::class, 'create'])
    ->name('job.create');
  Route::post('/job/store', [PostJobController::class, 'store'])
    ->name('job.store');
  Route::get('/job/{listing}/edit', [PostJobController::class, 'edit'])
    ->name('job.edit');
  Route::put('/job/{id}/update', [PostJobController::class, 'update'])
    ->name('job.update');
  Route::get('/job', [PostJobController::class, 'index'])
    ->name('job.index');
  Route::delete('/job/{id}/delete', [PostJobController::class, 'destroy'])
    ->name('job.delete');
});

Route::get('/subscribe', [SubscriptionController::class, 'index'])
  ->middleware(['auth', 'notAllowed', 'isEmployer'])
  ->name('subscribe');

Route::middleware(['isEmployer', 'notAllowed'])->group(function () {
  Route::get('/pay/weekly', [SubscriptionController::class, 'initiatePayments'])
    ->name('pay.weekly');
  Route::get('/pay/monthly', [SubscriptionController::class, 'initiatePayments'])
    ->name('pay.monthly');
  Route::get('/pay/yearly', [SubscriptionController::class, 'initiatePayments'])
    ->name('pay.yearly');

  Route::get('/payment/succes', [SubscriptionController::class, 'success'])
    ->name('payment.success');
  Route::get('/payment/cancel', [SubscriptionController::class, 'cancel'])
    ->name('payment.cancel');
});

Route::get('/applicant', [ApplicantController::class, 'index'])
  ->name('applicant.index');
Route::get('/applicant/{listing:slug}', [ApplicantController::class, 'show'])
  ->name('applicant.show');
Route::post('/applicant/{listingId}/{userId}', [ApplicantController::class, 'shortlisted'])
  ->name('applicant.shortlisted');
Route::post('/applicant/{listingId}/submit', [ApplicantController::class, 'apply'])
  ->name('application.submit');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/users');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/users', function () {
  return view('users.index');
});

require __DIR__ . '/auth.php';
