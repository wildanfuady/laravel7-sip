@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">Create Category</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label for="">Name</label>
                          <input type="text" name="name" id="" class="form-control" placeholder="Name...">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control" id="">
                                <option value="">Choose Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Save</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
@endsection
