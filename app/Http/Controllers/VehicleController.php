<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::paginate(5);
        return VehicleResource::collection($vehicles)->response()->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $data = $request->validated();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $vehicle = Vehicle::findOrFail($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
        return (new VehicleResource($vehicle))->response()->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, string $id)
    {
        try{
            $vehicle = Vehicle::where('json_data_id', $id)->firstOrFail();
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
