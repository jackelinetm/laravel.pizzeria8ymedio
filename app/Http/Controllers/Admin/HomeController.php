<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        if (auth('admin')->check()) {
            return redirect()->route('dashboard');
        }

        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        if (auth('admin')->attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {

            return redirect()->route('dashboard');

        } else {
            return back()->withInput(['email'])->with('message', 'Invalid email/password.');
        }
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth('admin')->user()->password)) {
                        return $fail(__('El password actual es incorrecto.'));
                    }
                },
            ],
            'password' => ['required', 'confirmed'],
            //  'password_confirmation' => ['required'],
        ]);

        Admin::find(auth('admin')->id())->update([
            'password' => bcrypt($request->get('password')),
        ]);

        return back()->with('message', 'Password Actualizado');
    }
}
