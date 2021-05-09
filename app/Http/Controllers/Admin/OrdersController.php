<?php

namespace App\Http\Controllers\Admin;

use App\Commons;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OrdersController extends Controller
{

    public function list()
    {
        $query = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select([
                'orders.*',
                'users.name',
            ]);

        return Datatables::query($query)
            ->addColumn('action', function ($order) {
                return '<span class="pull-right">' .
                    '<a href="' . route('admin.orders.detail', ['id' => $order->id]) . '" class="btn btn-xs btn-link p-1" title="Detail">Ver</a>' .
                    //'<a href="javascript:void(0);" onclick="return confirm_delete(\'' '\', \'' .'\');" class="btn btn-xs btn-link" title="Delete"><i class="fa text-danger fa-trash"></i></a>' .
                    '</span>';
            })
            ->editColumn('created_at', function ($order) {
                return Carbon::parse($order->created_at)->format('d M, Y h:i a');
            })
            ->rawColumns(['name', 'status', 'action'])
            ->setRowId('id')
            ->make();
    }

    public function detail(Request $request)
    {
        if ($order = Order::with([
            'user',
            'order_lines',
            'order_lines.product',
            'order_lines.product.category',
        ])
            ->find($request->get('id'))) {

            return view('admin.order-detail', compact('order'));
        }
    }

    public function change_status(Request $request)
    {
        if ($order = Order::find($request->get('id'))) {

            $order->update([
                'status' => $request->get('status')
            ]);

            return redirect()->route('admin.orders.detail', [ 'id' => $order->id]);
        }
    }
}
