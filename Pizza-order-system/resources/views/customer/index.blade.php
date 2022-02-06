@extends('customer.layouts.app')
@section('content')
<section class="bnr">
  <div class="container">
    <div class="bnr-inner clearfix">
      <div class="bnr-left">
        <div class="bnr-left-inner">
          <h2>WE HAVE THE <br> BEST PIZZA</h2>
          <p>Hey! Our Delicious Pizza is waiting for you, we are <br> always near to you with fresh ingredients.</p>
          <a href="#pizza-list" class="btn-cta">Order Now</a>
        </div>
      </div>
      <!-- ./bnr-left -->
      <div class="bnr-right">
        <img src="../img/pizza-bnr.png" alt="">
      </div>
      <!-- ./bnr-right -->
    </div>
    <!-- ./container -->
</section>
<!-- ./bnr -->
<section id="pizza-list">
  <div class="container">
    <div class="pizza-list-inner">
      <h3 class="h3-header">Our Pizza List</h3>
      <p class="pizza-list-text">We offer recipes that are hand-crafted by our chef</p>
      <p class="pizza-list-smtext">We make it fresh. You bake it to perfection.</p>
      <form action="{{ route('user.pizza.search') }}" method="get">
        <div class="filter clearfix">
          <div class="filter-left">
            <label for="select-box">Category:</label>
            <select name="category_id" id="select-box" class="select-style">
              <option value="">All</option>
              @foreach($categories as $c)
              <option value="{{ $c->id }}">{{ $c->name }}</option>
              @endforeach
            </select>
            <label for="">Name:</label>
            <input type="text" class="text-box" name="name">
            <div class="sp-block">
              <label for="">Min price:</label>
              <input type="text" class="text-box" name="min_price">
              <label for="">Max price:</label>
              <input type="text" class="text-box" name="max_price">
            </div>
            <button class="btn-submit" type="submit">Search</button>
          </div>
        </div>
        <!-- ./filter -->
      </form>
      <div class="list clearfix">
        <div class="list-inner clearfix">
          @foreach($pizzas as $pizza)
          <div class="list-box">
            <div class="list-box-inner">
              <div class="pizza-img-wrap">
                @if($pizza->buy_one_get_one == 'yes')
                <img src="{{ asset('img/buy1.png') }}" alt="buy-one-get-one" class="buy-one">
                @endif
                <img src="{{ asset('img/'.$pizza->image) }}" alt="" class="show-pizza">
              </div>
              <h5>{{ $pizza->name }}</h5>
              <p>Price: <span class="price"><b>{{ $pizza->price }}</b> MMK</span></p>
              <a href="{{ url('pizza-detail/'.$pizza->id) }}" class="detail">View</a>
            </div>
          </div>
          <!-- ./list-box -->
          @endforeach
        </div>
        <span class="paginate"> {{ $pizzas->links() }} </span>
      </div>
      <!-- ./list -->
    </div>
  </div>
</section>
<!-- ./pizza-list -->
<section id="contact-us">
  <div class="container">
    <h3 class="h3-header">Contact Us</h3>
    <div class="contact-us-inner clearfix">
      <div class="c-box">
        <div class="c-box-inner">
          @if(Session::has('message'))
          <div class="alert clearfix">
            <span>
              {{ Session::get('message') }}
            </span>
            <i class="fas fa-times close-btn"></i>
          </div>
          @endif
          <form action="{{ route('contact.mail') }}" method="post">
            @csrf
            <label for="subject" class="mt-20">Subject</label>
            <input type="text" name="subject" id="subject">
            @if ($errors->has('subject'))
            <small class="error">{{ $errors->first('subject') }}</small><br>
            @endif
            <label for="message" class="mt-20">Message</label>
            <textarea name="message" id="message" cols="30" rows="5"></textarea>
            @if ($errors->has('message'))
            <small class="error">{{ $errors->first('message') }}</small><br>
            @endif
            <button class="btn-submit mt-20">Submit</button>
          </form>
        </div>
      </div>
      <!-- ./c-box -->
      <div class="c-box">
        <div class="c-box-inner">
          <h4>Contact Info</h4>
          <ul>
            <li class="address">
              <p>No.(56), Mya Thidar Street, Pyay Road, Hlaing Thar Yar Township, Yangon</p>
            </li>
            <li class="ph">
              <p>(+95) 9 258 369 147, (+95) 9 452 159 687</p>
            </li>
            <li class="email">
              <p>yourname@domain.com</p>
            </li>
          </ul>
        </div>
      </div>
      <!-- ./c-box -->
      <div class="c-box">
        <div class="c-box-inner">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1909.1888642583708!2d96.06402713405248!3d16.857199076264003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1bfd9da6faf03%3A0xa52691144965bf96!2sMyanmar%20(Barmar)!5e0!3m2!1sen!2smm!4v1642669754373!5m2!1sen!2smm" width="500" height="310" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
</section>
<footer>
  <div class="footer-inner">
    <h3><a href="#">Pizza Order System</a></h3>
    <p>&copy; 2022 Pizza Order System. All Right Reserved.</p>
    <p>Designed & Developed By Group-D</p>
  </div>
</footer>
@endsection
