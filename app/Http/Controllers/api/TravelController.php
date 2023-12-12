<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Resources\Travel as TravelResource;
use App\Models\Category;
use Illuminate\Support\Str;

class TravelController extends Controller
{
    public $travel;

    public function __construct(Travel $travel)
    {
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
        $this->middleware('admin')->only('update', 'store');
        $this->middleware('superAdmin')->only('destroy');
        $this->travel = $travel;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travel = TravelResource::collection($this->travel::with('photos')->paginate(12));
        return $travel->response()->setStatusCode(200);
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
            'period' => 'required',
            'photos' => 'required',
        ]);

        $travel = new $this->travel;

        $travel->name = $request->name;
        $travel->slug = Str::slug($request->name);
        $travel->category_id = $request->category_id;
        $travel->description = $request->description;
        $travel->plan = $request->plan;
        $travel->address = $request->address;
        $travel->price = $request->price;
        $travel->period = $request->period;
        if ($request->has('dateTime')){
            $this->validate($request, [
                'dateTime' => 'required|date|after:now',
            ]);
            $travel->dateTime = $request->dateTime;
        }
        $travel->save();


        $photos = $request->file('photos');
        if ($photos) {
            foreach ($photos as $photo) {
                // Generate a unique name for each file
                $uniqueFileName = uniqid() . '_' . $photo->getClientOriginalName();

                // Move the file to the storage location (e.g., 'public/photos')
                $photo->storeAs('public/photos', $uniqueFileName);

                // Create a new Photo model instance
                $ph = new Photo();

                // Save the unique file name to the 'photo' attribute
                $ph->photo = $uniqueFileName;

                // Associate the photo with the travel
                $travel->photos()->save($ph);
            }
        //  else {
        //     return 204;
        //  }
        }
        $travelResource = new TravelResource($travel);

        return $travelResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $travel)
    {
        $travelResource = new TravelResource($this->travel::with('photos')->find($travel->id));

        return $travelResource->response()->setStatusCode(200);
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

        $travelResource = new TravelResource($travel);

        return $travelResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->travel::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }

    public function getByCategorySlug($categorySlug)
    {
        // Find the Category by slug
        $category = Category::where('slug', $categorySlug)->firstOrFail();

        // Retrieve travels associated with the category
        $travels = Travel::where('category_id', $category->id)->get();

        // Use the TravelResource collection method directly
        $travelResource = TravelResource::collection($travels);

        return $travelResource->response()->setStatusCode(200);
    }

    public function addPhotos(Request $request, $id)
    {
        $travel = $this->travel::findOrFail($id);

        $photos = $request->file('photos');
        if ($photos) {
            foreach ($photos as $photo) {
                // Generate a unique name for each file
                $uniqueFileName = uniqid() . '_' . $photo->getClientOriginalName();

                // Move the file to the storage location (e.g., 'public/photos')
                $photo->storeAs('public/photos', $uniqueFileName);

                // Create a new Photo model instance
                $ph = new Photo();

                // Save the unique file name to the 'photo' attribute
                $ph->photo = $uniqueFileName;

                // Associate the photo with the travel
                $travel->photos()->save($ph);

                $travelResource = new TravelResource($travel);

                return $travelResource->response()->setStatusCode(201);
            }

            // Return a success response if photos are processed
            return response()->json(['message' => 'Photos added successfully'], 200);
        } else {
            // Return a bad request response if no photos are provided
            return response()->json(['message' => 'Bad Request: No photos provided'], 400);
        }
    }

}
