@extends('Admin.layouts.app')

@section('content')
  <section class="rider-section">
    <div class="rider-card-header clearfix">
      <h4 class="rider-header">Create <span>Riders</span></h4>
      <a href="{{ route('riders.index') }}" class="btn edit-btn add-rider">Back</a>
    </div><!-- ./rider-card-header -->
    <div class="card">
      <div class="card-body">
       <form action="{{ route('riders.store') }}" method="POST" class="rider-form">
         @csrf
         <div class="input-group">
           <label for="name">Name</label>
           <input type="text" name="name" id="name" value="{{ old('name')}}">
           @error('name')
             <div class="error">{{ $message }}</div>
           @enderror
         </div>
         <div class="input-group">
           <label for="phone">Phone</label>
           <input type="text" name="phone" id="phone" value="{{ old('phone')}}"> 
           @error('phone')
             <div class="error">{{ $message }}</div>
           @enderror         
         </div>
         <div class="input-group">
           <label for="email">Email</label>
           <input type="text" name="email" id="email" value="{{ old('email')}}">
           @error('email')
             <div class="error">{{ $message }}</div>
           @enderror
         </div>
         <div class="input-group">
           <label for="address">Addrss</label>
           <input type="text" name="address" id="address" value="{{ old('address')}}">
           @error('address')
             <div class="error">{{ $message }}</div>
           @enderror
         </div>
         <div class="input-group">
           <label for="status">Status</label>
           <select class="form-control form-select" name="status">
             <option value="avaliable" selected>avaliable</option>
             <option value="not avaliable">not avaliable</option>
         </select>
         </div>
         <input type="submit" value="Create" class="btn edit-btn">
       </form>
      </div><!-- ./card-body -->
    </div>

  </section>
@endsection