@extends('admin.layouts.app')

@section('content')

<a href="{{ route('riders-index') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
    <div class="card-title">
        Update Rider Information
    </div>
    <div class="card">
      <div class="card-body">
        <form action="{{ url('admin/riders/'.$rider->id) }}" method="POST" class="rider-form">
          @csrf
          @method('put')
          <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $rider->name ?? old('name')}}">
            @error('name')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ $rider->phone ?? old('phone')}}">
            @error('phone')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ $rider->email ?? old('email')}}">
            @error('email')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
          <div class="input-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="{{ $rider->address ?? old('address')}}">
            @error('address')
              <small class="error">{{ $message }}</small>
            @enderror
          </div>
         <div class="card-footer">
             <button type="submit" class="btn add-btn">Update</button>
         </div>
        </form>
      </div><!-- ./card-body -->
    </div>
@endsection
