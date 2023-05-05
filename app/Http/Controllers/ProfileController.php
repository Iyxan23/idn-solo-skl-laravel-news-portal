<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function editPassword() {
        return view('admin.profile.change-password');
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|min:6|string',
            'confirm_password' => 'required|min:6|string',
        ]);

        if ($request->new_password != $request->confirm_password) {
            return redirect()->back()->with([
                Alert::error("Password does not match", "The given new password does not match with the confirmation password")
            ]);
        }

        $curPasswordStatus = Hash::check($request->current_password, auth()->user()->password);

        if ($curPasswordStatus) {
            if ($request->password === $request->confirmation_password) {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with([
                    Alert::success("Success", "Password successfully updated")
                ]);
            } else {
                return redirect()->back()->with([
                    Alert::error("Incorrect password", "Your confirmation password does not match with the new password you provided")
                ]);
            }
        } else {
            return redirect()->back()->with([
                Alert::error("Incorrect password", "Your provided pasword does not match with your current password")
            ]);
        }
    }
}
