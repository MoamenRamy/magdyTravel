<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public $travel;

    public function __construct(Travel $travel)
    {
        // $this->middleware('onceBasic')->only('changeCurrency');
        $this->travel = $travel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travel = $this->travel::paginate(10);
        return $travel;
        // return response()->json(['data' => YourResource::collection($data)]);
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
            'category_id' => 'required',
            'description' => 'required',
            'plan' => 'required',
            'address' => 'required',
            'price' => 'required',
            'dateTime' => 'required|date|after:now',
            'period' => 'required',
            'photos' => 'required'
        ]);

        $travel = new $this->travel;

        $travel = $this->travel::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'plan' => $request->plan,
            'address' => $request->address,
            'price' => $request->price,
            'dateTime' => $request->dateTime,
            'period' => $request->period,
        ]);

        $photos = $request->file('photos');
        if ($photos) {
            foreach($photos as $photo){
                $ph = new Photo();
                $ph->photo = $photo->getClientOriginalName();
                $travel->photos()->save($ph);
            }
        } else {
            return 204;
        }

        return $travel;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $travel = $this->travel::findOrFail($id);
        return $travel;
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
        $travel = $this->travel::findOrFail($id);
        $travel->update($request->all());
        return $travel;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->travel::findOrFail($id)->delete();
        return 204;
    }
}
