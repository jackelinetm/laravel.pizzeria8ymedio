<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
{

    public function index()
    {
        return view('admin.customers.index');
    }

    public function list()
    {   
        // Busca todos los registros de usuario en la base de datos
        $query = DB::table('users')
            ->leftJoin('orders', 'orders.user_id', '=', 'users.id')
            ->groupByRaw('users.id,
                            users.`name`,
                            users.email,
                            users.created_at')
            ->selectRaw('users.id,
                            users.`name`,
                            users.email,
                            users.created_at');

        return Datatables::query($query)
        // Crea la tabla con el query
            ->addColumn('action', function ($user) {
                return '<span class="text-right">' .
                    '<form action="'.route('customers.destroy', $user->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button type="submit"
                                    onclick="return window.confirm(\'¿Estas seguro que quieres eliminar el cliente?\');"
                                    class="btn btn-xs btn-link p-1 text-danger"
                                    title="Delete">
                                    <small>Eliminar</small>
                            </button>
                        </form>' .
                    '</span>';

                //<a href="' . route('categories.edit', $category->id) . '" class="btn btn-xs btn-link p-1 text-danger" title="Detail"><small>Edit</small></a>
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d M, Y h:i a');
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        if($customer = User::find($id)) {
            $customer->delete();
            return redirect()->route('customers.index')->with('message', 'Cliente eliminado.');
        }
    }
}
