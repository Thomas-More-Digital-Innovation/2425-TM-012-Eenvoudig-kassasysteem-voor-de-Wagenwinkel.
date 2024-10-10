<div>
<h1>Cart</h1>

@if ( \App\Helpers\Shopping_cart::getCart()['products'])

    <ul>
        @foreach ( \App\Helpers\Shopping_cart::getCart()['products'] as $record)
            <li>
                {{ $record['naam'] }} ({{ $record['actuele_prijs']}}) {{ $record['afbeelding'] }}
            </li>
            <li>
                <p>aantal: {{ $record['aantal'] }}</p>
            </li>
        @endforeach
    </ul>
    <p>Total Price: {{ \App\Helpers\Shopping_cart::getCart()['totalPrice'] }}</p>

@else
    <p>Your cart is empty.</p>
@endif


</div>
