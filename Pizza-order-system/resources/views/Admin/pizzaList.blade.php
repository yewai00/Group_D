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
    <a href="{{ route('pizza.create.get') }}" class="btn add-btn">
        Add Pizza
    </a>
    <div class="right">
        <form action="{{ route('pizza.search') }}" method="post" class="search-form">
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
                <th>Image</th>
                <th>Buy One Get One</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pizzas as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <img src="{{ asset('img/'.$item->image) }}">
                </td>
                <td>
                    @if ($item->buy_one_get_one == 1)
                    Yes
                    @elseif ($item->buy_one_get_one == 0)
                    No
                    @endif
                </td>
                <td>{{ $item->price }}</td>
                <td>
                    <a href="{{ route('pizza.detail',$item->id) }}" class="btn add-btn"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('pizza.edit.get',$item->id) }}" class="btn edit-btn"><i class="fas fa-edit"></i></a>
                    <a href="{{ route('pizza.delete.get',$item->id) }}" class="btn delete-btn"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
