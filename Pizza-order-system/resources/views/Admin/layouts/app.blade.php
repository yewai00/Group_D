<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pizza Order System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/riders/riders.css') }}">
  <script src="{{ asset('js/libraries/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
  <div class="nav clearfix">
    <h1>
      <a href="#"> Pizza Order System </a>
    </h1>
  </div>
  <div class="container clearfix">
    <div class="aside">
      <ul class="menu">
        <a href="#" id="profile" class="nav-active">
          <li>
            <i class="far fa-user-circle"></i>
            My Profile
          </li>
        </a>
        <a href="#" id="category">
          <li>
            <i class="far fa-list-alt"></i>
            Categories
          </li>
        </a>
        <a href="{{ route('admin.pizza.list') }}" id="pizza">
          <li>
            <i class="fas fa-pizza-slice"></i>
            Pizzas
          </li>
        </a>
        <a href="#" id="order">
          <li>
            <i class="fas fa-receipt"></i>
            Orders
          </li>
        </a>
        <a href="#" id="rider">
          <li>
            <i class="fas fa-bicycle"></i>
            Riders
          </li>
        </a>
        <a href="#" id="graph">
          <li>
            <i class="fas fa-chart-bar"></i>
            Sale Graph
          </li>
        </a>
        <a href="#">
          <li>
            <i class="fas fa-sign-out-alt"></i>
            Logout
          </li>
        </a>
      </ul>
    </div>
    <div class="content">
      @yield('content')
    </div>
  </div>
</body>

</html>
