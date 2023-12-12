<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
        $this->middleware('auth:sanctum');
        $this->middleware('admin');
    }

    public function deletePhoto($id)
    {
        $this->photo::findOrfail($id)->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }
}
