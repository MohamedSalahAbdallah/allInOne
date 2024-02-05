<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers =supplier::all();
        return Response::json(['data'=>$suppliers])
        ->setStatusCode(200 , "suppliers Returned succefully") ;
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator=  $this->makeValidationForStore($request);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }
        $supplier = $this->makeCreateForSupplier($request);
        return Response::json(['data'=>$supplier])
        ->setStatusCode(200 , "supplier Created succefully") ;
    }
    public function makeCreateForSupplier($request)
    {
        return supplier::create([
            'name'=>$request->name,
            'sector_id'=>$request->sector_id,
            'trade_license'=>$request->trade_license,
            'registry_office'=>$request->registry_office,
            "trade_license_number"=>$request->trade_license_number,
            "directorate"=>$request->directorate,
            "director_name"=>$request->director_name,
            "phone_number"=>$request->phone_number,
            "email"=>$request->email,
            "sales_manager_name"=>$request->sales_manager_name,
            "sales_manager_phone"=>$request->sales_manager_phone,
            "company_number"=>$request->company_number,
            "fax_number"=>$request->fax_number,
            "headquarters_address"=>$request->headquarters_address,
            "company_email"=>$request->company_email,
            "manufacturing_license"=>$request->manufacturing_license,
        ]);
    }
    public function makeValidationForStore($request)
    {
        return Validator::make($request->all(),[
            'name'=>'required|string',
            'sector_id'=>'required',
            'trade_license'=>'required|string',
            'registry_office'=>'required|string',
            "trade_license_number"=>'required|numeric',
            "directorate"=>'required|string',
            "director_name"=>'string',
            "phone_number"=>'unique:suppliers,phone_number|string',
            "email"=>'email|unique:suppliers,email',
            "sales_manager_name"=>'string',
            "sales_manager_phone"=>'string',
            "company_number"=>'string',
            "fax_number"=>'numeric',
            "headquarters_address"=>'string',
            "company_email"=>'email',
            "manufacturing_license"=>'string',
        ]);


    }
    public function makeValidationForUpdate($request , $id)
    {
        $supplier = supplier::findOrFail($id);
        $data = [
            'name'=>'required|string',
            'sector_id'=>'required',
            'trade_license'=>'required|string',
            'registry_office'=>'required|string',
            "trade_license_number"=>'required|numeric',
            "directorate"=>'required|string',
            "director_name"=>'string',
            "sales_manager_name"=>'string',
            "sales_manager_phone"=>'string',
            "company_number"=>'string',
            "fax_number"=>'numeric',
            "headquarters_address"=>'string',
            "company_email"=>'email',
            "manufacturing_license"=>'string',
        ];
        if(!$request->email == $supplier->email)
        {
            $data["email"]='email|unique:suppliers,email';
        }
        if(!$request->phone_number == $supplier->phone_number)
        {
            $data["phone_number"]='unique:suppliers,phone_number|string';
        }
        return Validator::make($request->all(),$data);




    }

    public function makeUpdateForSupplier($request , $id)
    {
        $supplier = supplier::findOrFail($id);
        return  $supplier->update([
            'name'=>$request->name,
            'sector_id'=>$request->sector_id,
            'trade_license'=>$request->trade_license,
            'registry_office'=>$request->registry_office,
            "trade_license_number"=>$request->trade_license_number,
            "directorate"=>$request->directorate,
            "director_name"=>$request->director_name,
            "phone_number"=>$request->phone_number,
            "email"=>$request->email,
            "sales_manager_name"=>$request->sales_manager_name,
            "sales_manager_phone"=>$request->sales_manager_phone,
            "company_number"=>$request->company_number,
            "fax_number"=>$request->fax_number,
            "headquarters_address"=>$request->headquarters_address,
            "company_email"=>$request->company_email,
            "manufacturing_license"=>$request->manufacturing_license,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = supplier::findOrFail($id);
        return Response::json(['data'=>$supplier])
        ->setStatusCode(200 , "supplier Returned succefully") ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = $this->makeValidationForUpdate($request , $id);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->errors()], 422);
        }

        $supplier = $this->makeUpdateForSupplier($request , $id);
        return Response::json(['data'=> $supplier])
            ->setStatusCode(200 , "supplier Updated succefully") ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = supplier::findOrFail($id);
        $supplier->delete();
        return Response::json(['message'=> "supplier deleted"],200);
    }
}
