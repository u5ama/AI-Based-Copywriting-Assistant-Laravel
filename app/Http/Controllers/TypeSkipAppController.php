<?php

namespace App\Http\Controllers;

use App\Models\AdResponse;
use App\Models\Ads;
use App\Models\ContentTool;
use App\Models\ToolColor;
use App\Models\UserFavourite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TypeSkipAppController extends Controller
{
    public function showApplication(Request $request, $slug, $title = '', $id = '', $response_id = 0)
    {
        $user = auth()->user();
        $tool      = ContentTool::where('uri', $slug)->first();
        $toolColor = ToolColor::where('content_tool_id', $tool->id)->where('user_id', $user->id)->first();
        $toolColor = $toolColor ? $toolColor->color : '';
        $tempData  = [];
        if ($tool) {
            $requiredItems = $tool->contentToolItems->toArray();
            $tool          = $tool->toArray();
            $lastAdd = Ads::where(['user_id'=> $user->id, 'project_id' => $user->current_project, 'ads_category'=> $slug])
                ->orderBy('id', 'desc')
                ->first();
            if ($lastAdd) {
                $lastAdd = $lastAdd->toArray();
            } else {
                $lastAdd = "";
            }
            foreach ($requiredItems as $item) {

                if ($item['input_type'] == 'multi-select') {
                    if ($lastAdd) {
                        if (str_contains($lastAdd["add_keywords"], '["')) {
                            $item['value'] = json_decode($lastAdd["add_keywords"]);
                        }else{
                            $keywords = explode(',',$lastAdd["add_keywords"]);
                            $item['value'] = $keywords;
                        }
                    } else {
                        $item['value'] = [];
                    }
                } else {
                    if ($item['key'] == 'product_description') {
                        if ($lastAdd) {
                            $item['value'] = $lastAdd["description"];
                        } else {
                            $item['value'] = null;
                        }
                    } elseif ($item['key'] ==  "brand_name") {
                        if ($lastAdd) {
                            $item['value'] = $lastAdd["company_name"];
                        } else {
                            $item['value'] = null;
                        }
                    }elseif ($item['key'] ==  "key_words") {
                        if ($lastAdd) {
                            if (str_contains($lastAdd["add_keywords"], '"')) {
                                $item['value'] = json_decode($lastAdd["add_keywords"]);
                            }else{
                                $keywords = explode(',',$lastAdd["add_keywords"]);
                                $item['value'] = $keywords;
                            }
                        } else {
                            $item['value'] = null;
                        }
                    } else {
                        $item['value'] = null;
                    }
                }
                array_push($tempData, $item);
            }

            $requiredItems = $tempData;

            $ads_id = Ads::where('ads_category', $tool['uri'])
                ->where(['user_id'=> $user->id, 'project_id' => $user->current_project])
                ->pluck('id')
                ->toArray();
            $adsResponse = AdResponse::whereIn('ads_id', $ads_id)
                ->where('description', '!=', '')
                ->where('project_id', $user->current_project)
                ->orderBy('id', 'desc')
                ->get();
            foreach ($adsResponse as $key => $content) {
                $adsResponse[$key]['isFavourite'] = UserFavourite::where('ad_response_id', $content->id)->where('user_id', $user->id)->first() ? true : false;
                $adsResponse[$key]['ads']         = $content->ads;
            }
            return Inertia::render('Generators/App', compact('tool', 'requiredItems', 'adsResponse', 'lastAdd', 'toolColor'));
        }
        return redirect()->back();
    }
}
