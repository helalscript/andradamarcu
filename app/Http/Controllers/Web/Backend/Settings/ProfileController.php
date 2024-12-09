<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Exception;

class ProfileController extends Controller
{
    /**
     * Display the profile Settings page.
     *
     * @return View
     */
    public function index()
    {
        $userId = Auth::id();
        $user = User::where('id', $userId)->first();
        return view('backend.layout.setting.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:100|min:2',
            'phone_number' => 'nullable|numeric|unique:users,phone,' . auth()->user()->id,
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'avatar' => 'nullable|mimes:jpeg,jpg,png,ico,svg|max:2048',
        ]);
        $user = User::find(auth()->user()->id);
        $user->name = $request->full_name;
        $user->phone = $request->phone_number;
        $user->email = $request->email;
        if ($request->hasFile('avatar')) {
            if ($user && $user->avatar && file_exists(public_path($user->avatar))) {
                Helper::fileDelete(public_path($user->avatar));
            }
            $user->avatar = Helper::fileUpload($request->file('avatar'), 'avatar', $user->name . time() . '_' . getFileName($request->file('avatar')));
        }
        $user->save();
        flash()->success('Your profile has been updated.');
        return redirect()->back();
    }

    /**
     * Update the user's password.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function UpdatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                flash()->success('Password Updated Successfully');
                return redirect()->back();
            } else {
                flash()->error('Current password is incorrect');
                return redirect()->back();
            }
        } catch (Exception) {
            flash()->error('Something went wrong');
            return redirect()->back();
        }
    }
}
