@extends('admin.layouts.app')
@section('content')
@if(Session::has('message'))
<div class="alert clearfix">
  <span>
    {{ Session::get('message') }}
  </span>
  <i class="fas fa-times close-btn"></i>
</div>
@endif
<div class="header clearfix">
  <a href="{{ route('pizza-create-get') }}" class="btn add-btn">
    Add Pizza
  </a>
  <div class="right">
    <form action="{{ route('pizza-search-get') }}" method="get" class="search-form">
      <input type="text" name="search" value="{{ old('search') }}" placeholder="pizza name or description">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
    <a href="{{ route('pizza-export') }}" class="btn edit-btn">
      Download
    </a>
  </div>
</div>
<table class="list">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Image</th>
      <th>Buy One Get One</th>
      <th>Price</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($pizzas)>0)
    @foreach($pizzas as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td class="td-img">
        <img src="{{ asset('img/'.$item->image) }}">
      </td>
      <td>
        @if ($item->buy_one_get_one == 'yes')
        Yes
        @elseif ($item->buy_one_get_one == 'no')
        No
        @endif
      </td>
      <td>{{ $item->price }}</td>
      <td class="td-action">
        <a href="{{ route('pizza-detail',$item->id) }}" class="btn add-btn"><i class="fas fa-eye"></i></a>
        <a href="{{ route('pizza-edit-get',$item->id) }}" class="btn edit-btn"><i class="fas fa-edit"></i></a>
        <a href="{{ route('pizza-delete-get',$item->id) }}" class="btn delete-btn"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="error" colspan="6">*No data yet!</td>
    </tr>
    @endif

  </tbody>
</table>
{{ $pizzas->links() }}
</div>
@endsection
