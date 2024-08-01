@extends('admin.layouts.app')
@section('content')
<a href="{{ route('order-list') }}" class="btn add-btn"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
<div class="card-title">
  Order Detail Information
</div>
<div class="card">

  <div class="card-body">
    <div class="order-detail"><label>Order ID :</label><span>{{ $order[0]->id }}</span></div>
    <div class="order-detail"><label>User Name :</label><span>{{ $order[0]->user->name }}</span></div>
    <div class="order-detail"><label>User Phone Number :</label><span>{{ $order[0]->user->phone }}</span></div>
    <div class="order-detail"><label>User Address :</label><span>{{ $order[0]->user->address }}</span></div>
    <div class="order-detail"> <label>Rider Name :</label><span>{{ $order[0]->rider_name }}</span></div>
    <table class="pizza-detail order-table">
      <tr>
        <th>ID</th>
        <th>Pizza Name</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
      @foreach ($order as $pizza )
      <tr>
        <td>{{ $pizza->pizza_id }}</td>
        <td>{{ $pizza->pizza_name }}</td>
        <td>{{ $pizza->quantity }}</td>
        <td>{{ $pizza->price }}</td>
      </tr>
      @endforeach
      <tr>
        <td colspan="3">Net Price</td>
        <td>{{ $net_price }}</td>
      </tr>
    </table>
  </div>
  </div>
</div>
@endsection
