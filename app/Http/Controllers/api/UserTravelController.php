<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Travel;
use App\Models\UserTravel;
use Illuminate\Http\Request;
use App\Traits\ChangeCurrencyTrait;
use App\Http\Resources\UserTravel as UserTravelResource;
use App\Models\User;

class UserTravelController extends Controller
{
    use ChangeCurrencyTrait;

    public $userTravel;

    public function __construct(UserTravel $userTravel)
    {
        $this->middleware('onceBasic')->except('store');
        $this->middleware('admin')->except('store');
        $this->userTravel = $userTravel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rides = UserTravelResource::collection($this->userTravel::paginate(20));
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
            'bookDate' => 'required|date|after:now',
            'userAddress' => 'required',
            'phone' => 'required',
            'code' => 'required',
        ]);

        $userTravel = new $this->userTravel;

        // change currency and know the symbol that user shows it
        $travel = Travel::findOrFail($request->travel_id);
        $price = $travel->price;
        $travel->bookedCount += 1;
        $travel->save();

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

        $userTravelResource = new UserTravelResource($userTravel);

        return $userTravelResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userTravel = $this->userTravel::findOrFail($id);

        $userTravelResource = new UserTravelResource($userTravel);

        return $userTravelResource->response()->setStatusCode(200);
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

        $userTravelResource = new UserTravelResource($userTravel);

        return $userTravelResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userTravel::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
