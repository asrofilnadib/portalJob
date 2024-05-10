@extends('admin.main')
@section('content')
  <div class="container mt-5">
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
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
              <th>Title</th>
              <th>Created On</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($jobs as $job)
              <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->created_at->format('Y-m-d') }}</td>
                <td><a href="{{ route('job.edit', [ $job->id ]) }}">Edit</a></td>
                <td><a href="#" data-bs-toggle="modal"
                       data-bs-target="#posting{{ $job->slug }}">Delete</a></td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="posting{{ $job->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                   aria-hidden="true">
                <form action="{{ route('job.delete', [$job->id]) }}" method="post">
                  @method('DELETE')
                  @csrf
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Post</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure want to delete this post?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Save changes</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
