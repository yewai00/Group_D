<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,  initial-scale=1.0" />
  <title>Pizza Order System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="{{ asset('js/libraries/chart.min.js') }}"></script>
  <script src="{{ asset('js/libraries/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>

  <div class="nav clearfix">
    <h1>
      <a href="#"><i class="fas fa-pizza-slice"></i> Pizza Order System </a>
    </h1>
    <div class="menu-btn right">
      <div class="menu-burger"></div>
    </div>
  </div>
  <div class="container clearfix">
    <div class="aside">
      <ul class="menu">
        <a href="{{ route('admin.profile') }}" id="profile" class="nav-active">
          <li>
            <i class="far fa-user-circle"></i>
            <span> My Profile</span>
          </li>
        </a>
        <a href="{{ route('admin.new') }}" id="new">
          <li>
            <i class="far fa-plus-square"></i>
            <span>New Admin</span>
          </li>
        </a>
        <a href="{{ route('category.index') }}" id="category">
          <li>
            <i class="far fa-list-alt"></i>
            <span>Categories</span>
          </li>
        </a>
        <a href="{{ route('pizza.list') }}" id="pizza">
          <li>
            <i class="fas fa-pizza-slice"></i>
            <span>Pizzas</span>
          </li>
        </a>
        <a href="{{ route('order.list') }}" id="order">
          <li>
            <i class="fas fa-receipt"></i>
            <span>Orders</span>
          </li>
        </a>
        <a href="{{ route('riders.index') }}" id="rider">
          <li>
            <i class="fas fa-bicycle"></i>
            <span>Riders</span>
          </li>
        </a>
        <a href="{{ route('users.list','0') }}" id="user">
          <li>
            <i class="fas fa-users"></i>
            <span>Users</span>
          </li>
        </a>
        <a href="{{ route('graph') }}" id="graph">
          <li>
            <i class="fas fa-chart-bar"></i>
            <span>Sale Graph</span>
          </li>
        </a>
        <a href="{{ route('logout') }}">
          <li>
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
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
