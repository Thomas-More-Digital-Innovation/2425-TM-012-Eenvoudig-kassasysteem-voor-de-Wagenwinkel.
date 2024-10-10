<x-header header="Kies betaling">
    <div class="bg-white p-5 rounded-lg shadow-lg w-3/5 h-[80vh]">
        <div class="flex space-x-3 pb-3">
            <div class="bg-gray-300 rounded-lg shadow-lg p-4 w-full  flex items-center justify-center">
                <a href="{{ route('payconic') }}" class="w-[49.5%] h-[70%] object-contain flex justify-center items-center ">
                    <img src="{{ asset('assets/images/payconiq.svg') }}" alt="Menu" class="object-contain">
                </a>
            </div>
            <div class="bg-gray-300 rounded-lg shadow-lg text-center text-2xl font-bold p-4 flex-grow aspect-square flex items-center justify-center w-full" >
                <img src="{{ asset('assets/images/cash.svg') }}" alt="Instellingen" class="object-contain w-[49.5%] h-[70%]">
            </div>
        </div>
        <div class="flex mt-4">
            <a href="{{route('winkelmand')}}" class="flex w-2/4">
                <x-layout.redArrow height="h-[240px]" />
            </a>
        </div>
    </div>
</x-header>
