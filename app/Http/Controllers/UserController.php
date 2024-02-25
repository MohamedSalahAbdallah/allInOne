<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }

    public function gentoken(Request $request){

        $user = User::where('email', $request->email)->first();
        $user->createToken($request->email);

        // Return token
        return response()->json($user->createToken($request->email)->plainTextToken);
    }

    //user login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }


        return response()->json('success', 200);
    }

    //user register

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|unique:users,phone',
            'current_address' => 'required|string',
            'current_country' => 'required|string',
            'current_state' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'password' => Hash::make($request->password),
            'phone'=>$request->phone,
            'current_address'=>$request->current_address,
            'current_country'=>$request->current_country,
            'current_state'=>$request->current_state
        ]);

        return response()->json('success', 200);
    }

}
