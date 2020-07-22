@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf
                    {{-- Menampilkan _method dengan value PUT --}}
                    <input name="_method" type="hidden" value="PUT">
                    
                    <div class="card-header">
                        <h3 class="card-title">Edit Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="name" id="" class="form-control" value="{{ $category->name }}" placeholder="Name...">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" name="status" class="form-control" value="{{ $category->status }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" href="{{ route('categories.update', $category->id) }}" class="btn btn-info float-right">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
