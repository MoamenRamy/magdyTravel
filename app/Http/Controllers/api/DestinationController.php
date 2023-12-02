<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Resources\Destination as DestinationResource;

class DestinationController extends Controller
{
    public $destination;

    public function __construct(Destination $destination)
    {
        $this->middleware('onceBasic')->only('store', 'update', 'destroy');
        $this->middleware('admin')->except('destroy', 'index', 'show');
        $this->middleware('superAdmin')->only('destroy');
        $this->destination = $destination;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinations = DestinationResource::collection($this->destination::paginate(50));
        return $destinations->response()->setStatusCode(200);
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
            'from' => 'required',
            'to' => 'required',
            'price' => 'required',
        ]);

        $destination = new $this->destination;

        $destination = $this->destination::create([
            'from' => $request->from,
            'to' => $request->to,
            'price' => $request->price,
        ]);

        $destinationResource = new DestinationResource($destination);

        return $destinationResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $destination = new DestinationResource($this->destination::findOrFail($id));
        return $destination->response()->setStatusCode(200)->header('Additional Header', 'True');
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
        $destination = $this->destination::findOrFail($id);
        $destination->update($request->all());

        $destinationResource = new DestinationResource($destination);

        return $destinationResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->destination::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
