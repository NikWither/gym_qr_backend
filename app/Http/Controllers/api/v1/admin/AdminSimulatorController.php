<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Simulator\StoreRequest;
use App\Http\Requests\Simulator\UpdateRequest;
use App\Http\Resources\Admin\SimulatorResource;
use App\Models\Simulator;
use Illuminate\Http\Request;

class AdminSimulatorController extends Controller
{
    public function index()
    {
        return SimulatorResource::collection(Simulator::all());
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $simulator = Simulator::create($data);

        return response()->json([
            'simulator' => $simulator
        ]);
    }

    public function show(Simulator $simulator)
    {
        return $simulator;
    }

    public function update(UpdateRequest $request, Simulator $simulator)
    {
        $data = $request->validated();

        $simulator->update($data);

        return response()->json([
            'simulator' => $simulator
        ]);
    }

    public function destroy(Simulator $simulator)
    {
        $simulator->delete();

        return response()->json([
            'message' => 'ok'
        ]);
    }
}
