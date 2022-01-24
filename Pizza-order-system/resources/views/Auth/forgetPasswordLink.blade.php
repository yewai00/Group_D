@extends('customer.layouts.app')
@section('content')
<div class="card-title">
  Reset Password
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
    <form action="{{ route('reset.password.post') }}" method="post">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

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
        <label>Confirm Password</label>
        <input type="password" name="confirmation" placeholder="Enter confirm password">
        @if ($errors->has('confirmation'))
        <small class="error">{{ $errors->first('confirmation') }}</small>
        @endif
      </div>

      <div class="card-footer">
        <button type="submit" class="btn add-btn">Reset Password</button>
      </div>
    </form>
  </div>
</div>
@endsection()
