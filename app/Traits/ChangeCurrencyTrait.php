<?php

namespace App\Traits;

use App\Models\Currency;

trait ChangeCurrencyTrait
{
    // price = Currency-> price * price of (travel or ride) + currency->symbol
    // in traits and the function has id of currency

    public function changeCurrency($currencyId, $price)
    {
        $currency = Currency::findOrFail($currencyId);
        $newPrice = $currency->price * $price;
        return $newPrice;
    }
}
