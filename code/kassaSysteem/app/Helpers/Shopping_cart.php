<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Storage;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class Shopping_cart
{
    /**
     * Create a new class instance.
     */
    private static array $cart = [
        'products' => [],
        'totalPrice' => 0
    ];

    public static function init(): void
    {
        self::$cart = session()->get('cart') ?? self::$cart;
    }

    public static function addProduct(Product $product, int $amount): void
    {
        if (isset(self::$cart['products'][$product->product_id])) {
            self::$cart['products'][$product->product_id]['aantal'] += $amount;
        } else {
            self::$cart['products'][$product->product_id] = [
                'id' => $product->product_id,
                'naam' => $product->naam,
                'afbeelding' => $product->afbeelding,
                'actuele_prijs' => $product->actuele_prijs,
                'verkoop_id' => 2, /*navragen wat verkoop tabel is/doet*/
                'aantal' => $amount
            ];
        }

        self::updateTotal();

    }

    public static function updateTotal()
    {
        $totalPrice = 0;
        foreach(self::$cart['products'] as $product)
            {
                $totalPrice += $product['actuele_prijs'] * $product['aantal'];
            }
        self::$cart['totalPrice'] = $totalPrice;
        session()->put('cart', self::$cart);
    }

    public static function getPrice(): float
    {
        return self::$cart['totalPrice'];
    }

    public static function emptySession(): void
    {
        $products = self::$cart['products'];

        foreach ($products as $product) {
           DB::insert('insert into verkooplijnen (hoeveelheid, verkoopprijs, verkoop_id, product_id) values (?, ?, ?, ?)', [
                $product['aantal'],
                $product['actuele_prijs'],
                $product['verkoop_id'],
                $product['id']
            ]);
        }
        session()->forget('cart');
    }

    public static function getCart(): array
    {
        return self::$cart;
    }

    public static function getRecords(): array
    {
        return self::$cart['products'];
    }
}

Shopping_cart::init();
