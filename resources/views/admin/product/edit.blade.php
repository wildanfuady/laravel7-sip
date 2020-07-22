@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    {{ Form::model($product, ['method' => 'PATCH','route' => ['product.update', $product->id], 'files' => true]) }}

                    <div class="card-header">
                        <h3 class="card-title">Edit Product</h3>
                    </div>
                    <div class="card-body">

                        @if(session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Terdapat kesalahan saat input data. Cek form yang Anda inputkan terlebih dahulu.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="">Pilih Category</label>
                                    {{ Form::select('category_id', $categories, $product->category_id, ['class' => 'form-control', 'placeholder' => 'Pilih Category']) }}
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Name</label>
                                    {{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Nama Produk']) }}
                                </div>

                                <div class="form-group">
                                    <label for="">Price</label>
                                    {{ Form::number('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Harga Produk']) }}
                                </div>
                            
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="">SKU / Kode Produk</label>
                                    {{ Form::text('sku', $product->sku, ['class' => 'form-control', 'placeholder' => 'SKU / Kode Produk']) }}
                                </div>

                                <div class="form-group">
                                    <label for="">Pilih Status</label>
                                    {{ Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $product->status, ['class' => 'form-control', 'placeholder' => 'Pilih Status']) }}
                                    {{-- <option value="Active">Activ</option> --}}
                                </div>

                                <div class="form-group">
                                    <label for="">Gambar</label>
                                    <br>
                                    <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid">
                                    <br>
                                    <label for="">Ubah Gambar</label>
                                    {{ Form::file('image', ['class' => 'form-control']) }}
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Deskripsi</label>
                                {{ Form::textarea('description', $product->description, ['class' => 'form-control',  'rows '=> 4, 'placeholder' => 'Deskripsi Produk']) }}
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>  Update</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
@endsection
