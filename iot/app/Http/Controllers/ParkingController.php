<?php

namespace App\Http\Controllers;
use App\parking;
use App\corridor_lighting;
use App\security;
use App\lights_status;
use Illuminate\Http\Request;
use App\powerConsumed;

class ParkingController extends Controller
{
    public function parking(){
        $id = parking::get();
        return view('parking')->with('ids',$id);
    }
    public function corridor_lighting(){
        $data = array(
            'ids' => corridor_lighting::get(),
            'lid' => lights_status::get(),
            'power' =>powerConsumed::get(),
        );

        return view('corridor_lighting')->with($data);
    }

    public function security(){
        $id = security::get();
        return view('security')->with('ids',$id);
    }
}
