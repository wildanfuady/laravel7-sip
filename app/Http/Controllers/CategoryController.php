<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        Session::flash('message', 'Data saved');

        return redirect()->route('categories.index');

    }

    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.category.index', compact('categories'));
    }

    public function show($id) // param
    {
        $category = Category::find($id);

        if (empty($category)) {
            die('Data not found');
        }

        return view('admin.category.show', compact('category'));
    }

    public function edit($id)
    {
        // mencari kategori yang idnya = $id di table categories
        $category = Category::find($id);

        // dd($category);

        if (empty($category)) { // apakah kategori kosong?
            die('Data not found'); // kalau kosong
        }
        // kalau datanya ada, mau ngapain?
        // 1. menampilkan halaman view
        // 2. mengirim data kategori yang sudah ditemukan ke dalam view detail
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // 1. menampikan data kategori yang id = $id
        $category = Category::find($id);

        $category->name = $request->name;
        $category->status = $request->status;

        $category->save();

        Session::flash('message', 'Data updated');

        return redirect()->route('categories.index');

    }

    public function destroy($id) // param
    {
        $category = Category::find($id);

        if (empty($category)) {
            die('Data not found');
        }
        // save() buat nyimpan / update
        // delete() menggunakan delete
        $category->delete();

        Session::flash('message', 'Data deleted');

        return redirect()->route('categories.index');
    }

}
