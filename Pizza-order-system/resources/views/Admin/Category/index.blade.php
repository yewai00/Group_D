@extends('Admin.layouts.app')
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
  <a href="{{ route('category.create') }}" class="btn add-btn">
    Add Category
  </a>
  <div class="right">
    <form action="{{ route('category.search') }}" method="get" class="search-form">
      <input type="text" name="search" value="{{ old('search') }}" placeholder="search">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
    <a href="{{ route('category.export') }}" class="btn edit-btn">
      Download
    </a>
    <a href="{{ route('category.upload.get') }}" class="btn edit-btn">
      Upload
    </a>
  </div>
</div>
<table class="list">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Count</th>
      <th class="td-action">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($categories)>0)
    @foreach($categories as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->count }}</td>
      <td>
        <a href="{{ route('category.edit',$item->id) }}" class="btn edit-btn"><i class="fas fa-edit"></i></a>
        <form action="{{ route('category.delete',$item->id) }}" onsubmit="return confirm('Are you sure to delete?');" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button class="btn delete-btn" type="submit"><i class="fas fa-trash-alt"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="error" colspan="4">
        *No data yet!
      </td>
    </tr>
    @endif

  </tbody>
</table>
{{ $categories->links() }}
@endsection
