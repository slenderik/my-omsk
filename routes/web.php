<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать веб-маршруты для вашего приложения. Эти
| маршруты загружаются RouteServiceProvider и все они будут быть отнесен к группе
| промежуточного программного обеспечения «Интернет». Сделайте что-нибудь великое!
|
*/

// WELCOME PAGE
Route::get('/', [Controller::class, 'show']);


// VIEW EVENTS
// Здесь как раз и есть опарции Read - просмотра.
Route::get('/events', [EventController::class, 'index'])->name('events');
// EDIT PAGES
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
Route::get('/event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
Route::get('/event/delete/{id}', [EventController::class, 'delete'])->name('event.delete');

Route::get('/event/{id}', [EventController::class, 'view'])->name('event');
// read - events(index)
// read one - event(card)
// create - new
// edit - upadte
// delete - destroy


// ORGANIZATIONS
Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
Route::get('/organization/create', [OrganizationController::class, 'create'])->name('organizations.create');

Route::get('/organization/{id}', [OrganizationController::class, 'organization'])->name('organization');

// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
