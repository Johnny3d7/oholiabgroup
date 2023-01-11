<?php

namespace App\Http\Controllers\ParcAuto;

use App\Http\Controllers\Controller;
use App\Models\ParcAuto\Vehicle;
use Illuminate\Http\Request;

class ParcAutoController extends Controller
{
    public function index(){
        $vehicles = Vehicle::all();
        return view('main.parcauto.index', compact('vehicles'));
    }
}
