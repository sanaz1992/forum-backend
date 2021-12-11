<?php


namespace App\Repositories;


use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{
    public function getAll()
    {
        return Channel::all();
    }

    public function create($request): void
    {
        Channel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
    }

    public function update($request)
    {
        Channel::find($request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
    }

    public function delete($id)
    {
        Channel::destroy($id);
    }
}
