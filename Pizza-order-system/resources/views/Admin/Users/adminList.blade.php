@extends('Admin.layouts.app')
@section('content')
<div class="header clearfix">
    <a href="{{ route('users.list','user') }}" class="btn add-btn">
        User List
    </a>
</div>
<div class="user-title">
    <h2>
        <a href="{{ route('users.list','admin') }}" class="btn user-btn">Admin List</a>
    </h2>
    <div class="right">
        <form action="{{ route('user.search', 'admin') }}" method="post" class="search-form">
            @csrf
            <input type="text" name="search" placeholder="search">
            <button type="submit" class="btn search-btn">Search</button>
        </form>
        <a href="{{ route('user.download','admin') }}" class="btn edit-btn">
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
    </tbody>
</table>
@endsection
