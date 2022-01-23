@extends('Admin.layouts.app')

@section('content')
<a href="{{ route('category.index') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
    New Category Information
</div>
  <!-- ./category-card-header -->

    <div class="card">
      <div class="card-body">
       <form action="{{ route('category.store') }}" method="POST" class="category-form">
         @csrf
         <div class="input-group">
           <label for="name">Name</label>
           <input type="text" name="name" id="name" value="{{ old('name')}}">
           @error('name')
             <div class="error">{{ $message }}</div>
           @enderror
         </div>
         <div class="card-footer">
             <button type="submit" class="btn edit-btn">Create</button>
         </div>
       </form>
      </div><!-- ./card-body -->
    </div>
@endsection
