<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{

    public function index()
    {
        return view('admin.products.index');
    }

    public function list()
    {
        $query = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('products.*, categories.name as category');

        return Datatables::query($query)
            ->addColumn('action', function ($product) {
                return '<span class="text-right">' .
                    '<form action="'.route('products.destroy', $product->id).'" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                           <a href="' . route('products.edit', $product->id) . '" class="btn btn-xs btn-link p-1 text-danger" title="Detail"><small>Edit</small></a>
                            <button type="submit"
                                    onclick="return window.confirm(\'¿Quiéres elminiar este producto?\');"
                                    class="btn btn-xs btn-link p-1 text-danger"
                                    title="Delete">
                                    <small>Eliminar</small>
                            </button>
                        </form>' .
                    '</span>';
            })
            ->editColumn('image', function ($product) {
                if(!empty($product->image)) {
                    return '<img src="' . asset('storage/' . $product->image) . '" class="img-thumbnail" />';
                }
                else return '';
            })
            ->rawColumns(['image', 'action'])
            ->setRowId('id')
            ->make();
    }

    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'category_id' => 'required',
           'name' => 'required|unique:products,name',
           'price' => 'required|numeric',
            'image' => 'mimes:jpeg,bmp,png'
        ], [
            'category_id.required' => 'Seleccionar categoría.',
                'name.required' => 'Nombre del producto',
                'name.unique' => 'Ya existe un producto con este nombre.',
                'price.required' => 'Precio.',
                'price.numeric' => 'El precio debe ser un número.',
            'image.mimes' => 'El archivo debe ser una imagen.',
        ]);

        DB::beginTransaction();

        $product = Product::create([
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
        ]);

        if ($request->hasFile("image")) {

            $image = $request->file("image");
            $filename = $product->id . '-' . $image->getClientOriginalName();
            $uploaded_image = Image::make($image); //original image

            $uploaded_image->resize(200, 200); //resized and save to
            Storage::disk('public')->put($filename, (string)$uploaded_image->encode());

            $product->update([
                'image' => $filename
            ]);
        }

        DB::commit();

        return redirect()->route('products.index')->with('message', 'Producto creado.');


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
        if($product = Product::find($id)) {

            $categories = Category::orderBy('name')->pluck('name', 'id');

            return view('admin.products.edit', compact('product', 'categories'));
        }
    }

    public function update(Request $request, $id)
    {
        if($product = Product::find($id)) {

            $request->validate([
                'category_id' => 'required',
                'name' => 'required|unique:products,name,' . $id,
                'price' => 'required|numeric',
               // 'image' => 'mimes:jpeg,bmp,png'
            ], [
                'category_id.required' => 'Seleccionar categoría.',
                'name.required' => 'Nombre del producto',
                'name.unique' => 'Ya existe un producto con este nombre.',
                'price.required' => 'Precio.',
                'price.numeric' => 'El precio debe ser un número.',
              //  'image.mimes' => 'The file should be an image.',
            ]);

            DB::beginTransaction();

            $product->update([
                'category_id' => $request->get('category_id'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
            ]);

            if ($request->hasFile("image")) {

                //elimina la foto anterior si se sube una nueva cuando se edita el producto
                if(!empty($product->image) && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $image = $request->file("image");
                $filename = $product->id . '-' . $image->getClientOriginalName();
                $uploaded_image = Image::make($image); //original image

                $uploaded_image->resize(200, 200); //CAMBIAR TAMAÑO y guardar
                Storage::disk('public')->put($filename, (string)$uploaded_image->encode());

                $product->update([
                    'image' => $filename
                ]);
            }

            DB::commit();

            return redirect()->route('products.index')->with('message', 'Product was updated.');


        }
    }


    public function destroy($id)
    {
        if($product = Product::withCount('order_lines')->find($id)) {

            if($product->order_lines_count > 0) {
                return redirect()->route('products.index')->with('message', 'Este producto tiene pedidos existentes, no se puede eliinar.');
            }

            $product->delete();

            return redirect()->route('products.index')->with('message', 'Producto eliminado.');
        }
    }
}
