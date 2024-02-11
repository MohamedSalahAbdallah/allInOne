<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = order::all();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = order::findOrFail($id);
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'category'=>'required',
            'type'=>'required',
            'style'=>'required',
            'count'=>'required',
            'gender'=>'required',
            'priority'=>'required',
            // 'price'=>'required',
            'action.iron'=>'required',
            'action.rafa'=>'required',
            'action.wash'=>'required',
            'action.tincture'=>'required',
            'task_id'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // return response()->json($request);

        $order= new order;
        $order->category=$request->category;
        $order->type=$request->type;
        $order->style=$request->style;
        $order->count=$request->count;
        $order->gender=$request->gender;
        $order->priority=$request->priority;
        // $order->price=$request->price;
        $order->task_id=$request->task_id;
        $order->iron=$request->input('action.iron');
        $order->rafa=$request->input('action.rafa');
        $order->wash=$request->input('action.wash');
        $order->tincture=$request->input('action.tincture');

        $order->save();
        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = order::findOrFail($id);
        $order->category=$request->category;
        $order->type=$request->type;
        $order->style=$request->style;
        $order->count=$request->count;
        $order->gender=$request->gender;
        $order->priority=$request->priority;
        // $order->price=$request->price;
        $order->task_id=$request->task_id;
        $order->iron=$request->input('action.iron');
        $order->rafa=$request->input('action.rafa');
        $order->wash=$request->input('action.wash');
        $order->tincture=$request->input('action.tincture');



        $order->update();

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
