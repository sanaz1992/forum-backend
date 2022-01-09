<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function user()
    {
        $data = [
            Auth::user(),
            'notifications' => Auth::user()->unreadNotifications(),
            'message'=>'successful'
        ];
        return response()->json($data, Response::HTTP_OK);
    }

    public function leaderboards()
    {
        return resolve(UserRepository::class)->leaderboards();
    }
}
