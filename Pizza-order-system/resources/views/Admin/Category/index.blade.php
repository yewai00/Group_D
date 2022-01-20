{{-- @extends('Admin.layouts.app')

@section('content')
  <section class="category-section">
    <div class="category-card-header clearfix">
      <h4 class="category-header">Manage <span>Categories</span></h4>
      <a href="{{ route('category.create') }}" class="btn add-btn add-category">Add New category</a>
    </div><!-- ./category-card-header -->

    @if(Session('success'))
      <div class="alert-success">
        <strong class="alert-text">{{ Session('success') }}</strong>
      </div>
    @endif

    <div class="card-body">
      <div class="category-func clearfix">
        <form action="{{ route('category.search') }}" method="get" class="l-category-func">
          <input type="text" name="categories" id="categories" placeholder="Search">
          <input type="submit" value="Search" class="btn edit-btn">
        </form>

        <div class="r-category-func">
          <a href="" class="btn add-btn">Download</a>
          <a href="" class="btn add-btn">Upload</a>
        </div>
      </div>

      <table class="list">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>
              <button >
                <a href="{{ url('Admin/Category/'.$category->id.'/edit') }}" class="btn edit-btn">Edit</a>
              </button>
              <form action="{{ url('Admin/Category/'.$category->id) }}" onsubmit="return confirm('Are you sure to delete this record?');" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="btn delete-btn" type="submit">Delete</button>
              </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
     </div><!-- ./card-body -->

  </section>
@endsection --}}

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
        <a href="#" class="btn edit-btn">
            Download
        </a>
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
                <td>0</td>
                <td>
                    <a href="{{ route('category.edit',$item->id) }}" class="btn edit-btn"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('category.delete',$item->id) }}" class="btn delete-btn"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
