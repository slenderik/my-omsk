<?php


use Illuminate\Support\Facades\Route;
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

// JUST WELCOME
Route::get('/', function () {
    return view('welcome');
});


// EVENTS
Route::post('api/events', [EventController::class, 'new'])->name('events.new');


Route::get('/event/{id}', [EventController::class, 'event']);
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
// Route::post('/events/add', [EventController::class, 'new'])->name('events.new');


// ORGANIZATIONS
Route::get('/api/organization', [OrganizationController::class, 'items']);
Route::post('/api/organization', [OrganizationController::class, 'store']);
Route::post('/organizations/add', [OrganizationController::class, 'new'])->name('organizations.new');


Route::get('/organization/{id}', [OrganizationController::class, 'organization']);
Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');


// MAIN PAGE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
