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
    <form action="{{ route('category.search') }}" method="post" class="search-form">
      @csrf
      <input type="text" name="search" value="{{ old('search') }}" placeholder="search">
      <button type="submit" class="btn add-btn">Search</button>
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
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->count }}</td>
      <td>
        <a href="{{ route('category.edit',$item->id) }}" class="btn edit-btn"><i class="fas fa-edit"></i></a>
        <a href="{{ route('category.delete',$item->id) }}" class="btn delete-btn"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{ $categories->links() }}
@endsection
