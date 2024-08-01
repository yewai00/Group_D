@extends('admin.layouts.app')
@section('content')
<a href="{{ route('admin-profile') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
  Change Password
</div>
<div class="card">
  <div class="card-body">
    @if(Session::has('error'))
    <div class="alert error-alert clearfix">
      <span>
        {{ Session::get('error') }}
      </span>
      <i class="fas fa-times close-btn"></i>
    </div>
    @endif
    <form action="{{ route('admin-password-post',Auth::user()->id) }}" method="post">
      @csrf
      <div class="input-group">
        <label>Old Password</label>
        <input type="password" name="old_password" placeholder="Enter your old password">
        @if ($errors->has('old_password'))
        <small class="error">{{ $errors->first('old_password') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>New Password</label><br>
        <input type="password" name="new_password" placeholder="Enter new password">
        @if ($errors->has('new_password'))
        <br><small class="error">{{ $errors->first('new_password') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Enter confirm password">
        @if ($errors->has('confirm_password'))
        <small class="error">{{ $errors->first('confirm_password') }}</small>
        @endif
      </div>
      <div class="card-footer">
        <button type="submit" class="btn add-btn">Change</button>
      </div>
    </form>
  </div>
</div>
@endsection
