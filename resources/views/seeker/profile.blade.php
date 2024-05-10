@extends('layouts.main')
@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <form action="{{ route('profiles.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
          <div class="form-group">
            <label for="logo">Profile Image</label><br>
            <img class="img-preview img-fluid mb-3 col-sm-6 max-w-36"
                 src="/storage/{{ auth()->user()->profile_pic }}" alt=""><br>
            <input type="file" class="form-control" id="logo" accept="/image/*" name="profile_pic"
                   onchange="previewImage()">
            <p class="text-xs text-gray-500 mt-1">Maximun file size: 2MB</p>
          </div>

          <div class="form-group mt-2">
            <label for="name">Your Name</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group mt-5">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </form>
    </div>

    <div class="row justify-content-center mt-4">
      <h2 class="text-gray-500 font-sans font-bold">Upload Resume</h2>
      <form action="{{ route('upload.resume') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
          <div class="form-group mt-2">
            <label for="name">Current Password</label>
            <input id="name" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @if ($errors->has('current_password'))
              <span class="text-danger font-sans font-light text-red-600">{{ $errors->first('current_password') }}</span>
            @endif
          </div>
          <div class="form-group mt-2">
            <label for="name">New Password</label>
            <input id="name" name="password" type="password" class="form-control" autocomplete="password">
            @if ($errors->has('password'))
              <span class="text-danger font-sans font-light text-red-600">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group mt-2">
            <label for="name">Confirmation Password</label>
            <input id="name" name="confirmation_password" type="password" class="form-control" autocomplete="confirmation_password">
            @if ($errors->has('confirmation_password'))
              <span class="text-danger font-sans font-light text-red-600">{{ $errors->first('confirmation_password') }}</span>
            @endif
          </div>
          <div class="form-group my-5">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </form>

      <form action="{{ route('user.password') }}" method="post">
        @csrf
        <div class="col-md-8">
          <div class="form-group">
            <label for="resume">Profile Image</label><br>
            <input type="file" class="form-control" id="resume" name="resume">
          </div>
          <div class="form-group mt-3 mb-5">
            <button type="submit" class="btn btn-success">Upload</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    function previewImage() {
      const image = document.querySelector('#logo')
      const imagePreview = document.querySelector('.img-preview')

      imagePreview.style.display = 'block'

      const oFReader = new FileReader()
      oFReader.readAsDataURL(image.files[0])

      oFReader.onload = function (oREvent) {
        imagePreview.src = oREvent.target.result
      }
    }
  </script>
@endsection
