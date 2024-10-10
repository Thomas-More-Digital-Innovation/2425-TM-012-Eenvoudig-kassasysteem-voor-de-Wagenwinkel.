<?php
namespace App\Http\Controllers;

use App\Helpers\Shopping_cart;
use App\Models\Organisatie;
use App\Models\Product;
use App\Models\Verkoop;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function emptyCart(Request $request)
    {
        Shopping_cart::emptySession();
        return redirect()->route('category');
    }

    public function addProduct(Request $request, $id = null)
    {
        $amount = $request->input('amount');
        $productid = $request->route('id');
        $product = Product::where('product_id', $productid)->first();

        Shopping_cart::addProduct($product, $amount);
        return redirect()->route('category');
    }


    public function delete(Request $request, $id = null)
    {
        $productid = $request->route('id');
        $product = Product::where('product_id', $productid)->first();

        Shopping_cart::delete($product);
        return redirect()->route('winkelmand');
    }
}
