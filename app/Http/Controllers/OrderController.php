<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::all();
        return response()->json(['orders' => $orders]);
    }

    public function show($id)
    {
        $order = order::findOrFail($id);
        return response()->json(['order' => $order]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'type'=>'required',
            'style'=>'required',
            'count'=>'required',
            'gender'=>'required',
            'priority'=>'required',
            'price'=>'required',
            'iron'=>'required',
            'rafa'=>'required',
            'wash'=>'required',
            'tincture'=>'required',
            'task_id'=>'required',
        ]);

        $order = order::create($request->all());
        return response()->json(['order' => $order], 201);
    }

    public function update(Request $request, $id)
    {
        $order = order::findOrFail($id);



        $order->update($request->all());
        return response()->json(['order' => $order]);
    }

    public function destroy($id)
    {
        $order = order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }

    public function GetOrderByTask(Request $request){

        $orders = order::where('task_id', $request->task_id)->get();
        return response()->json($orders);
    }
}
