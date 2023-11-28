<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public $review;

    public function __construct(Review $review)
    {
        $this->middleware('onceBasic')->only('store');
        $this->review = $review;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->review::with('user')->paginate(20);
        return $reviews;
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
        return $review;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = $this->review::with('user')->findOrFail($id);
        return $review;
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
        return 204;
    }
}
