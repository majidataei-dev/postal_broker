<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::orderBy('created_at', 'desc')->paginate(10);
            return response()->json([
                'data' => UserResource::collection($users),
                'meta' => [
                    'current_page' => $users->currentPage(),
                    'first_page_url' => $users->url(1),
                    'from' => $users->firstItem(),
                    'last_page' => $users->lastPage(),
                    'last_page_url' => $users->url($users->lastPage()),
                    'links' => $users->toArray()['links'],
                    'next_page_url' => $users->nextPageUrl(),
                    'prev_page_url' => $users->previousPageUrl(),
                    'path' => $users->path(),
                    'per_page' => $users->perPage(),
                    'to' => $users->lastItem(),
                    'total' => $users->total()
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            // create user
            $user = User::create([
                'full_name' => $request->full_name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'zip_code' => $request->zip_code
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data'    => new UserResource($user) // or new UserResource($user)
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'An error occurred while saving the user',
                'error'   => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(User $receiver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $receiver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateuserRequest $request, User $receiver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $receiver)
    {
        //
    }
}
