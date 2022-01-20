@extends('Admin.layouts.app')
@section('content')
<a href="{{ route('admin.pizza.list') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
        Pizza Detail Information
</div>
<div class="card">

    <div class="card-body">
        <div class="detail-img">
        <img src="{{ asset('img/'.$pizza->image) }}" class="detail-img">
        </div>

        <table class="pizza-detail">
            <tr>
                <td class="td-col1">ID</td>
                <td class="td-col2">{{ $pizza->id }}</td>
            </tr>
            <tr>
                <td class="td-col1">Name</td>
                <td class="td-col2">{{ $pizza->name }}</td>
            </tr>
            <tr>
                <td class="td-col1">Category</td>
                <td class="td-col2">{{ $pizza->category->name }}</td>
            </tr>
            <tr>
                <td class="td-col1">Buy One Get One</td>
                <td class="td-col2">
                @if ($pizza->buy_one_get_one_status == 1)
                    Yes
                    @elseif ($pizza->buy_one_get_one_status == 0)
                    No
                    @endif
                </td>
            </tr>
            <tr>
                <td class="td-col1">Price</td>
                <td class="td-col2">{{ $pizza->price }} mmk</td>
            </tr>
            <tr>
                <td class="td-col1">Description</td>
                <td class="td-col2">{{ $pizza->description }}</td>
            </tr>
        </table>
    </div>
</div>
@endsection