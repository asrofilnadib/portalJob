@extends('admin.main')
@section('content')
  {{--<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-3">
        <div class="card-counter primary">
          <p class="text_center mt-3 lead">User Profile</p>
          <button class="btn btn-primary float-end">View</button>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-counter danger">
          <p class="text_center mt-3 lead">Post Job</p>
          <button class="btn btn-danger float-end">View</button>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-counter success">
          <p class="text_center mt-3 lead">All Jobs</p>
          <button class="btn btn-success float-end">View</button>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card-counter info">
          <p class="text_center mt-3 lead">User Profile</p>
          <button class="btn btn-info float-end">View</button>
        </div>
      </div>
    </div>
  </div>--}}

  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Dashboard</h1>
      <p class="mb-0">Hello, {{ $user->name }}</p>
      <p class="text-sm">Your trial {{now()->format('Y-m-d') > $user->user_trials ? 'was expired' : 'will expired'}} on
        <strong>{{ $user->user_trials }}</strong></p>

      @if(Session::has('success'))
        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show">
          {{ Session::get('success') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(Session::has('cancel'))
        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show">
          {{ Session::get('cancel') }}
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(Session::has('error'))
        <div
          class="alert alert-warning text-dark border-0 alert-dismissible fade show">
          {{ Session::get('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">User Profile</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" href="#">View Details</a>
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-warning text-white mb-4">
            <div class="card-body">Post Job</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" href="#">View Details</a>
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-success text-white mb-4">
            <div class="card-body">All Jobs</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" href="#">View Details</a>
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-danger text-white mb-4">
            <div class="card-body">Danger Card</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" href="#">View Details</a>
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xl-6">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-chart-area me-1"></i>
              Area Chart Example
            </div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="40"></canvas>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-chart-bar me-1"></i>
              Bar Chart Example
            </div>
            <div class="card-body">
              <canvas id="myBarChart" width="100%" height="40"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

<style>
  .card-counter {
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 130px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter.primary {
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger {
    background-color: #ef5350;
    color: #FFF;
  }

  .card-counter.success {
    background-color: #66bb6a;
    color: #FFF;
  }

  .card-counter.info {
    background-color: #26c6da;
    color: #FFF;
  }
</style>
{{--<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>--}}
