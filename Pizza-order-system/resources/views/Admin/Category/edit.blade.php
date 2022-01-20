@extends('Admin.layouts.app')

@section('content')

<a href="{{ route('category.index') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
    Update Category Information
</div><!-- ./category-card-header -->

    <div class="card">
      <div class="card-body">
        <form action="{{ route('category.update', $category->id) }}" method="POST" class="category-form">
          @csrf
          <div class="input-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name ?? old('name')}}">
            @error('name')
              <div class="error">{{ $message }}</div>
            @enderror
          </div>
          
          <input type="submit" value="Update" class="btn edit-btn">
        </form>
      </div><!-- ./card-body -->
      
    </div>
  
@endsection