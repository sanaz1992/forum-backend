<?php

namespace App\Http\Controllers\API\V1\Thread;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreThreadRequest;
use App\Models\Thread;
use App\Repositories\ThreadRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['user_block'])->except(['index', 'show']);
    }

    public function index(ThreadRepository $threadRepository)
    {
        $threads = $threadRepository->getAllAvailableThreads();
//        $threads = resolve(ThreadRepository::class)->getAllAvailableThreads();

        return \response()->json($threads, Response::HTTP_OK);
    }

    public function show($slug,ThreadRepository $threadRepository)
    {
        $thread =$threadRepository->getThreadBySlug($slug);
//        $thread = resolve(ThreadRepository::class)->getThreadBySlug($slug);

        return \response()->json($thread, Response::HTTP_OK);
    }

    public function store(StoreThreadRequest $request, ThreadRepository $threadRepository)
    {
        $threadRepository->store($request);
//        resolve(ThreadRepository::class)->store($request);

        return \response()->json([
            'message' => 'thread created successfully.'
        ], Response::HTTP_CREATED);
    }

    public function update(StoreThreadRequest $request, Thread $thread ,ThreadRepository $threadRepository)
    {
//        if ($request->has('best_answer_id')) {
//            $request->validate([
//                'best_answer_id' => 'required'
//            ]);
//        } else {
//            $request->validate([
//                'title' => 'required',
//                'content' => 'required',
//                'channel_id' => 'required'
//            ]);
//        }

        if (Gate::forUser(auth()->user())->allows('user-thread', $thread)) {
           $threadRepository->update($request, $thread);
//            resolve(ThreadRepository::class)->update($request, $thread);

            return \response()->json([
                'message' => 'thread updated successfully.'
            ], Response::HTTP_OK);
        }

        return \response()->json([
            'message' => 'access denied.'
        ], Response::HTTP_FORBIDDEN);
    }

    public function destroy(Thread $thread,ThreadRepository $threadRepository)
    {
        if (Gate::forUser(auth()->user())->allows('user-thread', $thread)) {
            $threadRepository->destroy($thread);
//            resolve(ThreadRepository::class)->destroy($thread);

            return \response()->json([
                'message' => 'thread deleted successfully.'
            ], Response::HTTP_OK);
        }

        return \response()->json([
            'message' => 'access denied.'
        ], Response::HTTP_FORBIDDEN);
    }
}
