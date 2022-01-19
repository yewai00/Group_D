@extends('Admin.layouts.app')

@section('content')

  <section class="rider-section">
    <div class="rider-card-header clearfix">
      <h4 class="rider-header">Edit <span>Riders</span></h4>
      <a href="{{ route('riders.index') }}" class="btn edit-btn add-rider">Back</a>
    </div><!-- ./rider-card-header -->
    <div class="card">
      <div class="card-body">
        <form action="{{ url('admin/riders/'.$rider->id) }}" method="POST" class="rider-form">
          @csrf
          @method('put')
          <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $rider->name ?? old('name')}}">
            @error('name')
              <div class="error">{{ $message }}</div>
            @enderror
          </div>
          <div class="input-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ $rider->phone ?? old('phone')}}"> 
            @error('phone')
              <div class="error">{{ $message }}</div>
            @enderror         
          </div>
          <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ $rider->email ?? old('email')}}">
            @error('email')
              <div class="error">{{ $message }}</div>
            @enderror
          </div>
          <div class="input-group">
            <label for="address">Addrss</label>
            <input type="text" name="address" id="address" value="{{ $rider->address ?? old('address')}}">
            @error('address')
              <div class="error">{{ $message }}</div>
            @enderror
          </div>
          <div class="input-group">
            <label for="">Status</label>
            <select class="form-select form-control" name="status">
              @if($rider->status == "avaliable")
                <option value="avaliable" selected>avaliable</option>
                <option value="not avaliable">not avaliable</option>
              @else 
                <option value="avaliable">avaliable</option>
                <option value="not avaliable" selected>not avaliable</option>
              @endif
          </select>
          </div>
          <input type="submit" value="Update" class="btn edit-btn">
        </form>
      </div><!-- ./card-body -->
    </div>
  </section>
  
@endsection