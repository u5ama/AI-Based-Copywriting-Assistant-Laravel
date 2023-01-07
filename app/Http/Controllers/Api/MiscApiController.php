<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdResponse;
use App\Models\ContentTool;
use App\Models\User;
use App\Models\UserFavourite;
use Illuminate\Http\Request;

class MiscApiController extends Controller
{
    public function getTools()
    {
        $tools = ContentTool::get();
        if($tools) {
            $response = [
                'success' => true,
                'results'    => $tools,
                'message' => "Content tools get successfully",
            ];
             return response()->json($response, '200');
        }else {
            $response = [
                'success' => false,
                'message' => "failed to get content tools",
            ];
            return response()->json($response, '400');
        }
    }

    public function makeContentFavourite(Request $request)
    {
        $adsContent = AdResponse::find($request->addResponseId);
        $existFavourite = UserFavourite::where('ad_response_id', $request->addResponseId)->first();

        if (!$existFavourite) {
            $favourite = new UserFavourite();
            $favourite->user_id = $adsContent->user_id;
            $favourite->ad_response_id  = $request->addResponseId;
            $favourite->save();
            return response()->json("success", '200');
        } else {
            Log::error("Failed to make content favourite from api");
        }
    }

    public function getTeammembers(Request $request)
    {
       return User::where('parent_member', $request->authUserId)->get();
    }
}


