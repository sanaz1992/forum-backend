<?php

namespace App\Http\Controllers\API\V1\Channel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChannelRequest;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{

    /**
     * Get All Channels List
     * @method GET
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllChannelsList(ChannelRepository $channelRepository)
    {
        $channels = $channelRepository->getAll();
//        $channels = resolve(ChannelRepository::class)->getAll();

        return response()->json($channels, Response::HTTP_OK);
    }

    /**
     * Create New Channel
     * @method POST
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(StoreChannelRequest $request,ChannelRepository $channelRepository)
    {
//        //Validate Form Inputs
//        $request->validate([
//            'name' => ['required']
//        ]);

        //Store New Channel In DataBase
        $channelRepository->create($request);
//        resolve(ChannelRepository::class)->create($request);

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
    public function update(StoreChannelRequest $request,ChannelRepository $channelRepository)
    {
//        //Validate Form Inputs
//        $request->validate([
//            'id' => ['required'],
//            'name' => ['required'],
//        ]);

        //Update Channel
       $channelRepository->update($request);
//        resolve(ChannelRepository::class)->update($request);

        return \response()->json([
            'message' => 'channel edited successfully.'
        ], Response::HTTP_OK);
    }

    public function delete(StoreChannelRequest $request ,ChannelRepository $channelRepository)
    {
//        //Validate Form Inputs
//        $request->validate([
//            'id' => ['required', 'numeric'],
//        ]);

        //Delete Channel From DataBase
        $channelRepository->delete($request->id);
//        resolve(ChannelRepository::class)->delete($request->id);

        return \response()->json([
            'message' => 'channel deleted successfuly.'
        ], Response::HTTP_OK);
    }
}
