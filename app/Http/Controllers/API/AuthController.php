<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Invalid credentials'
                ], 'Authentication Failed', 403);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');

        } catch (\Error $err) {
            return ResponseFormatter::error([
                'message' => 'Error while logging in',
                'error' => $err,
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'confirmation_password' => 'required|string|min:8'
            ]);

            // check if the password matches with confirmation password
            if ($request->password != $request->confirmation_password) {
                // it doesn't match
                return ResponseFormatter::error([
                    'message' => 'Confirmation password does not match with the provided password',
                ], 300);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Registered successfully');

        } catch (\Error $err) {
            return ResponseFormatter::error([
                'message' => 'Error while logging in',
                'error' => $err,
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token, 'Token revoked');
    }

    public function updatePassword(Request $request)
    {
        try {
            // $request->validate([
            //     'new_password' => 'required|string|min:8'
            // ]);

            // with Validator
            $validator = Validator::make($request->all(), [
                // I felt like these fields are useless, since the user is already logged in with
                // a token. But it's included within the IT class so someone might need this. 

                // 'current_password' => 'required|string',
                'new_password' => 'required|string|min:8',
                // 'confirmation_password' => 'required|string|min:8',
            ]);

            // when the validator failed
            if ($validator->fails()) {
                return ResponseFormatter::error(null, 'Invalid arguments given');
            }

            $user = User::find(Auth::id());
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);
            $user->save();

            $token = $request->user()->currentAccessToken()->delete();
            $new_token = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'revoked_token' => $token,
                'new_token' => $new_token,
            ], 'Password updated');
        } catch (\Error $err) {
            return ResponseFormatter::error($err, "Couldn't change password", 500);
        }
    }
}