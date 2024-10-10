<x-header header="ProductSelectie">
    <div class="bg-white p-4 rounded-lg mb-3">
        <div id="count" class="mb-7 ms-9 flex  h-[40px]"> {{--max 12 blokjes--}} </div>
        <div class="flex space-x-3 pb-3 p-10">
     {{--   <div class="bg-gray-300 rounded-lg text-center p-40 flex items-center justify-center">--}}
            <button onclick="removeSquare()" class="bg-gray-300 rounded-lg text-center p-40 flex items-center justify-center">
                <img src="{{ asset('assets/images/bin.png')}}" alt="bin" class="h-200 w-200 object-contain aspect-square">
            </button>
        {{--</div>--}}
        <div class="bg-green-400 rounded-lg text-center p-4 flex items-center justify-center ">
            <button onclick="showSquare()">
                <img src="{{ asset($product->afbeeldingen)}}" alt="{{ $product->naam }}" class="h-[500px] w-[500px] object-contain aspect-square rounded-lg">
            </button>
        </div>
    </div>

        <div class="flex justify-between items-center mb-2 w-full px-10">
            <div class="">
                <form action="{{ route('products', ['categoryId' => $product->categorie_id] ) }}" method="GET">
                    @csrf
                    <x-layout.redArrow width="w-[27.5vw]"></x-layout.redArrow>
                </form>
            </div>
            <div class="">
                <form action="{{ route('cart.product-add', ['id' => $product->product_id]) }}" method="POST">
                    <input type="number" id="amount" name="amount" value="0" min="0" hidden>
                    @csrf
                    <x-layout.greenArrow width="w-[27.5vw]"></x-layout.greenArrow>
                </form>
            </div>
        </div>
    </div>

    <script>
        let counter = 0;

        function showSquare() {
            counter++;
            let i = 0;
            let content = '';
            if (counter > 10) {
                counter = 10
            }
            for (let i = 0; i < counter; i++)  {
                if (i === counter - 1) {
                    // Only the last box shows the counter value
                    content += `<div class="numberedField m-[6.5px] w-[95px] h-[95px] bg-purple-900 rounded-lg text-white flex justify-center items-center font-bold text-4xl">${counter}</div>`;
                } else {
                    // Other boxes are empty
                    content += `<div class="m-[6.5px] w-[95px] h-[95px] bg-purple-900 rounded-lg text-white flex justify-center items-center"></div>`;
                }

            }
            document.getElementById('amount').value = counter
            document.getElementById('count').innerHTML = content;
        }

        function removeSquare() {
            counter = 0;
            let i = 0;
            let content = '';

            while (i < counter) {
                content += '<div class="m-1 w-[35px] h-[35px] bg-purple-900 rounded-lg"></div>';
                console.log(counter);
                i++;
            }
            document.getElementById('amount').value = counter
            document.getElementById('count').innerHTML = content;
        }
    </script>
</x-header>
