@extends('customer.layouts.app')
@section('content')
<div class="card-title">
  User Profile
</div>
<div class="card">
  <div class="card-body">
    @if(Session::has('message'))
    <div class="alert clearfix">
      <span>
        {{ Session::get('message') }}
      </span>
      <i class="fas fa-times close-btn"></i>
    </div>
    @endif
    <form action="{{ route('user.profile.post',Auth::user()->id) }}" method="post">
      @csrf
      <div class="input-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}">
        @if ($errors->has('name'))
        <small class="error">{{ $errors->first('name') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Email Address</label>
        <input type="text" name="email" value="{{ Auth::user()->email }}">
        @if ($errors->has('email'))
        <small class="error">{{ $errors->first('email') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Phone Number</label>
        <input type="text" name="phone" value="{{ Auth::user()->phone }}">
        @if ($errors->has('phone'))
        <small class="error">{{ $errors->first('phone') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Address</label>
        <input type="text" name="address" value="{{ Auth::user()->address }}">
        @if ($errors->has('address'))
        <small class="error">{{ $errors->first('address') }}</small>
        @endif
      </div>
      <div class="card-footer">
        <button type="submit" class="btn add-btn">Update</button>
        <a href="{{ route('customer.password.get') }}" class="link">change password?</a>
      </div>
    </form>
  </div>
</div>
@endsection