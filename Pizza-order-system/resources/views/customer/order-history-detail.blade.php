@extends('customer.layouts.app')

@section('content')
  <div class="p-cart container">
    <div class="cart-inner">
    <div class="cart-header clearfix">
        <h4 class="fl">Order #{{ $id }}</h4>
      </div>
        <div class="cart-list">
          @foreach($historyDetail as $hd)
          <div class="cart-item clearfix">
            <div class="left-cart-item">
              <div class="img-wrap">
                @if($hd->b1g1 == 'yes')
                  <img src="{{ asset('img/buy1.png') }}" alt="buy-one-get-one" class="promo">
                @endif
                <img src="{{ asset('img/'.$hd->image) }}" alt="pizza" class="cart-pizza">
              </div>
            </div>
            <div class="right-cart-item clearfix">
              <div class="l-blk">
                <h5>{{ $hd->name }}</h5>
                <div class="qty-box">{{ $hd->qty }} @if($hd->qty > 1) pizzas @else pizza @endif</div>
              </div>
              <div class="r-blk pcenter">
                <p><span class="price"><b>{{ $hd->price }}</b> MMK</span></p>
              </div>
            </div>
          </div>
          <!-- cart-item -->
          <!-- sone -->
          @endforeach
        </div>
        <!-- cart-list -->
        <div class="total">
          <p>Total Price: <span class="price"> <b>{{ $totalPrice }}</b> MMK </span></p>
        </div>
        <div class="order clearfix"><a href="{{ url('/order-history/') }}" class="login">Back</a></div>
    </div>
  </div>
@endsection
