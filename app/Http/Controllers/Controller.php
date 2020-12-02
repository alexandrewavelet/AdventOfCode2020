<?php

namespace App\Http\Controllers;

use App\Factories\DayFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome(): View
    {
        return view('welcome');
    }

    public function day($number): View
    {
        try {
            $day = DayFactory::create($number);
        } catch (\Throwable $e) {
            abort(404);
        }

        return view('day', ['number' => $number, 'day' => $day]);
    }
}
