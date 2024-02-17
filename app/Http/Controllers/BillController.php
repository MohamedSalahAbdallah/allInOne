<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bill = Bill::create($request->all());
        return Response::json(['data'=>$bill])
        ->setStatusCode(200 , "Branch Created succefully") ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
    public function clientBill($id)
    {
        $bill = Bill::findOrFail($id);
        // return $bill->order;
        return Response::json([
            'Order_Number'=>$bill->id,
            'Date'=>Carbon::parse($bill->created_at)->toDateString(),
            'Time'=>Carbon::parse($bill->created_at)->toTimeString(),
            'User_Id'=>$bill->user_id,
            'User_phone'=>$bill->user->phone,
            'City'=>$bill->user->location,
            'Address'=>$bill->user->address
        ]);
    }
}
