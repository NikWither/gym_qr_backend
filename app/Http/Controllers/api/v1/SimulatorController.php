<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SimulatorResource;
use App\Models\Simulator;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    public function index()
    {
        return SimulatorResource::collection(Simulator::all());
    }

    public function show(Simulator $simulator)
    {
        return SimulatorResource::collection($simulator);
    }
}
