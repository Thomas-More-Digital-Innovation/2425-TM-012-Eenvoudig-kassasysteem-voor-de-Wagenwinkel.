<?php

namespace App\Livewire;

use App\Helpers\Shopping_cart;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Product extends Component
{
    public $product = null;
    public function mount($id = null)
    {
        if ($id) {
            $this->product = \App\Models\Product::where('product_id', $id)->firstOrFail();
        }
    }

    public function addToBasket(Product $product): void
    {

        /*$product = \App\Models\Product::where('product_id', $productId)->first();*/

        if ($product) {
            Shopping_cart::addProduct($product, 5);
        } else {
            session()->flash('error', 'Product not found.');
        }
    }

    public function getRoute()
    {
        return $this->product;
    }


    public function render($id = null)
    {
       /* if ($id) {*/
            $product = \App\Models\Product::where('product_id', $id)
                ->get();
       /* } else {
            // If no ID is provided, get all records
            $products = \App\Models\Product::withCount('records')
                ->orderBy($this->sortColumn, $this->sortOrder)
                ->get();
        }*/
        return view('Product', compact('product'));
    }
}
