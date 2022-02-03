@extends('Admin.layouts.app')

@section('content')
@if(Session::has('success'))
<div class="alert clearfix">
  <span>
    {{ Session::get('success') }}
  </span>
  <i class="fas fa-times close-btn"></i>
</div>
@endif
<div class="header clearfix">
  <a href="{{ route('riders.create') }}" class="btn add-btn add-rider">Add Rider</a>
  <div class="right">
    <form action="{{ route('riders.search') }}" method="get" class="search-form">
      <input type="text" name="riders" id="riders" placeholder="name or email or address">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
    <a href="{{ route('riders.export') }}" class="btn edit-btn">Download</a>
    <a href="{{ route('riders.upload.get') }}" class="btn edit-btn">Upload</a>
  </div>
</div>
<table class="list">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th class="w-20">Address</th>
      <th>Created At</th>
      <th class="td-action">Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($riders)>0)
    @foreach ($riders as $rider)
    <tr>
      <td>{{ $rider->id }}</td>
      <td>{{ $rider->name }}</td>
      <td>{{ $rider->phone }}</td>
      <td>{{ $rider->email }}</td>
      <td>{{ $rider->address }}</td>
      <td>{{ \Carbon\Carbon::parse($rider->created_at)->format('Y-m-d') }}</td>
      <td>
        <a href="{{ url('admin/riders/'.$rider->id.'/edit') }}" class="btn edit-btn"><i class="fas fa-edit"></i></a>
        <form action="{{ url('admin/riders/'.$rider->id) }}" onsubmit="return confirm('Are you sure to delete?');" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button class="btn delete-btn" type="submit"><i class="fas fa-trash-alt"></i></button>
        </form>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="error" colspan="7">
        *No data yet!
      </td>
    </tr>
    @endif

  </tbody>
</table>
{{ $riders->links() }}
@endsection
