<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function show()
    {
        // Установка локали для Carbon
        Carbon::setLocale(config('app.locale'));

        // Получение текущего дня недели
        $dayOfWeek = Carbon::now()->isoFormat('dddd'); // 'dddd' для полного названия дня недели, 'ddd' для краткого

        return view('welcome', compact('dayOfWeek'));
    }
}

