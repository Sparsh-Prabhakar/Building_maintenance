<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\corridor_lighting;
use Chart;

class ChartsController extends Controller
{
    public function charts(){
        $id = corridor_lighting::get();
        return view('charts');
    }
}
