<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Inbox;

class UserController extends Controller
{
    public function login(Request $request) : string {
        $username = $request->username;
        $password = $request->password;


    }

    public function register(Request $request) {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $username = $request->username;
        $password = $request->password;
        $access_level = $request->access_level;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $password,
            'access_level' => $access_level
        ];

        User::create($data);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function updateUser(Request $request, $id) {
        $user = User::find($id);

        $access_level = $request->access_level;

        $data = [
            'access_level' => $access_level
        ];

        $user->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $data,
            'result' => $id,
            'message' => "user updated successfuly!"
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

    public function show() {
        return Inbox::with('user')->get();
    }

    public function showregUser() {
        return User::get();
    }

    public function getTotalMessage($user_id) {
        $count = Inbox::where('user_id', $user_id)->count('user_id');

        $data = DB::table('inbox')
            ->select('user_id', 'message', 'users.username')
            ->join('users', 'users.id', '=', 'inbox.user_id')
            ->where('inbox.user_id', $user_id)
            ->get();

        $username = $data->toArray()[0]->username;

        return response()->json([
            'username' => $username,
            'count' => $count
        ]);
    }

}


