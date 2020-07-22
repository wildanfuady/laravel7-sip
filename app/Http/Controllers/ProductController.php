<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Category;
use Session;
use Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category   = $request->query('category_id');
        $keyword    = $request->query('keyword');

        $categories = Category::where('status', 'Active')->pluck('name', 'id');
        
        $paginate   = 1;

        $where = [];

        if(!empty($category)) {
            $where[] = ['products.category_id', '=', $category];
        }

        if(!empty($keyword)) {
            $where[] = ['products.name', 'LIKE', "%{$keyword}%"];
        }

        if(empty($category) && empty($keyword)) {
            // menampilkan hal tertentu saja dengan selectRaw
            $select = "products.*, categories.name as category_name";
            $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw($select)
            ->orderBy('created_at', 'DESC')
            ->paginate($paginate);
        } else {
             // menampilkan hal tertentu saja dengan selectRaw
             $select = "products.*, categories.name as category_name";
             $products = Product::join('categories', 'products.category_id', '=', 'categories.id')
             ->selectRaw($select)
             ->where($where)
             ->orderBy('created_at', 'DESC')
             ->paginate($paginate);
        }

        return view('admin.product.index', compact('products', 'paginate', 'categories', 'category', 'keyword'));
    }

    public function create()
    {
        $categories = Category::where('status', 'Active')->pluck('name', 'id');

        // dd($categories);

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'category_id'       => 'required',
            'name'              => 'required',
            'price'             => 'required',
            'sku'               => 'required',
            'status'            => 'required',
            'description'       => 'required',
            'image'             => 'required|mimes:jpg,png,jpeg,gif',
        ];

        $messages = [
            'category_id.required'      => 'Kategori wajib diisi',
            'name.required'             => 'Nama produk wajib diisi',
            'price.required'            => 'Harga produk wajib diisi',
            'sku.required'              => 'SKU / Kode Produk wajib diisi',
            'status.required'           => 'Status wajib diisi',
            'description.required'      => 'Deskripsi wajib diisi',
            'image.required'            => 'Gambar wajib diisi',
            'image.mimes'               => 'Gambar hanya boleh bertipe jpg, png, jpeg dan gif',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $product        = new Product;

        $product->category_id       = $request->category_id;
        $product->name              = $request->name;
        $product->price             = $request->price;
        $product->sku               = $request->sku;
        $product->status            = $request->status;
        $product->description       = $request->description;

        $image = $request->file('image')->store('uploads', 'public');

        $product->image             = $image;
        
        $simpan = $product->save();

        if($simpan){
            Session::flash('success', 'Data saved');
        } else {
            Session::flash('error', 'Insert failed');
        }
        return redirect()->route('product.index');

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
        $categories = Category::where('status', 'Active')->pluck('name', 'id');

        $product = Product::find($id);

        return view('admin.product.edit', compact('categories', 'product'));
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
        $rules = [
            'category_id'       => 'required',
            'name'              => 'required',
            'price'             => 'required',
            'sku'               => 'required',
            'status'            => 'required',
            'description'       => 'required',
            'image'             => 'mimes:jpg,png,jpeg,gif',
        ];

        $messages = [
            'category_id.required'      => 'Kategori wajib diisi',
            'name.required'             => 'Nama produk wajib diisi',
            'price.required'            => 'Harga produk wajib diisi',
            'sku.required'              => 'SKU / Kode Produk wajib diisi',
            'status.required'           => 'Status wajib diisi',
            'description.required'      => 'Deskripsi wajib diisi',
            'image.mimes'               => 'Gambar hanya boleh bertipe jpg, png, jpeg dan gif',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $product        = Product::find($id);

        $product->category_id       = $request->category_id;
        $product->name              = $request->name;
        $product->price             = $request->price;
        $product->sku               = $request->sku;
        $product->status            = $request->status;
        $product->description       = $request->description;

        if(!empty($request->file('image'))){
            unlink('storage/'.$product->image);
            $image = $request->file('image')->store('uploads', 'public');
            $product->image = $image;
        }

        $update = $product->save();

        if($update){
            Session::flash('success', 'Data updated');
        } else {
            Session::flash('error', 'Updated failed');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product        = Product::find($id);
        unlink('storage/'.$product->image);
        
        $delete = $product->delete();

        if($delete){
            Session::flash('success', 'Data deleted');
        } else {
            Session::flash('error', 'Deleted failed');
        }
    }
}
