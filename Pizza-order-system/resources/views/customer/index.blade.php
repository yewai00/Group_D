@extends('customer.layouts.app')
@section('content')
  <section class="bnr">
    <div class="container">
      <div class="bnr-inner clearfix">
        <div class="bnr-left">
          <div class="bnr-left-inner">
            <h2>WE HAVE THE <br> BEST PIZZA</h2>
            <p>Hey! Our Delious Pizza is waiting for you, we are <br> always near to you with fresh ingredients.</p>
            <a href="#pizza-list" class="btn-cta">Order Now</a>
          </div>
        </div>
        <!-- ./bnr-left -->
        <div class="bnr-right">
          <img src="img/pizza-bnr.png" alt="">
        </div>
        <!-- ./bnr-right -->
      </div>
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
        <form action="#">
          <div class="filter clearfix">
            <div class="filter-left">
              <label for="select-box">Choose Category:</label>
              <select name="select-box" id="select-box" class="select-style">
                <option value="s">Pepperoni</option>
                <option value="">Pepperoni</option>
                <option value="">Pepperoni</option>
                <option value="">Pepperoni</option>
                <option value="">Pepperoni</option>
              </select>
            </div>
            <div class="filter-right">
              <label for="">Name:</label>
              <input type="text" class="text-box">
              <label for="">Min price:</label>
              <input type="text" class="text-box">
              <label for="">Max price:</label>
              <input type="text" class="text-box">
              <input type="submit" value="search" class="btn-submit">
            </div>
          </div>
          <!-- ./filter -->
        </form>
        <div class="list">
          <div class="list-inner clearfix">
            <div class="list-box">
              <div class="list-box-inner">
                <div class="pizza-img-wrap">
                  <img src="img/Pepperoni.jpg" alt="">
                </div>
                <h5>Pepperoni</h5>
                <p>Price: <span class="price"><b>10000</b> MMK</span></p>
                <a href="" class="detail">View</a>
              </div>
            </div>
            <!-- ./list-box -->
            <div class="list-box">
              <div class="list-box-inner">
                <div class="pizza-img-wrap">
                  <img src="img/korea_surf_turf.jpg" alt="">
                </div>
                <h5>Pepperoni</h5>
                <p>Price: <span class="price"><b>10000</b> MMK</span></p>
                <a href="" class="detail">View</a>
              </div>
            </div>
            <!-- ./list-box -->
            <div class="list-box">
              <div class="list-box-inner">
                <div class="pizza-img-wrap">
                  <img src="img/Bulgogi-pizza-2.jpg" alt="">
                </div>
                <h5>Pepperoni</h5>
                <p>Price: <span class="price"><b>10000</b> MMK</span></p>
                <a href="" class="detail">View</a>
              </div>
            </div>
            <!-- ./list-box -->
            <div class="list-box">
              <div class="list-box-inner">
                <div class="pizza-img-wrap">
                  <img src="img/mango_pizza.jpg" alt="">
                </div>
                <h5>Pepperoni</h5>
                <p>Price: <span class="price"><b>10000</b> MMK</span></p>
                <a href="" class="detail">View</a>
              </div>
            </div>
            <!-- ./list-box -->
            <div class="list-box">
              <div class="list-box-inner">
                <div class="pizza-img-wrap">
                  <img src="img/Pepperoni.jpg" alt="">
                </div>
                <h5>Pepperoni</h5>
                <p>Price: <span class="price"><b>10000</b> MMK</span></p>
                <a href="" class="detail">View</a>
              </div>
            </div>
            <!-- ./list-box -->
            <div class="list-box">
              <div class="list-box-inner">
                <div class="pizza-img-wrap">
                  <img src="img/korea_surf_turf.jpg" alt="">
                </div>
                <h5>Pepperoni</h5>
                <p>Price: <span class="price"><b>10000</b> MMK</span></p>
                <a href="" class="detail">View</a>
              </div>
            </div>
            <!-- ./list-box -->
          </div>
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
           <form action="">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject">
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
            <input type="submit" value="submit" class="btn-submit">
           </form>
         </div> 
        </div>
        <!-- ./c-box -->
        <div class="c-box">
         <div class="c-box-inner">
           <h4>Contact info</h4>
           <ul>
             <li class="address">
               <p>No.(56), Mya Thidar Street, Pyay Road,Hlaing Thar Yar Township, Yangon</p>
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
         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1909.1888642583708!2d96.06402713405248!3d16.857199076264003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1bfd9da6faf03%3A0xa52691144965bf96!2sMyanmar%20(Barmar)!5e0!3m2!1sen!2smm!4v1642669754373!5m2!1sen!2smm" width="366" height="310" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
         </div> 
        </div>
        <!-- ./c-box -->
        <div class="c-box">

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