<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('admin.categories.index');
    }

    public function list()
    {
        // devuelve la tabla con todas las columnas y categorías
        return Datatables::eloquent(Category::orderBy('name'))
            ->addColumn('action', function ($category) {
                return '<span class="text-right">' .
                    '<form action="' . route('categories.destroy', $category->id) . '" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <a href="' . route('categories.edit', $category->id) . '" class="btn btn-xs btn-link p-1 text-danger" title="Detail"><small>Editar</small></a>
                            <button type="submit"
                                    onclick="return window.confirm(\'¿Quiéres eliminar esta categoría?\');"
                                    class="btn btn-xs btn-link p-1 text-danger"
                                    title="Delete">
                                    <small>Eliminar</small>
                            </button>
                        </form>' .
                    '</span>';
            })
            ->rawColumns(['action'])
            ->setRowId('id')
            ->make();
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ], [
            'name.required' => 'El nombre de la categoría es necesario.',
            'name.unique' => 'Este nombre ya existe.'
        ]);

        Category::create([
            'name' => $request->get('name')
        ]);

        return redirect()->route('categories.index')->with('message', 'Categoría creada.');
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

    public function edit($id)
    {
        if ($category = Category::find($id)) {
            return view('admin.categories.edit', compact('category'));
        }
    }

    public function update(Request $request, $id)
    {
        if ($category = Category::find($id)) {

            $request->validate([
                'name' => 'required|unique:categories,name,' . $id
            ], [
                'name.required' => 'El nombre de la categoría es necesario.',
                'name.unique' => 'Este nombre ya existe.'
            ]);

            $category->update([
                'name' => $request->get('name')
            ]);

            return redirect()->route('categories.index')->with('message', 'La categoría ha sido actualizada.');
        }
    }

    public function destroy($id)
    {
        if ($category = Category::withCount('products')->find($id)) {

            if ($category->products_count > 0) {
                return redirect()->route('categories.index')->with('message', 'No puedes eliminar esta categoría, tiene productos asociados');
            }

            $category->delete();

            return redirect()->route('categories.index')->with('message', 'Categoría eliminada.');
        }
    }
}
