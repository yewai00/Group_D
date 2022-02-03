@extends('customer.layouts.app')

@section('content')
  <div class="order-history">
    <div class="container">
      <table>
        <tr>
          <th>Order ID</th>
          <th>Rider Name</th>
          <th>Total Price</th>
          <th>Order Date</th>
          <th>Detail</th>
        </tr>
        @foreach($history as $h)
        <tr>
          <td>#{{ $h->id }}</td>
          <td>{{ $h->name ? $h->name : N/A }}</td>
          <td>{{ $h->price }} MMK</td>
          <td>{{date("F j, Y, g:i A", strtotime($h->created_at))}}</td>
          <td><a href="/order-history/detail/{{ $h->id }}" class="hdetail">detail</a></td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
