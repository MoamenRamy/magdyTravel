<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Resources\Currency as CurrencyResource;

class CurrencyController extends Controller
{
    public $currency;

    public function __construct(Currency $currency)
    {
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
        $this->middleware('admin')->except('destroy', 'index', 'show');
        $this->middleware('superAdmin')->only('destroy');
        $this->currency = $currency;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = CurrencyResource::collection($this->currency::all());
        return $currency->response()->setStatusCode(200);
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

        // Transform the category model into a resource
        $currencyResource = new CurrencyResource($currency);

        // Return the transformed data as a JSON response with a 201 status code
        return $currencyResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currency = $this->currency::findorFail($id);

        // Transform the category model into a resource
        $currencyResource = new CurrencyResource($currency);

        // Return the transformed data as a JSON response with a 200 status code
        return $currencyResource->response()->setStatusCode(200);
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

        // Transform the category model into a resource
        $currencyResource = new CurrencyResource($currency);

        // Return the transformed data as a JSON response with a 200 status code
        return $currencyResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->currency::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
