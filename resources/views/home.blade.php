@extends('layouts.main')
@section('content')
  <div class="container mt-5">
    <div class="d-flex justify-content-between">
      <h4>Recomend Jobs</h4>
      <div class="btn btn-dark">View</div>
    </div>
    <div class="row mt-2 g-1">
      @foreach($jobs as $job)
        <div class="col-md-3">
          <div class="card p-2">
            <div class="text-right">
              <small class="badge text-bg-info">{{ $job->job_types }}</small>
            </div>
            <div class="text-center mt-2 p-3">
              <img src="{{ Storage::url($job->image) }}" class="rounded-circle mb-2" width="100" alt=""><br>
              <span class="d-block font-weight-bold">{{ $job->title }}</span>
              <hr>
              <span>{{ $job->profile->name }}</span>
              <div class="d-flex flex-row align-items-center justify-content-center">
                <small class="ml-1">{{ $job->address }}</small>
              </div>
              <div class="d-flex justify-content-between mt-3">
                <span class="items-center">Rp.{{ number_format($job->salary, 2) }}</span>
                <a href="{{ route('job.show', [$job->slug]) }}">
                  <button class="btn btn-sm btn-outline-dark">Apply Now</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <style>
    .card:hover {
      background-color: #eaeaea;
    }
  </style>
@endsection
