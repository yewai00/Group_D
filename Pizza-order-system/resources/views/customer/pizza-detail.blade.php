@extends('customer.layouts.app')
@section('content')
  <div class="pizza-detail container">
    <div class="pizza-detail-inner clearfix">
      <div class="left-detail">
        <div class="img-wrap">
          @if($pizza->buy_one_get_one == 'yes')
          <img src="{{ asset('img/buy1.png') }}" alt="buy-one-get-one" class="promo">
          @endif
          <img src="{{ asset('img/'.$pizza->image) }}" alt="" class="pizza-img">
        </div>
      </div>
      <div class="right-detail">
        <h5>{{ $pizza->name }}</h5>
        <p>{{ $pizza->description }}</p>
        <p>Price: <span class="price"><b>{{ $pizza->price }}</b> MMK</span></p>
        @if(Auth::check())
        <a href="{{ url('/add-item/'.$pizza->id) }}" class="btn-atc">Add To Cart</a>
        @endif
      </div>
    </div>
  </div>
  <footer>
    <div class="footer-inner">
      <h3><a href="#">Pizza Order System</a></h3>
      <p>&copy; 2022 Pizza Order System. All Right Reserved.</p>
      <p>Designed &amp; Developed By Group-D</p>
    </div>
  </footer>
@endsection
