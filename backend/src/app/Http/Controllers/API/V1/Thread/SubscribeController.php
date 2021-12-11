<?php

namespace App\Http\Controllers\API\V1\Thread;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\Thread;
use Symfony\Component\HttpFoundation\Response;


class SubscribeController extends Controller
{

    public function subscribe(Thread $thread)
    {
        auth()->user()->subscribes()->create([
            'thread_id' => $thread->id
        ]);

        return response()->json([
            'message' => 'user subscribe successfully.'
        ], Response::HTTP_OK);
    }

    public function unSubscribe(Thread $thread)
    {
        Subscribe::query()->where([
            ['thread_id', $thread->id],
            ['user_id', auth()->user()->id]
        ])->delete();

        return response()->json([
            'message' => 'user unsubscribe successfully.'
        ], Response::HTTP_OK);
    }
}
