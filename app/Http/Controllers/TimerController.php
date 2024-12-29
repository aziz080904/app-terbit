<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timer;

class TimerController extends Controller
{
    //
    public function show(){
        $list_kampus = Timer::all();
        return view('timer.show');
    }
}
