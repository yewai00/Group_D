@extends('Admin.layouts.app')
@section('content')
<div class="header clearfix">
  <a href="{{ route('users.list','1') }}" class="btn add-btn">
    Admin List
  </a>

</div>
<div class="user-title">
  <h2>
    <a href="{{ route('users.list','0') }}" class="btn user-btn">Users List</a>
  </h2>
  <div class="right">
    <form action="{{ route('user.search', '0') }}" method="post" class="search-form">
      @csrf
      <input type="text" name="search" placeholder="search">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
    <a href="{{ route('user.download','0') }}" class="btn edit-btn">
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
    </tr>
    @endforeach
    @else
    <tr>
      <td class="error" colspan="5">
        *No data yet!
      </td>
    </tr>
    @endif
  </tbody>
</table>
{{ $users->links() }}
@endsection
