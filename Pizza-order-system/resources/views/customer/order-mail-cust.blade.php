@component('mail::message')
# Thanks for your order
Hi {{@Auth::user()->name}},<br>
Just to let you know — we've received your order #{{$order_id}}, and it is now being processed:

Pay with cash upon delivery.

[order #{{$order_id}}]
@component('mail::table')
| Pizza       | Quantity      | Price  |
| ------------|:-------------:| -------:|
@foreach(array_keys($orderLists->items) as $i)
| {{($orderLists->items[$i]['item']['name'])}} | {{($orderLists->items[$i]['qty'])}} | {{($orderLists->items[$i]['price'])}} MMK|
@endforeach
|| Payment method: | Cash on delivery |
|| Total:      | {{$orderLists->totalPrice}} MMK |
@endcomponent
@endcomponent