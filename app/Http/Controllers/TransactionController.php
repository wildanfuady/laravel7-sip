<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Excel;
use App\Transaction;
use App\Imports\TransactionImport;

class TransactionController extends Controller
{
    public function index()
    {
        # code...
    }

    public function create()
    {
        return view('admin.transaction.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'file_excel'             => 'required|mimes:xls,xlsx',
        ];

        $messages = [
            'file_excel.required'      => 'File wajib diisi',
            'file_excel.mimes'         => 'Gambar hanya boleh bertipe xls, xlsx',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $path = $request->file('file_excel')->getRealPath();

        $data = Excel::import(new TransactionImport, $path);

        return redirect()->route('transaction.index')->with('success', 'Transaction imported successfully.');

    }
}
