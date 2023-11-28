<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
// use App\Traits\ChangeCurrencyTrait;

class CurrencyController extends Controller
{
    // use ChangeCurrencyTrait;

    public $currency;

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = $this->currency::all();
        return $currency;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'symbol' => 'required',
            'code' => 'required',
            'price' => 'required',
        ]);

        $currency = new $this->currency;

        $currency = $this->currency::create([
            'name' => $request->name,
            'symbol' => $request->symbol,
            'code' => $request->code,
            'price' => $request->price,
        ]);

        return $currency;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency = $this->currency::findorFail($id);
        return $currency;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $currency = $this->currency::findorFail($id);
        $currency->update($request->all());
        return $currency;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->currency::findOrFail($id)->delete();
        return 204;
    }

    // test trait
    // public function change()
    // {
    //     $price = $this->changeCurrency(2, 50);
    //     return $price;
    // }
}
