<?php

namespace App\Http\Controllers;

use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = branch::all();
        return Response::json(['data'=>$branch])
        ->setStatusCode(200 , "Branches Returned succefully") ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' =>'required',
            'description'=>'required|string',
            'supplier_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $branch = branch::create([
            'name'=>$request->name,
            'location'=>$request->location,
            'description'=>$request->description,
            'supplier_id'=>$request->supplier_id,
        ]);
        return Response::json(['data'=>$branch])
        ->setStatusCode(200 , "Branch Created succefully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $branch = branch::findOrFail($id);
        return Response::json(['data'=>$branch])
        ->setStatusCode(200 , "Branch Returned succefully") ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' =>'required',
            'description'=>'required|string',
            'supplier_id'=>'required'
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $branch = branch::findOrFail($id);
        $branch->update([
            'name'=>$request->name,
            'location'=>$request->location,
            'description'=>$request->description,
            'supplier_id'=>$request->supplier_id,
        ]);
        return Response::json(['data'=> $branch])
            ->setStatusCode(200 , "Branch Updated succefully") ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = branch::findOrFail($id);
        $branch->delete();
        return Response::json(['message'=> "sectore deleted"],200);
    }
}
