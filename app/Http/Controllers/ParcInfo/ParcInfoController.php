<?php

namespace App\Http\Controllers\ParcInfo;

use App\Http\Controllers\Controller;
use App\Models\ParcInfo\Device;
use Illuminate\Http\Request;

class ParcInfoController extends Controller
{
    public function index(){
        // return redirect()->route('parcinfo.devices.index');
        $devices = Device::all();
        return view('main.parcinfo.index', compact('devices'));
    }
}
