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
  <div class="right">
    <form action="{{ route('order.search') }}" method="get" class="search-form">
      <input type="text" name="key" value="{{ old('search') }}" placeholder="user name or rider name">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
  </div>
</div>
<table class="list">
  <thead>
    <tr>
      <th>ID</th>
      <th>User Name</th>
      <th>Net Price</th>
      <th>Rider Name</th>
      <th>Order Time</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @if(count($orders)>0)
    @foreach($orders as $item)
    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->user->name }}</td>
      <td>
        {{ $item->net_price }}
      </td>
      <td>
        @if ($item->rider_name == '')
        <span class="link order-btn" id="{{ $item->id }}" for="riderModal{{ $item->id }}">Define Rider</span>
        <div id="order-{{ $item->id }}" class="modal">
          <div class="modal-header">
            <i class="fas fa-times close"></i>
            <h2>Order ID : {{ $item->id }}</h2>
          </div>
          <!-- Modal content -->
          <div class="modal-content">
            <form action="{{ route('order.rider') }}" method="post">
              @csrf
              <input type="hidden" name="order_id" value="{{ $item->id }}">
              <select name="rider_id">
                <option value="">Choose rider for order</option>
                @foreach ($riders as $rider)
                <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                @endforeach
              </select>
              <button type="submit" class="btn search-btn">Submit</button>
            </form>
          </div>
        </div>
        @else
        {{ $item->rider_name }}
        @endif
      </td>
      <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}</td>
      <td class="td-action">
        <a href="{{ route('order.detail',$item->id) }}" class="btn add-btn"><i class="fas fa-eye"></i></a>
      </td>
    </tr>
    @endforeach
    @else
    <tr>
      <td class="error" colspan="6">*No data yet!</td>
    </tr>
    @endif

  </tbody>
</table>
{{ $orders->links() }}
</div>
@endsection
