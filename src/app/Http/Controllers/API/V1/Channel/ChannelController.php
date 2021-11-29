<?php

namespace App\Http\Controllers\API\V1\Channel;

use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    use RefreshDatabase;

    /**
     * Get All Channels List
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllChannelsList()
    {
        $channels = resolve(ChannelRepository::class)->getAll();

        return response()->json($channels, Response::HTTP_OK);
    }

    /**
     * Create New Channel
     * @method POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        //Validate Form Inputs
        $request->validate([
            'name' => ['required']
        ]);

        //Store New Channel In DataBase
        resolve(ChannelRepository::class)->create($request);

        return \response()->json([
            'message' => 'channel created successfully.'
        ], Response::HTTP_CREATED);
    }

    /**
     * Update Channel
     * @method PUT
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        //Validate Form Inputs
        $request->validate([
            'id' => ['required'],
            'name' => ['required'],
        ]);

        //Update Channel
        resolve(ChannelRepository::class)->update($request);

        return \response()->json([
            'message' => 'channel edited successfully.'
        ], Response::HTTP_OK);
    }

    public function delete(Request $request)
    {
        //Validate Form Inputs
        $request->validate([
            'id' => ['required', 'numeric'],
        ]);

        //Delete Channel From DataBase
        resolve(ChannelRepository::class)->delete($request->id);

        return \response()->json([
            'message' => 'channel deleted successfuly.'
        ], Response::HTTP_OK);
    }
}
