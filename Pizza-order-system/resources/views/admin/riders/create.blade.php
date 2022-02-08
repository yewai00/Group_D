@extends('admin.layouts.app')

@section('content')

<a href="{{ route('riders-index') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
  New Rider Information
</div>
<div class="card">
  <div class="card-body">
    <form action="{{ route('riders-store') }}" method="POST" class="rider-form">
      @csrf
      <div class="input-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name')}}" placeholder="Enter name...">
        @error('name')
        <small class="error">{{ $message }}</small>
        @enderror
      </div>
      <div class="input-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone')}}" placeholder="Enter phone number">
        @error('phone')
        <small class="error">{{ $message }}</small>
        @enderror
      </div>
      <div class="input-group">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email" value="{{ old('email')}}" placeholder="Enter email address">
        @error('email')
        <small class="error">{{ $message }}</small>
        @enderror
      </div>
      <div class="input-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address')}}" placeholder="Enter address">
        @error('address')
        <small class="error">{{ $message }}</small>
        @enderror
      </div>
      <div class="card-footer">
        <button type="submit" class="btn add-btn">Create</button>
      </div>
    </form>
  </div><!-- ./card-body -->
</div>
@endsection
