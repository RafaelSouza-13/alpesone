<?php

namespace App\Http\Controllers;

use App\Exceptions\VehicleNotFoundException;
use App\Http\Requests\VehicleRequest;
use App\Http\Requests\VehicleRequestUpdate;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\VehicleRepository;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Container\Attributes\Auth;

class VehicleController extends Controller
{
    protected VehicleRepository $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }
    public function index()
    {
        $vehicles = Vehicle::paginate(5);
        return VehicleResource::collection($vehicles)->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $data = $request->validated();
        $vehicle = $this->vehicleRepository->updateOrCreate($data);
        return response()->json(['data' => new VehicleResource($vehicle)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $vehicle = Vehicle::where('json_data_id', $id)->firstOrFail();
        }catch(ModelNotFoundException $e){
            throw new VehicleNotFoundException();
        }
        return (new VehicleResource($vehicle))->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequestUpdate $request, string $id)
    {
        try{
            $vehicle = $this->vehicleRepository->findByJsonId($id);
            $data = $request->validated();
            $vehicle->update($data);
            
        }catch(ModelNotFoundException $e){
            throw new VehicleNotFoundException();
        }
        return response()->json(['data' => new VehicleResource($vehicle)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vehicle = Vehicle::where('json_data_id', $id)->firstOrFail();
            $vehicle->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vehicle deleted successfully.'
            ], 200);

        } catch (ModelNotFoundException $e) {
            throw new VehicleNotFoundException();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.'
            ], 500);
        }
    }
}
