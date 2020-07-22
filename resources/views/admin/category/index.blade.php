@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Categories
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('categories.create') }}" class="btn btn-tool">
                                <i class="fa fa-plus"></i>&nbsp; Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i>
                                {!! Session::get('message') !!}
                            </div>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php $no = 1 @endphp
                            @foreach ($categories as $item)
                                <tbody>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <form action="{{ route('categories.delete', $item->id) }}" method="post">
                                                <input name="_method" type="hidden" value="DELETE">
                                                @csrf
                                                <div class="btn-group" role="group" aria-label="Button group">
                                                    <a href="{{ route('categories.show', $item->id) }}" class="btn btn-info btn-sm" style="color: #fff"><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-warning btn-sm" style="color: #fff"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" onclick="return confirm('Yakin mau hapus??')" class="btn btn-danger btn-sm" style="color: #fff"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
