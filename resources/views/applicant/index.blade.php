{{--@dd($applicants)--}}
@extends('admin.main')
@section('content')
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          {{ auth()->user()->name }} Table Job
          @if(Session::has('successDelete'))
            <div class="col-md-12">
              <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                {{ Session::get('successDelete') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
              </div>
            </div>
          @endif
        </div>
        <div class="card-body">
          <table id="datatablesSimple">
            <thead>
            <tr>
              <th>Title</th>
              <th>Created On</th>
              <th>Total Aplicant</th>
              <th>View Job</th>
              <th>View Applicant</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
              <th>Title</th>
              <th>Created On</th>
              <th>Total Aplicant</th>
              <th>View Job</th>
              <th>View Applicant</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($listings as $listing)
              <tr>
                <td>{{ $listing->title }}</td>
                <td>{{ $listing->created_at->format('Y-m-d') }}</td>
                <td>{{ $listing->users()->count() }}</td>
                <td><a href="#">View</a></td>
                <td><a href="{{ route('applicant.show', $listing->slug) }}">View</a></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
