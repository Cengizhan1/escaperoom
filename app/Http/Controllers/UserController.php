<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the specified user.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json(Auth::user(), 200);
    }

    /**
     * Update the specified user in the database.
     * @param User $user
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $user = Auth::user();
        $user->fill($request->validated());
        $user->save();
        return response()->json($user, 200);
    }

    /**
     * Remove the specified user from the database.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        $user = Auth::user();
        $user->delete();
        return response()->json(['message' => 'User deleted.'], 200);
    }

}
