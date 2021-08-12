@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit {{$employe->first_name}}</div>
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
                    {{ Form::model($employe, array('route' => array('employees.update', $employe->id), 'method' => 'PUT')) }}
                    @csrf
                    <input name="id" value="{{$employe->id}}" type="hidden">
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">First Name:<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="first_name" value="{{$employe->first_name}}" required placeholder="Enter first name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Last Name:<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="last_name" value="{{$employe->last_name}}" required placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Company:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="company_id">
                                @foreach($companies as $i=>$company)
                                <option value="{{$company->id}}" @if($company->id == $employe->company->id) selected @endif>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" value="{{$employe->email}}" placeholder="Enter company email address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Phone:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="phone" value="{{$employe->phone}}" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="form-group mt-5 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{url('employees')}}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection