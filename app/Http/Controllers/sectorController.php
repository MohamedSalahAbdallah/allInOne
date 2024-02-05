<?php

namespace App\Http\Controllers;

use App\Models\sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors =sector::all();
        return Response::json(['data'=>$sectors])
        ->setStatusCode(200 , "Sectors Returned succefully") ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|string']);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $sector = sector::create([
            'name'=>$request->name
        ]);
        return Response::json(['data'=>$sector])
        ->setStatusCode(200 , "Sector Created succefully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sector = sector::findOrFail($id);
        return Response::json(['data'=>$sector])
        ->setStatusCode(200 , "Sector Returned succefully") ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|string']);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $sector = sector::findOrFail($id);
        $sector->update([
            'name'=>$request->name
        ]);
        return Response::json(['data'=> $sector])
            ->setStatusCode(200 , "Sector Updated succefully") ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sector = sector::findOrFail($id);
        $sector->delete();
        return Response::json(['message'=> "sectore deleted"],200);

    }
}
