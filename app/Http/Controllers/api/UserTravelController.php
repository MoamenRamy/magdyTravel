<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Travel;
use App\Models\UserTravel;
use Illuminate\Http\Request;
use App\Traits\ChangeCurrencyTrait;


class UserTravelController extends Controller
{
    use ChangeCurrencyTrait;

    public $userTravel;

    public function __construct(UserTravel $userTravel)
    {
        // $this->middleware('onceBasic')->only('changeCurrency');
        $this->userTravel = $userTravel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rides = $this->userTravel::with('travel')->paginate(50);
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
            'bookDate' => 'required|date|after:now',
            'userAddress' => 'required',
            'phone' => 'required',
            'code' => 'required',
        ]);

        $userTravel = new $this->userTravel;

        // change currency and know the symbol that user shows it
        $travel = Travel::findOrFail($request->travel_id);
        $price = $travel->price;
        $currency = Currency::where('code', $request->code)->first();
        $currencyId = $currency->id;
        $newPrice  = $this->changeCurrency($currencyId, $price);

        $userTravel = $this->userTravel::create([
            'travel_id' => $request->travel_id,
            'bookDate' => $request->bookDate,
            'userAddress' => $request->userAddress,
            'phone' => $request->phone,
            'price' => $newPrice,
            'code' => $request->code
        ]);

        return $userTravel;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userTravel = $this->userTravel::with('travel')->findOrFail($id);
        return $userTravel;
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
        $userTravel = $this->userTravel::findOrFail($id);
        $userTravel->update($request->all());
        return $userTravel;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userTravel::findOrFail($id)->delete();
        return 204;

    }
}
