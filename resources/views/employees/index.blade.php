@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>
                <div class="card-body">
                    @if (Session::has('message'))
                    <div class="alert alert-success"><strong>Info:</strong> {{ Session::get('message') }}</div>
                    @endif
                    <a class="btn btn-success" href="{{route('employees.create')}}"><i class="fa fa-plus-circle"></i> Add new employe</a>
                    <div class="card mt-3">
                        <div class="card-header">Employees list</div>
                        <div class="card-body">
                            @if(count($employees) > 0)
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $i=>$employ)
                                    <tr>
                                        <th scope="row">{{ $i + 1 }}</th>
                                        <td>{{$employ->first_name}} {{$employ->last_name}}</td>
                                        <td>{{$employ->company->name}}</td>
                                        <td>{{$employ->email}}</td>
                                        <td>{{$employ->phone}}</td>
                                        <td>
                                            <a class="btn btn-light btn-sm" href="{{url('employees/'.$employ->id.'/edit')}}"><i class="fa fa-edit"></i> Edit</a>
                                            {{ Form::open(array('url' => 'employees/' . $employ->id, 'style' => 'display: contents;')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-sm', 'onclick' => 'confirmDlt()')) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $employees->links('pagination::bootstrap-4') !!}
                            </div>
                            @else
                            <div class="alert alert-info"> No employees added yet!</div>
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