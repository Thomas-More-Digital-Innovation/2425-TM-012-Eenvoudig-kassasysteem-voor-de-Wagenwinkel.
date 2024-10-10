<x-header header="Winkelmand">
    <div class="bg-white w-4/5 h-[85vh] rounded-lg flex flex-col justify-between items-center">
        <!-- Grid containing items from the session -->
        <div class="bg-gray-200 h-[600px] rounded-lg w-11/12 mt-4 p-4">
            <div class="grid grid-cols-12 gap-2 w-full sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-12">
                @php
                    $totalItems = 48;
                    $gridItems = array_fill(0, $totalItems, null);


                    $products =  \App\Helpers\Shopping_cart::getRecords();
                @endphp

                @foreach ($products as $product)
                        @if (!empty($product) && isset($product['aantal']) && $product['aantal'] > 0)
                            @for ($i = 0; $i < $product['aantal']; $i++)
                            <div class="w-full aspect-square flex items-center justify-center item">
                                <button class="w-full h-full mt-1 rounded-lg"  data-product-id="{{ $product['id'] }}" >
                                    <img src="{{ asset($product['afbeelding']) }}" id="{{ $i }}" alt="{{ $product['naam'] }}" class="object-cover h-full w-full rounded-lg"/>
                                </button>
                            </div>
                            @endfor
                        @else
                        <div class="w-full aspect-square flex items-center justify-center item">
                            <div class="w-full h-full flex items-center justify-center empty-item">No Image Available</div>
                        </div>
                        @endif

                @endforeach

            </div>
        </div>

        <!-- Footer with buttons and total price -->
        <div class="flex justify-between items-center mb-7 w-11/12">
            <div>
                <form action="{{ route('category') }}" method="GET">
                    @csrf
                    <x-layout.redArrow width="w-[391px]"></x-layout.redArrow>
                </form>
            </div>
            <p class="w-full text-center total-font-size inter-text">Totaal: {{ \App\Helpers\Shopping_cart::getPrice() }} €</p>
            <div>
                <form action="{{ route('soortBetalen') }}" method="GET">
                    @csrf
                    <x-layout.greenArrow width="w-[391px]"></x-layout.greenArrow>
                </form>
            </div>
        </div>
    </div>
</x-header>

@stack('script')

<script>
    let currentMarkedItem = null;

    document.querySelectorAll('.item button').forEach(button => {
        button.addEventListener('click', function () {
            const item = this.parentElement;
            const productId = this.getAttribute('data-product-id');
            const baseUrl = "{{ route('cart.remove-product', ['id' => '']) }}";

            if (item.classList.contains('removed')) {
                item.style.display = 'none';
                window.location.href = baseUrl + '/' + productId;
            } else {
                if (currentMarkedItem) {
                    currentMarkedItem.classList.remove('marked', 'bg-white-500', 'cross', 'removed', 'transparent');
                }
                item.classList.add('marked', "rounded-lg", 'bg-white-500', 'cross', 'removed', 'transparent');
                currentMarkedItem = item;
            }
        });
    });


</script>

<style>
    /* Ensures that each item has a square aspect ratio */
    .transparent {
        opacity: 0.5;
    }

    .aspect-square {
        aspect-ratio: 1 / 1;
    }

    /* Prevent clicks on empty items */
    .empty-item {
        pointer-events: none;
    }

    .cross {
        position: relative;
    }

    .cross::before, .cross::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: Red;
        top: 50%;
        left: 0;
        padding: 5px;
    }

    .cross::before {
        transform: rotate(45deg);
    }

    .cross::after {
        transform: rotate(-45deg);
    }

    .marked img {

        /*display: none; !* Hides the image when the item is marked *!*/
    }
</style>
