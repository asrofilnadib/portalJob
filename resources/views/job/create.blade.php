@extends('admin.main')
@section('content')
  <div class="container mb-5">
    <div class="row justify-content-center">
      @if(Session::has('postSuccess'))
        <div class="col-md-6 pt-4">
          <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
            {{ Session::get('postSuccess') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      @endif
      <div class="col-md-8 pt-3">
        <h1 class="text-2xl font-sans">Post a Job</h1>
        <form method="POST" action="{{ route('job.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group mt-2">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
          </div>
          @if($errors->has('title'))
            <div class="error"> {{ $errors->first('title') }} </div>
          @endif
          <div class="form-group mt-2">
            <label for="description">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
            <trix-editor input="description"></trix-editor>
          </div>
          @if($errors->has('description'))
            <div class="error"> {{ $errors->first('description') }} </div>
          @endif
          <div class="form-group mt-2">
            <label for="roles">Roles and Responsibility</label>
            <input id="roles" type="hidden" name="roles" value="{{ old('roles') }}">
            <trix-editor input="roles"></trix-editor>
          </div>
          @if($errors->has('roles'))
            <div class="error"> {{ $errors->first('roles') }} </div>
          @endif
          <div class="form-group mt-2">
            <label>Jobs Type</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="job_types" id="fulltime" value="fulltime" checked>
            <label class="form-check-label" for="exampleRadios1">
              Full Time
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="job_types" id="parttime" value="parttime" checked>
            <label class="form-check-label" for="exampleRadios1">
              Part Time
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="job_types" id="casual" value="casual" checked>
            <label class="form-check-label" for="exampleRadios1">
              Casual
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="job_types" id="contract" value="contract" checked>
            <label class="form-check-label" for="exampleRadios1">
              Contract
            </label>
          </div>
          @if($errors->has('job_type'))
            <div class="error"> {{ $errors->first('job_type') }} </div>
          @endif
          <div class="form-group mt-2">
            <label for="address" class="form-label">Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-6" alt="">
            <input class="form-control" id="image" name="image" type="file" onchange="previewImage()"
                   value="{{ old('image') }}">
          </div>
          @if($errors->has('image'))
            <div class="error"> {{ $errors->first('image') }} </div>
          @endif
          <div class="form-group mt-2">
            <label for="address">Address</label>
            <input class="form-control" id="address" name="address" type="text" value="{{ old('address') }}">
          </div>
          @if($errors->has('address'))
            <div class="error"> {{ $errors->first('address') }} </div>
          @endif
          <div class="form-group mt-2">
            <label for="address">Salary</label>
            <input class="form-control" id="salary" name="salary" type="text" value="{{ old('salary') }}">
          </div>
          @if($errors->has('salary'))
            <div class="error"> {{ $errors->first('salary') }} </div>
          @endif
          <div class="form-group mt-2">
            <label for="roles">Closing Application Date</label>
            <input class="form-control" id="datepicker" name="date" type="date" value="{{ old('date') }}">
          </div>
          @if($errors->has('date'))
            <div class="error"> {{ $errors->first('date') }} </div>
          @endif
          <div class="form-group mt-5">
            <button type="submit" class="btn btn-success">Post a Job</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    function previewImage() {
      const image = document.querySelector('#image')
      const imagePreview = document.querySelector('.img-preview')

      imagePreview.style.display = 'block'

      const oFReader = new FileReader()
      oFReader.readAsDataURL(image.files[0])

      oFReader.onload = function (oREvent) {
        imagePreview.src = oREvent.target.result
      }
    }
  </script>
  <script>
    $(function () {
      $("#datepicker").datepicker();
      $(".summernote").summernote();
    });
  </script>
  <style>
    .error {
      color: red;
      font-weight: bold;
    }
  </style>
@endsection
