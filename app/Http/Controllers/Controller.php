<?php

namespace App\Http\Controllers;

use App\Factories\DayFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use NumberFormatter;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome(): View
    {
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);

        $days = collect(Storage::disk('days')->files())
            ->mapWithKeys(function (string $filename) use ($formatter) {
                $number = pathinfo($filename, PATHINFO_FILENAME);
                return [$number => $formatter->format($number)];
            })
            ->sortKeys()
        ;

        return view('welcome', ['days' => $days]);
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
