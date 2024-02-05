<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles =vehicle::all();
        return Response::json(['data'=>$vehicles])
        ->setStatusCode(200 , "vehicles Returned succefully") ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "chassis_number" =>'required|numeric',
            "engine_number" =>'required|numeric',
            "plate_number"  =>'required|numeric',
            "vehicle_type" =>'required',
            "vehicle_brand" =>'required',
            "vehicle_year"  =>'required',
            "vehicle_color" =>'required|string',
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $vehicle = vehicle::create([
            "chassis_number" => $request->chassis_number,
            "engine_number" => $request->engine_number,
            "plate_number" => $request->plate_number,
            "vehicle_type" => $request->vehicle_type,
            "vehicle_brand" => $request->vehicle_brand,
            "vehicle_year" => $request->vehicle_year,
            "vehicle_color" => $request->vehicle_color,
        ]);
        return Response::json(['data'=>$vehicle])
        ->setStatusCode(200 , "vehicle Created succefully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = vehicle::findOrFail($id);
        return Response::json(['data'=>$vehicle])
        ->setStatusCode(200 , "vehicle Returned succefully") ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
         $validator = Validator::make($request->all(),
         [
            "chassis_number" =>'required|numeric',
            "engine_number" =>'required|numeric',
            "plate_number"  =>'required|numeric',
            "vehicle_type" =>'required',
            "vehicle_brand" =>'required',
            "vehicle_year"  =>'required',
            "vehicle_color" =>'required|string',
        ]
        );

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $vehicle = vehicle::findOrFail($id);
        $vehicle->update([
            "chassis_number" => $request->chassis_number,
            "engine_number" => $request->engine_number,
            "plate_number" => $request->plate_number,
            "vehicle_type" => $request->vehicle_type,
            "vehicle_brand" => $request->vehicle_brand,
            "vehicle_year" => $request->vehicle_year,
            "vehicle_color" => $request->vehicle_color,
        ]);
        return Response::json(['data'=> $vehicle])
            ->setStatusCode(200 , "vehicle Updated succefully") ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $vehicle  = vehicle::findOrFail($id);
        $vehicle->delete();
        return Response::json(['message'=> "vehicle deleted"],200);
    }
}
