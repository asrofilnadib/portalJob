@extends('layouts.main')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <img src="{{ Storage::url($listing->image) }}" class="card-img-top" style="height: 150px; object-fit: cover" alt="Cover Image">
          <div class="card-body">
            <h2 class="card-title">{{ $listing->title }}</h2>
            <span class="badge bg-primary">{{ strtoupper($listing->job_types) }}</span>

            <p class="card-text">Salary: Rp.{{ number_format($listing->salary) }}</p>
            <p class="card-text mt-2">Address: {{ $listing->address }}</p>

            <h4 class="mt-4">Description</h4>
            <p class="card-text">{!! $listing->description !!}</p>

            <h4>Roles and Responsibility</h4>
            {!! $listing->roles !!}

            <p class="card-text mt-4">Application Closing
              Date: {{ strftime('%e %B %Y', strtotime($listing->application_close_date)) }}</p>
            @if(!$listing->profile->resume)
              <a href="#" class="btn btn-primary mt-3">Apply Now</a>
            @else
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Apply
              </button>
            @endif
            {{-- Modal --}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <form action="{{ route('application.submit', [$listing->id]) }}" method="post">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Resume</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="file"/>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="btnApply">Save</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);

    pond.setOptions({
      server: {
        url: '/resume/upload',
        process: {
          method: 'POST',
          withCredentials: false,
          headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
          ondata: (formData) => {
            formData.append('file', pond.getFile()[0].file, pond.getFile()[0].file.name)
          },
          onload: (response) => {
            document.getElementById('btnApply').removeAttribute('disable')
          },
          onerror: (response) => {
            console.log('Error whil uploading...', response)
          },
        },
      },
    });
  </script>
@endsection
