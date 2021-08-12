@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Companies</div>
                <div class="card-body">
                    @if (Session::has('message'))
                    <div class="alert alert-success"><strong>Info:</strong> {{ Session::get('message') }}</div>
                    @endif
                    <a class="btn btn-success" href="{{route('companies.create')}}"><i class="fa fa-plus-circle"></i> Add new company</a>
                    <div class="card mt-3">
                        <div class="card-header">Companies list</div>
                        <div class="card-body">
                            @if(count($companies) > 0)
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Website</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $i=>$company)
                                    <tr>
                                        <th scope="row">{{ $i + 1 }}</th>
                                        <td><img class="img-thumbnail" width="40" src="{{asset('storage/'.$company->logo.'')}}" onError="this.onerror=null;this.src='{{asset('img/default-placeholder.png')}}';"></td>
                                        <td>{{$company->name}}</td>
                                        <td>{{$company->email}}</td>
                                        <td>{{$company->website}}</td>
                                        <td>
                                            <a class="btn btn-light btn-sm" href="{{url('companies/'.$company->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a>
                                            {{ Form::open(array('url' => 'companies/' . $company->id, 'style' => 'display: contents;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'confirmDlt()')) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $companies->links('pagination::bootstrap-4') !!}
                            </div>
                            @else
                            <div class="alert alert-info"> No Companies added yet!</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection