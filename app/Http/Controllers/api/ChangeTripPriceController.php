<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ChangeTripPrice;
use Illuminate\Http\Request;

class ChangeTripPriceController extends Controller
{
    public $price;

    public function __construct(ChangeTripPrice $price)
    {
        $this->price = $price;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'price' => 'required|integer',
        ]);

        $price = new $this->price;

        $price->price = $request->price;
        $price->save();

        return $price;
    }

    /**
     * Display the specified resource.
     */
    public function show(ChangeTripPrice $changeTripPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChangeTripPrice $changeTripPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChangeTripPrice $changeTripPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChangeTripPrice $changeTripPrice)
    {
        //
    }
}
