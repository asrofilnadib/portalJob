<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-dark shadow-lg" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        @if(auth()->check())
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('profile.seeker') }}">Profile</a>
          </li>
        @endif
        @if(!auth()->check() || auth()->user()->user_type == 'employer')
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('subscribe') }}">Subscribe</a>
          </li>
        @endif

        @if(!auth()->check())
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Register</a>
          </li>
        @else
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="nav-link active" aria-current="page">Logout</button>
            </form>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
  FilePond.parse(document.body);
</script>

</body>
</html>
