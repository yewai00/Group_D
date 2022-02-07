@extends('admin.layouts.app')
@section('content')
<div class="header clearfix">
  <a href="{{ route('users-list','0') }}" class="btn add-btn">Users List</a>
  <a href="{{ route('users-list','1') }}" class="btn user-btn">
    Admin List
  </a>

  <div class="right">
    <form action="{{ route('user-search', '0') }}" method="get" class="search-form">
      <input type="text" name="search" placeholder="name or email or address">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
    <a href="{{ route('user-download','user') }}" class="btn edit-btn">
      Download
    </a>
  </div>
</div>
<table class="list">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Address</th>
      <th>Role</th>
    </tr>
  </thead>
  <tbody>
    @if(count($users)>0)
    @foreach($users as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>
        {{ $item->email }}
      </td>
      <td>{{ $item->phone }}</td>
      <td>
        {{ $item->address }}
      </td>
      <td>
        {{ $item->role }}
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="error" colspan="6">
        *No data yet!
      </td>
    </tr>
    @endif
  </tbody>
</table>
{{ $users->links() }}
@endsection
