<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\Ride;
use Illuminate\Http\Request;
use App\Traits\ChangeCurrencyTrait;

class RideController extends Controller
{
    use ChangeCurrencyTrait;

    public $ride;

    public function __construct(Ride $ride)
    {
        // $this->middleware('onceBasic')->only('changeCurrency');
        $this->ride = $ride;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rides = $this->ride::paginate(50);
        return $rides;
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
            'from' => 'required',
            'to' => 'required',
            'dateTime' => 'required|date|after:now',
            'guest' => 'required',
            'phoneNumber' => 'required',
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
            'from' => $request->from,
            'to' => $request->to,
            'dateTime' => $request->dateTime,
            'guest' => $request->guest,
            'price' => $newPrice,
            'phoneNumber' => $request->phoneNumber,
            'code' => $request->code,
        ]);

        return $ride;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ride = $this->ride::findOrFail($id);
        return $ride;
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
        $ride = $this->ride::findOrFail($id);
        $ride->update($request->all());
        return $ride;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->ride::findOrFail($id)->delete();
        return 204;

    }
}
