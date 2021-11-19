<?php

namespace App\Http\Controllers\API\V01\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Register New User
     * @method POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        //Validate Form Inputs
        $request->validate([
            'name' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'email', 'unique:users']
        ]);

        //Insert User Into Database
        resolve(UserRepository::class)->create($request);

        return response()->json([
            'message' => 'user created successfully.'
        ], Response::HTTP_OK);
    }

    /**
     * Login User
     * @method POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        //Validate Form Inputs
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //Check User Credentials For Login
        if (Auth::attempt($request->only(['email', 'password']))) {
            return \response()->json(Auth::user(), Response::HTTP_OK);
        }

        throw ValidationException::withMessages([
            'email'=>'incorrect email'
        ]);
    }

    public function logout()
    {
        //Logged Out User
        Auth::logout();

        return \response()->json([
            'message'=>'logged out.'
        ],Response::HTTP_OK);
    }


}
