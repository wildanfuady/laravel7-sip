@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Products
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('product.create') }}" class="btn btn-tool">
                                <i class="fa fa-plus"></i>&nbsp; Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i>
                                {!! Session::get('success') !!}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                <i class="fa fa-check"></i>
                                {!! Session::get('error') !!}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pilih Category</label>
                                    {{ Form::select('category_id', $categories, $category, ['class' => 'form-control', 'placeholder' => 'Pilih Category', 'id' => 'category_id']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Keyword</label>
                                    {{ Form::text('keyword', $keyword, ['class' => 'form-control', 'placeholder' => 'Masukan Keyword', 'id' => 'keyword']) }}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>SKU</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php 
                                $page = isset($_GET['page']) == null ? 1 : $_GET['page'];
                                $page = ($page - 1) * $paginate;
                                @endphp
                                @foreach ($products as $item)
                                    <tbody>
                                        <tr>
                                            <td>{{ ++$page }}</td>
                                            <td>{{ $item->category_name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->sku }}</td>
                                            <td><img src="{{ asset('storage/'.$item->image) }}" width="150px"></td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <form action="{{ route('product.destroy', $item->id) }}" method="post">
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    @csrf
                                                    <div class="btn-group" role="group" aria-label="Button group">
                                                        <a href="{{ route('product.show', $item->id) }}" class="btn btn-info btn-sm" style="color: #fff"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning btn-sm" style="color: #fff"><i class="fa fa-edit"></i></a>
                                                        <button type="submit" onclick="return confirm('Yakin mau hapus??')" class="btn btn-danger btn-sm" style="color: #fff"><i class="fa fa-trash"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{ $products->appends($_GET)->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    
    $("#category_id").on('change', function(){
        filter();
    });

    $("#keyword").keypress(function(event){
        if(event.keyCode == 13){
            filter();
        }
    });

    var filter = function(){
        var catId = $("#category_id").val();
        var keyword = $("#keyword").val();

        window.location.replace("{{ URL::to('product') }}?category_id=" + catId + "&keyword="+keyword);
    }

});
</script>
@endsection
