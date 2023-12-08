<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ChangeTripPrice;
use App\Models\Currency;
use App\Models\Trip;
use Illuminate\Http\Request;
use App\Traits\ChangeCurrencyTrait;
use App\Http\Resources\Trip as TripResource;

class TripController extends Controller
{
    use ChangeCurrencyTrait;

    public $trip;

    public function __construct(Trip $trip)
    {
        $this->middleware('auth:sanctum')->except('store');
        $this->middleware('admin')->except('store');
        $this->trip = $trip;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trip = TripResource::collection($this->trip::paginate(50));
        return $trip->response()->setStatusCode(200);
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
            'userName' => 'required',
            'dateTime' => 'required|date|after:now',
            'phone' => 'required',
            'guest' => 'required',
            'code' => 'required',
            'whatsNumber' => 'required'
        ]);

        $trip = new $this->trip;

        $tripPrice = ChangeTripPrice::latest()->first();
        $price = $tripPrice->price;
        $currency = Currency::where('code', $request->code)->first();
        $currencyId = $currency->id;
        $newPrice  = $this->changeCurrency($currencyId, $price);

        $trip->userName = $request->userName;
        $trip->dateTime = $request->dateTime;
        $trip->phone = $request->phone;
        $trip->guest = $request->guest;
        $trip->code = $request->code;
        $trip->note = $request->note;
        $trip->price = $newPrice;
        $trip->whatsNumber = $request->whatsNumber;
        $trip->save();

        $tripResource = new TripResource($trip);

        return $tripResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $trip = $this->trip::findOrFail($id);

        $tripResource = new TripResource($trip);

        return $tripResource->response()->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $trip = $this->trip::findOrFail($id);
        $trip->update($request->all());
        $tripResource = new TripResource($trip);

        return $tripResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->trip::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
