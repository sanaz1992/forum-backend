<?php


namespace App\Repositories;


use App\Models\Answer;
use App\Models\Channel;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnswerRepository
{
    public function getAll()
    {
        return Answer::latest()->get();
    }

    public function store(Request $request)
    {
        Answer::create([
            'content' => $request->input('content'),
            'thread_id' => $request->input('thread_id'),
            'user_id' => auth()->user()->id
        ]);
    }

    public function update(Request $request, Answer $answer)
    {
        $answer->update([
            'content' => $request->input('content')
        ]);
    }

    public function destroy(Answer $answer)
    {
        $answer->delete();
    }
}
