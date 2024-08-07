@extends('auth.layouts.app')
@section('content')
<div class="card-title">
  Login
</div>
<div class="card">
  @if(Session::has('error'))
  <div class="alert error-alert clearfix">
    <span>
      {{ Session::get('error') }}
    </span>
    <i class="fas fa-times close-btn"></i>
  </div>
  @endif
  <div class="card-body">
    <form action="{{ route('login-post') }}" method="post">
      @csrf
      <div class="input-group">
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        @if ($errors->has('email'))
        <br><small class="error">{{ $errors->first('email') }}</small>
        @endif
      </div>

      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password">
        @if ($errors->has('password'))
        <small class="error">{{ $errors->first('password') }}</small>
        @endif
      </div>
      <div class="input-group">
        <input type="checkbox" name="remember_me">
        <span class="remember">
          Remember Me
        </span>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn add-btn">Login</button>
        <button type="reset" class="btn clear-btn">Clear</button>
        <a href="{{ route('forget-password-get')}}" class="link">
          forget password?
        </a>
      </div>
    </form>
  </div>
</div>
@endsection()
