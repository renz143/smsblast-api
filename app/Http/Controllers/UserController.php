<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inbox;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function login(Request $request) : string {
        $username = $request->username;
        $password = $request->password;


    }

    public function register(Request $request) : JsonResponse {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $username = $request->username;
        $password = $request->password;
        $access_level = $request->access_level;


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

    public function sendSMS(Request $request) : JsonResponse {
        $phone_number = $request->phone_number;
        $message = $request->message;
        $user_id = $request->user_id;

        $phone_numbers = explode(',', $phone_number);

        $data = [];

        foreach ($phone_numbers as $numbers) {
            $data[] = [
                'phone_number' => $numbers,
                'message' => $message,
                'user_id' => $user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Inbox::insert($data);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully'
        ]);
    }

    public function showUsers() : Collection {
        return User::all();
    }

    public function updateUserPrivilege($user_id) {
        User::where('id', 3)->update(['title'=>'Updated title']);
    }

    public function show() : Collection {
        return Inbox::with('user')->get();
    }
}
