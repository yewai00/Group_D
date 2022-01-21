@extends('Admin.layouts.app')
@section('content')

<a href="{{ route('category.index') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
  Upload Category
</div>

<div class="card">
  <div class="card-body">
    <form action="{{ route('category.upload') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="input-group center">
        <label for="name">Choose csv file:</label><br>
        <input type="file" name="file">
        @if ($errors->has('file'))
        <br>
        <small class="error">{{ $errors->first('file') }}</small>
        @endif
      </div>
      <div class="card-footer">
          <button type="submit" class="btn add-btn">Upload</button>
      </div>
    </form>
  </div>
</div>

@endsection
