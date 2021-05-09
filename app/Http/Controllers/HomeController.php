<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if(auth('admin')->check()) {
            return redirect()->route('dashboard');
        }

        $top_three_products = DB::table('order_lines')
            ->join('products', 'products.id', '=', 'order_lines.product_id')
            ->selectRaw('products.id, products.`name`, products.`image`, products.`price`, products.`description`, Sum(order_lines.amount)')
            ->groupByRaw('products.`name`, products.id, products.`image`, products.`price`, products.`description`')
            ->orderByRaw('sum(order_lines.amount) DESC')
            ->limit(3)
            ->get();

        return view('home', compact('top_three_products'));
    }

    public function menu()
    {
        $products = DB::table('products')
            ->join('categories', 'categories.id', 'products.category_id')
            ->orderBy('categories.name')
            ->orderBy('products.name')
            ->select([
                'categories.name as category',
                'products.id',
                'products.name',
                'products.description',
                'products.price',
            ])
            ->get();

        $categories = Category::with('products')
            ->has('products')
            ->orderBy('name')->get();


        return view('menu', compact('products', 'categories'));
    }

    public function contact()
    {
        return view('contact');
    }



}
