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
    <a href="{{ route('riders.create') }}" class="btn add-btn add-rider">Add New Rider</a>
    <div class="right">
        <form action="{{ route('riders.search') }}" method="get" class="search-form">
            <input type="text" name="riders" id="riders" placeholder="Search">
            <button type="submit" class="btn edit-btn">Search</button>
        </form>
        <a href="" class="btn add-btn">Download</a>
        <a href="" class="btn add-btn">Upload</a>
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
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($riders as $rider)
        <tr>
            <td>{{ $rider->id }}</td>
            <td>{{ $rider->name }}</td>
            <td>{{ $rider->phone }}</td>
            <td>{{ $rider->email }}</td>
            <td>{{ $rider->address }}</td>
            <td>{{ $rider->status }}</td>
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
    </tbody>
</table>
@endsection
