<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {

        return view('user.index');
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                Rule::unique('users', 'email')
                    ->ignore(auth()->id())
            ],
        ]);

        auth()->user()->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return back()->with('message', 'Perfil actualizado');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        return $fail(__('El password actual es incorrecto.'));
                    }
                },
            ],
            'password' => ['required', 'confirmed'],
          //  'password_confirmation' => ['required'],
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->get('password')),
        ]);

        return back()->with('message', 'Password updated successfully');
    }

    public function orders()
    {
        $orders = auth()->user()->orders()->orderBy('created_at', 'desc')->get();
        return view('user.orders', compact('orders'));
    }

    public function detail(Request $request)
    {
        //if the order id passed is found in the DB
        if ($order = Order::with([
            'order_lines',
            'order_lines.product',
            'order_lines.product.category'
        ])
            ->find($request->get('id'))) {

            //if this order id belongs to the logged in customer
            if ($order->user_id == auth()->id()) {

                return view('user.order-detail', compact('order'));

            }
        }
    }
}
