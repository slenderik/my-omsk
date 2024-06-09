<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| API Маршруты
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать маршруты API для своего приложения. Эти
| маршруты загружаются RouteServiceProvider в группу, которой
| назначена группа промежуточного программного обеспечения "api". Наслаждайтесь созданием своего API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// this is api.php
// API EVENTS CRUD
// Read in web.php

Route::post('/api/event/create', [EventController::class, 'store'])->name('api.event.create');
Route::patch('/api/event/update/{id}', [EventController::class, 'update'])->name('api.event.update');
Route::delete('/api/event/delete/{id}', [EventController::class, 'destroy'])->name('api.event.delete');

// read - events(index)
// read one - event(card)
// create - new
// edit - upadte
// delete - destroy
