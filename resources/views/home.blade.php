@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
          <div class="container">
            <div class="card-deck mb-3 text-center">
              <div class="card mb-6 box-shadow">
                <div class="card-body">
                  <h1 class="card-title pricing-card-title"><i class='fa fa-briefcase text-muted'></i> {{$companies}}</h1>
                  <p>Total Active Companies</p>
                  <a href="{{route('companies.create')}}" class="btn btn-block btn-outline-primary"><i class="fa fa-plus-circle"></i> Add New Company</a>
                </div>
              </div>
              <div class="card mb-6 box-shadow">
                <div class="card-body">
                  <h1 class="card-title pricing-card-title"><i class="fa fa-users text-muted"></i> {{$employees}}</h1>
                  <p>Total Active Employees</p>
                  <a href="{{route('employees.create')}}" class="btn btn-block btn-outline-primary"><i class="fa fa-plus-circle"></i> Add New Employe</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection