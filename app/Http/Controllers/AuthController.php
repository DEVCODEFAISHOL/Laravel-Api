<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        // $validated = request()->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);
        $validated = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }
        try {
            // Here you would typically create the user and save it to the database
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request->password),
            ]);
            // Redirect or return a view after registration
            $token = $user->createToken('auth_token')->plainTextToken; // Create a token for the user
            return response()->json(['token' => $token, 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registration failed'], 500);
        }
    }
    // Other methods like login, logout, etc. can be added here
    public function login(Request $request)
    {
        // Implement login logic here
         $validated = Validator::make(request()->all(), [

            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 400);
        }

    }
}
