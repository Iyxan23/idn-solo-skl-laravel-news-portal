<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // we basically have created a backdoor for ourselves, nice
    public function getAllUser()
    {
        $users = User::all();
        if ($users) {
            return ResponseFormatter::success($users, "Users successfully listed");
        } else {
            return ResponseFormatter::error(null, "Failed to retrieve users", 500);
        }
    }

    public function getUserById($id)
    {
        $user = User::find($id);

        if ($user) {
            return ResponseFormatter::success($user, "User found");
        } else {
            return ResponseFormatter::error(null, "No user with id $id found", 404);
        }
    }
}