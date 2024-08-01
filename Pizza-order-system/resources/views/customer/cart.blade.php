@extends('customer.layouts.app')

@section('content')
  <div class="p-cart container">
    <div class="cart-inner">
      <div class="cart-header clearfix">
        <h4 class="left-cart-header">Cart</h4>
        @if(Session::get('cart') != null)
        <div class="right-cart-header"><a href="session-destroy" class="remove-item"> Remove All Pizza</a></div>
        @endif
      </div>
      @if(Session::get('cart') != null)
        <div class="cart-list">
          @foreach($pizzas as $pizza)
          <div class="cart-item clearfix">
            <div class="left-cart-item">
              <div class="img-wrap">
                @if($pizza['item']['buy_one_get_one'] === 'yes')
                  <img src="{{ asset('img/buy1.png') }}" alt="buy-one-get-one" class="promo">
                @endif
                <img src="img/{{$pizza['item']['image']}}" alt="pizza" class="cart-pizza">
              </div>
            </div>
            <div class="right-cart-item clearfix">
              <div class="l-blk">
                <h5>{{ $pizza['item']['name'] }}</h5>
                <div class="qty-box" data-id="">
                <a href="/minus-item/{{ $pizza['item']['id'] }}" class="minus"></a>
                <input type="text" class="pizza-qty" value="{{ $pizza['qty'] }}" readonly>
                <a href="/add-item/{{ $pizza['item']['id'] }}" class="plus"></a>
                </div>
              </div>
              <div class="r-blk">
                <p><span class="price"><b>{{ $pizza['price'] }}</b> MMK</span></p>
                <a href="/delete-item/{{ $pizza['item']['id'] }}" class="remove-item"> Remove Item </a>
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
        <div class="order clearfix"><a href="/order" class="login">ORDER</a></div>
      @else
        <p class="no-data">There is no item in cart.</p>
      @endif
    </div>
  </div>
@endsection
