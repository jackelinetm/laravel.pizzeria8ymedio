<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add_to_cart(Request $request)
    {
        $product = Product::with('category')->find($request->get('id'));

        CartFacade::add(
            $product->id,
            $product->name,
            $product->price,
            1, //Cantidad es 1 por defecto when add-to-cart is clicked
            [
                'image' => $product->get_image(),
                'category' => $product->category->name,
            ]);

        return back()->with('message', "<strong>$product->name</strong> ha sido añadido a tu carrito.");
    }

    public function remove(Request $request)
    {
        CartFacade::remove($request->get('id'));

        return back();
    }

    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Tienes que ingresar a tu cuenta para hacer un pedido.');
        }

        if (!CartFacade::isEmpty()) {

            $cart_items = CartFacade::getContent();

            $order = Order::create([
                'user_id' => auth()->id(),
                'created_at' => now(),
                'amount' => CartFacade::getTotal(),
                'status' => Order::PENDING
            ]);

            foreach ($cart_items as $item) {
                $order_line = OrderLine::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'amount' => $item->quantity * $item->price
                ]);
            }

            CartFacade::clear();

            return redirect()->route('success', ['order_id' => $order->id]);
        } else {
            return redirect()->route('cart');
        }
    }

    public function success(Request $request)
    {
        return view('success', [
            'order_id' => $request->get('order_id')
        ]);
    }
}
