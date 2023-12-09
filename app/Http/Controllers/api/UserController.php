<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->middleware('auth:sanctum')->only('index', 'destroy', 'changeRoleToSuperAdmin', 'changeRoleToAdmin', 'changeRoleToDefualtUser', 'updateProfile', 'update', 'store');
        $this->middleware('admin')->only('destroy', 'store');
        $this->middleware('superAdmin')->only('changeRoleToAdmin', 'changeRoleToSuperAdmin', 'changeRoleToDefualtUser');

        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserResource::collection($this->user::paginate(50));
        return $users->response()->setStatusCode(200);
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
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        // Create a new User instance
        $user = $this->user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
        ]);

        // Create a new UserResource instance
        $userResource = new UserResource($user);

        // Return the transformed data as a JSON response with a 201 status code
        return $userResource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->user::findOrFail($id);

        // Create a new UserResource instance
        $userResource = new UserResource($user);

        // Return the transformed data as a JSON response with a 201 status code
        return $userResource->response()->setStatusCode(200);
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
        $user = $this->user::findOrFail($id);
        if (Auth::user()->id == $user->id) {
            $user->update($request->all());

            // Create a new UserResource instance
            $userResource = new UserResource($user);

            // Return the transformed data as a JSON response with a 201 status code
            return $userResource->response()->setStatusCode(200);
        }
        return response()->json(['message' => 'you not allow to do this'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user::findOrFail($id);
        $this->authorize('delete', $user);
        $user->delete();
        return response()->json(['message' => 'deleted successfuly'], 200);
    }

    // public function changeCurrency(Request $request, $id)
    // {
    //     // auth user -> currency id = $id
    //     $user = Auth::user();
    //     $user->currency_id = $id;
    //     $user->save();
    //     return $user;
    // }

    // change role
    public function changeRoleToAdmin($id)
    {
        $user = $this->user::findOrFail($id);
        $user->role = 1;
        $user->save();

        // Create a new UserResource instance
        $userResource = new UserResource($user);

        // Return the transformed data as a JSON response with a 201 status code
        return $userResource->response()->setStatusCode(200);
    }

    public function changeRoleToSuperAdmin($id)
    {
        $user = $this->user::findOrFail($id);
        $user->role = 2;
        $user->save();

        // Create a new UserResource instance
        $userResource = new UserResource($user);

        // Return the transformed data as a JSON response with a 201 status code
        return $userResource->response()->setStatusCode(200);
    }

    // function make user role = 0
    public function changeRoleToDefualtUser($id)
    {
        $user = $this->user::findOrFail($id);
        $user->role = 0;
        $user->save();

        // Create a new UserResource instance
        $userResource = new UserResource($user);

        // Return the transformed data as a JSON response with a 201 status code
        return $userResource->response()->setStatusCode(200);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // image|mimes:jpeg,png,jpg,gif|max:2048
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
            $user->save();
        }

        return response()->json(['success' => 'Profile photo updated successfully.'], 200);
    }
}
