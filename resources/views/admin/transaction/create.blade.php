@extends('admin.template.admin')

@section('content')
    <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{ Form::open(['route' => 'transaction.store', 'files' => true]) }}
                    <div class="card-header">
                        <h3 class="card-title">Import Transaction</h3>
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
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="">File Excel</label>
                                    {{ Form::file('file_excel', ['class' => 'form-control']) }}
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Import</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
@endsection
