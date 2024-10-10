<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Organisaties;
use App\Http\Controllers\ProductController;
use App\Livewire\Product;
use Illuminate\Support\Facades\Route;
use App\Livewire\DatabaseTesting;

// VIEW
Route::view('newCategory', 'newCategory')->name('category');

Route::view('/', 'newCategory')->name('category');

Route::view('/', 'newCategory')->name('select');

Route::view('soortBetalen', 'soortBetalen')->name('soortBetalen');




// GET

Route::get('organisatieBeheer', [Organisaties::class, 'beheer'])->name('organisatieBeheer');

Route::get('success', function() {
    return view('success');
})->name('success');

Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('winkelwagen', \App\Livewire\Winkelkar::class)->name('winkelkar');

/*moet nog weg*/
Route::get('userSession', \App\Livewire\UserSession::class)->name('userSession');

Route::get('payconic', function() {
    return view('Payconic');
})->name('payconic');

Route::get('winkelmand', [CartController::class, 'showCart'])->name('winkelmand');


Route::get('wisselgeldBeheer', function() {
    $money = [
        [
            'id' => 1,
            'name' => '50euro',
            'amount' => 50,
        ],
        [
            'id' => 2,
            'name' => '20euro',
            'amount' => 20,
        ],

        [
            'id' => 3,
            'name' => '10euro',
            'amount' => 10,
        ],
        [
            'id' => 4,
            'name' => '5euro',
            'amount' => 5,
        ],
        [
            'id' => 5,
            'name' => '2euro',
            'amount' => 2,
        ],
        [
            'id' => 6,
            'name' => '1euro',
            'amount' => 1,
        ],
        [
            'id' => 7,
            'name' => '50cent',
            'amount' => 50,
        ],
        [
            'id' => 8,
            'name' => '20cent',
            'amount' => 20,
        ],
        [
            'id' => 9,
            'name' => '10cent',
            'amount' => 10,
        ],
        [
            'id' => 10,
            'name' => '5cent',
            'amount' => 5,
        ],

    ];
    return view('wisselgeldBeheer', [
        'money' => $money,
    ]);
});

Route::get('/item-select/{categoryId?}', [ProductController::class, 'ProductAll'])->name('products');

Route::get('newCategory', function () {
    return view('category');
})->name('category');

Route::get('item-select/product/{id?}', Product::class)->name('product');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('calculate-change', function() {
    $totalCost = 12.50;
    $amountGiven = 20.00;

    $denominations = [
        ['name' => '50', 'value' => 50, 'count' => 99],
        ['name' => '20', 'value' => 20, 'count' => 99],
        ['name' => '10', 'value' => 10, 'count' => 0],
        ['name' => '5', 'value' => 5, 'count' => 99],
        ['name' => '2', 'value' => 2, 'count' => 99],
        ['name' => '1', 'value' => 1, 'count' => 99],
        ['name' => '_50', 'value' => 0.50, 'count' => 99],
        ['name' => '_20', 'value' => 0.20, 'count' => 99],
        ['name' => '_10', 'value' => 0.10, 'count' => 99],
        ['name' => '_5', 'value' => 0.05, 'count' => 99],
    ];

    $change = $amountGiven - $totalCost;
    $result = [];

    foreach ($denominations as &$denom) {
        if ($change >= $denom['value'] && $denom['count'] > 0) {
            $quantity = min(floor($change / $denom['value']), $denom['count']);
            if ($quantity > 0) {
                $result[] = ['name' => $denom['name'], 'quantity' => $quantity];
                $change -= $quantity * $denom['value'];
                $change = round($change, 2);
            }
        }
    }

    if ($change > 0) {
        foreach ($denominations as &$denom) {
            if ($denom['count'] == 0) {
                continue;
            }
            while ($change > 0 && $denom['count'] > 0) {
                if ($denom['value'] > $change) {
                    continue;
                }
                $denom['count']--;
                $result[] = ['name' => $denom['name'], 'quantity' => 1];
                $change -= $denom['value'];
                $change = round($change, 2);
            }
        }
    }

    return view('calculateChange', [
        'result' => $result,
        'total_cost' => $totalCost,
        'amount_given' => $amountGiven,
    ]);


});

Route::get('begeleiderLogin', function () {
    return view('begeleiderLogin');
})->name('begeleiderLoginForm');

Route::get('betaalmethode', function () {
    return view('betaalmethode');
});

Route::get('cashBetalen', function () {
    return view('cashBetalen');
});

Route::post('empty-cart', [CartController::class, 'emptyCart'])->name('empty.cart');

Route::post('item-select/product/{id?}', [CartController::class, 'addProduct'])->name('cart.product-add');
Route::get('RemoveProduct/{id?}', [CartController::class, 'delete'])->name('cart.remove-product');

Route::post('begeleiderLogin', function () {

    $logins = [
        ['naam' => 'maxim', 'wachtwoord' => '123']
    ];

    $naam = request('name');
    $wachtwoord = request('password');


    $is_valid = false;
    foreach ($logins as $login) {
        if ($login['naam'] === $naam && $login['wachtwoord'] === $wachtwoord) {
            $is_valid = true;
            break;
        }
    }


    if ($is_valid) {
        return view('settings', ['naam' => $naam]);
    } else {
        return back()->withErrors(['error' => 'Ongeldige naam of wachtwoord.']);
    }
})->name('begeleiderLogin');

Route::get('betaalmethode', function () {
    return view('betaalmethode');
});


Route::get('cashBetalen', function () {
    return view('cashBetalen');
});

Route::get('products', DatabaseTesting::class)->name('producten');
