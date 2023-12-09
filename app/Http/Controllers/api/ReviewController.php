<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Resources\Review as ReviewResource;

class ReviewController extends Controller
{
    public $review;

    public function __construct(Review $review)
    {
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
        $this->middleware('superAdmin')->only('destroy');
        $this->middleware('admin')->only('update');
        $this->review = $review;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = ReviewResource::collection($this->review::paginate(12));
        return $reviews->response()->setStatusCode(200);
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
        // user can review ocne on one travel

        if ($request->user()->reviews()->whereTravel_id($request->travel_id)->exists()) {
            return 404;
        }

        // travel id known in front end
        $review = Review::create($request->all()+ ['user_id' => auth()->id()]);

        $reviewResource = new ReviewResource($review);

        return $reviewResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = $this->review::findOrFail($id);

        $reviewResource = new ReviewResource($review);

        return $reviewResource->response()->setStatusCode(200)->header('Additional Header', 'True');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->review::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
