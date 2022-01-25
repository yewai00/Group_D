<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizza order system</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cust/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cust/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user_auth.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="{{ asset('js/libraries/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
  <header>
    <div class="container">
      <div class="nav-wrap clearfix">
        <h1 class="logo"><a href="/">Pizza Order System</a></h1>
        <nav class="nav">
          <div class="humburger">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <ul class="clearfix">
            <li class="nav-list"><a href="/#">Home</a></li>
            <li class="nav-list"><a href="/#pizza-list">Pizza</a></li>
            <li class="nav-list"><a href="/#contact-us">Contact Us</a></li>
            @guest
            <li class="nav-list"><a href="{{ route('register.get') }}">Register</a></li>
            <li class="nav-list"><a href="{{ url('login') }}" class="login">Login</a></li>
            @else
            <li class="nav-list"><a href="">Cart(0)</a></li>
            <li class="nav-list"><a href="{{ url('logout') }}" class="login">Logout</a></li>
            @endguest
          </ul>
        </nav>
      </div>
    </div>
    <!-- ./container -->
  </header>
  <!-- header -->
  <div class="content">
        @yield('content')
    </div>
</body>
</html>
