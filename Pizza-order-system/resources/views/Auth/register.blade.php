@extends('Auth.layouts.app')
@section('content')

<div class="card-title">
  Register
</div>
<div class="card">
  <div class="card-body">
    <form action="{{ route('register.post') }}" method="post">
      @csrf
      <div class="input-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name">
        @if ($errors->has('name'))
        <small class="error">{{ $errors->first('name') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        @if ($errors->has('email'))
        <br><small class="error">{{ $errors->first('email') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Phone Number</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number eg. 09000000000">
        @if ($errors->has('phone'))
        <br><small class="error">{{ $errors->first('phone') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Address</label>
        <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter your address">
        @if ($errors->has('address'))
        <small class="error">{{ $errors->first('address') }}</small>
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
        <button type="submit" class="btn add-btn">Register</button>
      </div>
    </form>
  </div>
</div>
@endsection
