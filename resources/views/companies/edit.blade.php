@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit {{$company->name}}</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{ Form::model($company, array('route' => array('companies.update', $company->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}
                    @csrf
                    <input name="id" value="{{$company->id}}" type="hidden">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Name:<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{$company->name}}" required placeholder="Enter company name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" value="{{$company->email}}" placeholder="Enter company email address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Logo:</label>
                        <div class="col-sm-10">
                            <small class="text-muted">(Minimum size 100×100)</small>
                            <input type="file" class="form-control" name="logo" accept="image/png, image/gif, image/jpeg" placeholder="Select company logo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Website:</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" name="website" value="{{ $company->website }}" placeholder="Enter company website URL">
                        </div>
                    </div>
                    <div class="form-group mt-5 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{url('companies')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    window.URL = window.URL || window.webkitURL;
    $("form").submit(function(e) {
        var form = this;
        e.preventDefault();
        var fileInput = $(this).find("input[type=file]")[0],
            file = fileInput.files && fileInput.files[0];
        if (file) {
            var img = new Image();
            img.src = window.URL.createObjectURL(file);
            img.onload = function() {
                var width = img.naturalWidth,
                    height = img.naturalHeight;
                window.URL.revokeObjectURL(img.src);
                if (width > 100 && height > 100) {
                    form.submit();
                } else {
                    alert("Logo is too small!");
                }
            };
        } else {
            form.submit();
        }
    });
</script>
@endsection