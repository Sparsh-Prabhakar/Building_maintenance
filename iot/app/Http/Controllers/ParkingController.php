<?php

namespace App\Http\Controllers;
use App\parking;
use App\corridor_lighting;
use App\security;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    public function parking(){
        $id = parking::get();
        return view('parking')->with('ids',$id);
    }
    public function corridor_lighting(){
        $id = corridor_lighting::get();
        return view('corridor_lighting')->with('ids',$id);
    }

    public function security(){
        $id = security::get();
        return view('security')->with('ids',$id);
    }
}
