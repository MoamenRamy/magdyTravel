<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public $category;

    public function __construct(Category $category)
    {
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
        $this->middleware('admin')->except('destroy', 'index', 'show');
        $this->middleware('superAdmin')->only('destroy');
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = CategoryResource::collection($this->category::all());
        return $category->response()->setStatusCode(200);
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
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        // Create a new category and assign the values from the request
        $category = new $this->category;
        $category->title = $request->title;
        $category->description = $request->description;

        // Generate a slug by concatenating the title and a random number
        $category->slug = Str::slug($request->title);

        // Save the category
        $category->save();

        // Transform the category model into a resource
        $categoryResource = new CategoryResource($category);

        // Return the transformed data as a JSON response with a 200 status code
        return $categoryResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $categoryResource = new CategoryResource($category);

        return $categoryResource->response()->setStatusCode(200)->header('Additional Header', 'True');;
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
    // make it with slug
    public function update(Request $request, string $id)
    {

        $category = $this->category::findOrFail($id);

        $category->update($request->all());

        $categoryResource = new CategoryResource($category);

        return $categoryResource->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    // make it with slug

    public function destroy(string $id)
    {
        $this->category::findOrFail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
