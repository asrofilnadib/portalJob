@extends('admin.main')
@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <form action="{{ route('profiles.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-8">
          <div class="form-group">
            <label for="logo">Logo</label>
            <img class="img-preview img-fluid mb-3 col-sm-6" alt="">
            <input type="file" class="form-control" id="logo" name="profile_pic" onchange="previewImage()">
          </div>
          <div class="form-group mt-3">
            <label for="name">Company Name</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group mt-5">
            <button type="submit" class="btn btn-success">Save</button>
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
