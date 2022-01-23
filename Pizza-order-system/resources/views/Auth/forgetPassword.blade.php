@extends('customer.index')
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
    <form action="{{ route('forget.password.post') }}" method="post">
      @csrf
      <div class="input-group">
        <label>Email</label><br>
        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        @if ($errors->has('email'))
        <br><small class="error">{{ $errors->first('email') }}</small>
        @endif
      </div>

      <div class="card-footer">
        <button type="submit" class="btn add-btn">Send Password Reset Link</button>
      </div>
    </form>
  </div>
</div>
@endsection()
