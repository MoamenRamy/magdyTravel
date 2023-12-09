<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\Ride;
use Illuminate\Http\Request;
use App\Traits\ChangeCurrencyTrait;
use App\Http\Resources\Ride as RideResource;

class RideController extends Controller
{
    use ChangeCurrencyTrait;

    public $ride;

    public function __construct(Ride $ride)
    {
        $this->middleware('auth:sanctum')->only('update', 'destroy');
        $this->middleware('admin')->only('update');
        $this->middleware('superAdmin')->only('destroy');
        $this->ride = $ride;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rides = RideResource::collection($this->ride::paginate(12));
        return $rides->response()->setStatusCode(200);
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
            'destination_id' => 'required',
            'name' => 'required',
            'from' => 'required',
            'to' => 'required',
            'dateTime' => 'required|date|after:now',
            'guest' => 'required',
            'phoneNumber' => 'required',
            'whatsNumber' => 'required',
        ]);

        $ride = new $this->ride;

        // change currency and know the symbol that user shows it
        $destination = Destination::findOrFail($request->destination_id);
        $price = $destination->price;
        $currency = Currency::where('code', $request->code)->first();
        $currencyId = $currency->id;
        $newPrice  = $this->changeCurrency($currencyId, $price);

        $ride = $this->ride::create([
            'destination_id' => $request->destination_id,
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to,
            'dateTime' => $request->dateTime,
            'guest' => $request->guest,
            'price' => $newPrice,
            'phoneNumber' => $request->phoneNumber,
            'whatsNumber' => $request->whatsNumber,
            'code' => $request->code,
        ]);

        $rideResource = new RideResource($ride);

        return $rideResource->response()->setStatusCode(201);

        return $ride;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ride = $this->ride::findOrFail($id);

        $rideResource = new RideResource($ride);

        return $rideResource->response()->setStatusCode(200)->header('Additional Header', 'True');
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
    // admin
    public function update(Request $request, string $id)
    {
        $ride = $this->ride::findOrFail($id);
        $ride->update($request->all());

        $rideResource = new RideResource($ride);

        return $rideResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->ride::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
