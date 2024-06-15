<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizationController;

/*
|--------------------------------------------------------------------------
| API Маршруты
|--------------------------------------------------------------------------
|
| Здесь вы можете зарегистрировать маршруты API для своего приложения. Эти
| маршруты загружаются RouteServiceProvider в группу, которой
| назначена группа промежуточного программного обеспечения "api". Наслаждайтесь созданием своего API!
| 
| CRUD
| read - events(index)
| read one - event(card)
| edit - upadte
| delete - destroy

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


Route::get('/api/organization/items', [OrganizationController::class, 'items'])->name('api.organization.items');
Route::post('/api/organization/create', [OrganizationController::class, 'store'])->name('api.organization.create');
