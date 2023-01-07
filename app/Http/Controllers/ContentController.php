<?php

namespace App\Http\Controllers;

use App\Models\AdResponse;
use App\Models\ContentTool;
use App\Models\ToolColor;
use App\Models\UserFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ContentController extends Controller
{
    // function for get all content for authenticate user
    public function allContent()
    {
       $user = Auth::user();
       $contents = AdResponse::where(['user_id' => $user->id, 'project_id' => $user->current_project])->where('description', '!=', '')->paginate(6);
        foreach ($contents->items() as $key => $content) {
            $contents[$key]['isFavourite'] = UserFavourite::where('ad_response_id', $content->id)->where('user_id', $user->id)->first() ? true : false;
            $contents[$key]['ads'] = $content->ads;
            $tool = ContentTool::where('uri', $content->ads->ads_category)->first();
            $color = ToolColor::where('content_tool_id', $tool->id)->where('user_id', $user->id)->first();
            $contents[$key]['color'] = $color ? $color->color : '';
        }
        $records = $contents;
        return Inertia::render('content/Index', compact('records'));
    }

    // function for get all favourite content for authenticate user
    public function getFavouriteContent()
    {
            $user = Auth::user();
            $favouriteContents = UserFavourite::where('user_id', $user->id)->get();

            foreach ($favouriteContents as $key => $favouriteContent) {

                $favouriteContents[$key]['content'] = AdResponse::where(['id' => $favouriteContent->ad_response_id])->withTrashed()->first();
                $content = AdResponse::with('ads')->where(['id' => $favouriteContent->ad_response_id])->withTrashed()->first();

                $tool = ContentTool::where('uri', $content->ads->ads_category)->first();
                $color = ToolColor::where('content_tool_id', $tool->id)->where('user_id', $user->id)->first();

                $favouriteContents[$key]['color'] = $color ? $color->color : '';
                $favouriteContents[$key]['ads'] = $content->ads;
            }

            return Inertia::render('content/Favourite', compact('favouriteContents'));
    }

    // function for get all trashed content for authenticate user
    public function getTrashedContent()
    {
        $user = Auth::user();
        $contents = AdResponse::onlyTrashed()->where(['user_id' => $user->id, 'project_id' => $user->current_project])->where('description', '!=', '')->get();
        foreach ($contents as $key => $content) {
            $contents[$key]['isFavourite'] = UserFavourite::where('ad_response_id', $content->id)->where('user_id', $user->id)->first() ? true : false;
            $contents[$key]['ads'] = $content->ads;
            $tool = ContentTool::where('uri', $content->ads->ads_category)->first();
            $color = ToolColor::where('content_tool_id', $tool->id)->where('user_id', $user->id)->first();
            $contents[$key]['color'] = $color ? $color->color : '';
        }
        return Inertia::render('content/Trash', compact('contents'));
    }

    public function favouriteContent(Request $request)
    {
        $responseId = $request->responseId;
        $adsResponse = AdResponse::where('id', $responseId)->where('user_id', Auth::user()->id)->first();
        // check if the content belongs to the requested user or not
        if ($adsResponse) {
            $existFavourite = UserFavourite::where('ad_response_id', $responseId)->where('user_id', Auth::user()->id)->first();
            // check if already in favourite or not
            if (!$existFavourite) {
                $favourite = new UserFavourite();
                $favourite->user_id = Auth::user()->id;
                $favourite->ad_response_id  = $responseId;
                if ($favourite->save()) {
                    // TODO::flash message with favourite success
                    return redirect()->back();
                }
            } else {
                // TODO::flash message with this content already favourite
                return redirect()->back();
            }
        } else {
            // TODO::flash message
            return redirect()->back();
        }
    }

    public function contentRemoveFromFavourite(Request $request)
    {
        $responseId = $request->responseId;
        $favourite = UserFavourite::where('ad_response_id', $responseId)->where('user_id', Auth::user()->id)->first();
        // check if the content belongs to the requested user or not
        if ($favourite->delete()) {
            // TODO::flash message
        } else {
            // TODO::flash message
        }
        return redirect()->back();
    }

    public function deleteContent(Request $request)
    {
        $responseId = $request->responseId;
        $adsResponse = AdResponse::withTrashed()->find($responseId);
        // check if the content belongs to the requested user or not
        if ($adsResponse->delete()) {
            // get if this content is favourite
            $existFavourite = UserFavourite::where('ad_response_id', $responseId)->where('user_id', Auth::user()->id)->first();
            if ($existFavourite) {
                $existFavourite->delete();
            }
        } else {
            // TODO::flash message
        }
        return redirect()->back();
    }

    public function forceDeleteContent(Request $request)
    {
        $responseId = $request->responseId;
        $adsResponse = AdResponse::where('id', $responseId)->withTrashed()->first();
        // check if the content belongs to the requested user or not
        if ($adsResponse->forceDelete()) {
            // TODO::flash message
        } else {
            // TODO::flash message
        }
        return redirect()->back();
    }

    public function contentRestoreAndFavourite(Request $request)
    {
        $responseId  = $request->responseId;
        $adsResponse = AdResponse::where('id', $responseId)->withTrashed()->first();
        if ($adsResponse->restore()) {
            $favourite = new UserFavourite();
            $favourite->user_id = Auth::user()->id;
            $favourite->ad_response_id  = $responseId;

            if ($favourite->save()) {
                // TODO::flash message with favourite success
            }
        } else {
            // TODO::flash message
        }
        return redirect()->back();
    }
}
