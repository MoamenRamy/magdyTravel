<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ChangeTripPrice;
use Illuminate\Http\Request;
use App\Http\Resources\ChangeTripPrice as ChangeTripPriceResources;

class ChangeTripPriceController extends Controller
{
    public $price;

    public function __construct(ChangeTripPrice $price)
    {
        $this->price = $price;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required|integer',
        ]);

        $price = new $this->price;

        $price->price = $request->price;
        $price->save();

        // Transform the category model into a resource
        $priceResource = new ChangeTripPriceResources($price);

        // Return the transformed data as a JSON response with a 200 status code
        return $priceResource->response()->setStatusCode(201);
    }
}
