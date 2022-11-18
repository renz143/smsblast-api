<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inbox;

class UserController extends Controller
{
    public function login(Request $request) : string {
        $username = $request->username;
        $password = $request->password;


    }

    public function register(Request $request) {
        $username = $request->username;
        $password = $request->password;

        $data = [
            'name' => $username,
            'password' => $password
        ];

        User::create($data);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function sendSMS(Request $request) {
        $phone_number = $request->phone_number;
        $message = $request->message;
        $user_id = $request->user_id;

        $phone_numbers = explode(',', $phone_number);

        $data = [];

        foreach ($phone_numbers as $numbers) {
            $data[] = [
                'phone_number' => $numbers,
                'message' => $message,
                'user_id' => $user_id
            ];
        }

        Inbox::insert($data);
    }
}