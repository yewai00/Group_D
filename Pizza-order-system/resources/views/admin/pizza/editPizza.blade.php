@extends('admin.layouts.app')
@section('content')
<a href="{{ route('pizza-list') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
  Update Pizza Information
</div>
<div class="card">
  <div class="card-body">
    <form action="{{ route('pizza-edit-post',$pizza->id) }}" method="post" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="last_url" value="{{  URL::previous() }}">
      <div class="input-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $pizza->name) }}">
        @if ($errors->has('name'))
        <small class="error">{{ $errors->first('name') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Image</label><br>
        <input type="file" name="image">
        @if ($errors->has('image'))
        <br><small class="error">{{ $errors->first('image') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Category</label>
        <select name="category_id">
          <option value="">Choose Category</option>
          @foreach($categories as $item)
          @if($pizza->category_id == $item->id || old('category_id') == $item->id)
          <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
          @else
          <option value="{{ $item->id }}">{{ $item->name }}</option>
          @endif

          @endforeach
        </select>
        @if ($errors->has('category_id'))
        <small class="error">{{ $errors->first('category_id') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Buy One Get One</label><br>
        @if(old('buy_one_get_one'))
        <input type="radio" name="buy_one_get_one" id="yes" value="yes"  @if(old('buy_one_get_one') === 'yes') checked @endif><label for="yes">Yes</label><br>
        <input type="radio" name="buy_one_get_one" id="no" value="no" @if(old('buy_one_get_one') === 'no') checked @endif><label for="no">No</label>
        @else
            @if($pizza->buy_one_get_one === 'yes')
            <input type="radio" name="buy_one_get_one" id="yes" value="yes" checked><label for="yes">Yes</label><br>
            <input type="radio" name="buy_one_get_one" id="no" value="no"><label for="no">No</label>
            @else
            <input type="radio" name="buy_one_get_one" id="yes" value="yes"><label for="yes">Yes</label><br>
            <input type="radio" name="buy_one_get_one" id="no" value="no" checked><label for="no">No</label>
            @endif
        @endif

        @if ($errors->has('buy_one_get_one'))
        <br><small class="error">{{ $errors->first('buy_one_get_one') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Price</label>
        <input type="text" name="price" value="{{ old('price', $pizza->price) }}">
        @if ($errors->has('price'))
        <small class="error">{{ $errors->first('price') }}</small>
        @endif
      </div>
      <div class="input-group">
        <label>Description</label>
        <textarea name="description" rows="3">{{ old('description', $pizza->description) }}</textarea>
        @if ($errors->has('description'))
        <small class="error">{{ $errors->first('description') }}</small>
        @endif
      </div>
      <div class="card-footer">
        <button type="submit" class="btn add-btn">Update</button>
      </div>

    </form>
  </div>
</div>
@endsection
