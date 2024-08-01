@extends('admin.layouts.app')
@section('content')
<div class="card-title">
  Are you sure to delete this record?
</div>
<div class="card">
  <div class="card-body">
    <div class="detail-img">
      <img src="{{ asset('img/'.$pizza->image) }}" class="detail-img">
    </div>

    <table class="pizza-detail">
      <tr>
        <td class="td-col1">ID</td>
        <td class="td-col2">{{ $pizza->id }}</td>
      </tr>
      <tr>
        <td class="td-col1">Name</td>
        <td class="td-col2">{{ $pizza->name }}</td>
      </tr>
      <tr>
        <td class="td-col1">Category</td>
        <td class="td-col2">{{ $pizza->category->name }}</td>
      </tr>
      <tr>
        <td class="td-col1">Buy One Get One</td>
        <td class="td-col2">
          @if ($pizza->buy_one_get_one == 'yes')
          Yes
          @elseif ($pizza->buy_one_get_one == 'no')
          No
          @endif
        </td>
      </tr>
      <tr>
        <td class="td-col1">Price</td>
        <td class="td-col2">{{ $pizza->price }} mmk</td>
      </tr>
      <tr>
        <td class="td-col1">Description</td>
        <td class="td-col2">{{ $pizza->description }}</td>
      </tr>
    </table>
    <div class="card-footer">
      <a href="{{ route('pizza-delete-post',$pizza->id) }}" class="btn delete-btn">Delete</a>
      <a href="{{ route('pizza-list') }}" class="btn user-btn">Cancel</a>
    </div>
  </div>
</div>
@endsection
