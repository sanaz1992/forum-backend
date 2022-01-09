<?php

namespace App\Http\Controllers\API\V1\Thread;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Subscribe;
use App\Models\Thread;
use App\Models\User;
use App\Notifications\NewReplySubmitted;
use App\Repositories\AnswerRepository;
use App\Repositories\SubscribeRepository;
use App\Repositories\ThreadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_block')->except(['index', 'show']);
    }

    public function index(AnswerRepository $answerRepository)
    {
        $answers = $answerRepository->getAll();
//        $answers = resolve(AnswerRepository::class)->getAll();

        return \response()->json($answers, Response::HTTP_OK);
    }

    public function store(StoreAnswerRequest $request, AnswerRepository $answerRepository)
    {
//        $request->validate([
//            'content' => 'required',
//            'thread_id' => 'required'
//        ]);

        //Store Answer In Database
        $answerRepository->store($request);
//        resolve(AnswerRepository::class)->store($request);

        //Add Score For User
        if (auth()->user()->id !== resolve(ThreadRepository::class)->find($request->thread_id)->user_id) {
            auth()->user()->increment('score', 10);
        }

        //send Notification For User Subscribe This Thread
        $notifiable_users_id = resolve(SubscribeRepository::class)->getNotifiableUsers($request->thread_id);
        $notifiable_users = resolve(UserRepository::class)->find($notifiable_users_id);
        Notification::send($notifiable_users, new NewReplySubmitted(resolve(ThreadRepository::class)->find($request->thread_id)));

        return \response()->json([
            'message' => 'answer created successfully.'
        ], Response::HTTP_CREATED);
    }

    public function update(StoreAnswerRequest $request, Answer $answer,AnswerRepository $answerRepository)
    {
//        $request->validate([
//            'content' => 'required'
//        ]);

        if (Gate::forUser(auth()->user())->allows('user-answer', $answer)) {
            $answerRepository->update($request, $answer);
//            resolve(AnswerRepository::class)->update($request, $answer);
            return \response()->json([
                'message' => 'answer updated successfully.'
            ], Response::HTTP_OK);
        }

        return \response()->json([
            'message' => 'access denied.'
        ], Response::HTTP_FORBIDDEN);
    }

    public function destroy(Answer $answer,AnswerRepository $answerRepository)
    {
        if (Gate::forUser(auth()->user())->allows('user-answer', $answer)) {
            $answerRepository->destroy($answer);
//            resolve(AnswerRepository::class)->destroy($answer);
            return \response()->json([
                'message' => 'answer delete successfully.'
            ], Response::HTTP_OK);
        }

        return \response()->json([
            'message' => 'access denied.'
        ], Response::HTTP_FORBIDDEN);
    }

}
