@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Show Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="name" id="" class="form-control" value="{{ $category->name }}" placeholder="Name..." disabled readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" class="form-control" value="{{ $category->status }}" disabled readonly>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-default">Back</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
