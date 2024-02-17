<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function index()
    {
        return UserRequest::with(['user'])->get();
    }

    public function store(Request $request){

        return UserRequest::create($request->all());
    }

    public function update(Request $request){
        $userRequest=UserRequest::findOrFail($request->id);
        $userRequest->update($request->all());
        return response()->json($userRequest);
    }

    public function destroy($id){

        $userRequest=UserRequest::findOrFail($id);
        $userRequest->delete();
        return response()->json($userRequest);
    }
}
