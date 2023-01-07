<?php

namespace App\Http\Controllers;

use App\Models\ToolColor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ToolColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $user  = auth()->user();
        // check if tools have color already
        $toolColor = ToolColor::where('user_id', $user->id)->where('content_tool_id', $request->toolid)->first();

        // if already have color then update
        if($toolColor) {
            $toolColor->color = $request->color;
            $toolColor->save();
        }else {
            // else create new color for tools
            $toolColor                  = new ToolColor();
            $toolColor->color           = $request->color;
            $toolColor->user_id         = $user->id;
            $toolColor->content_tool_id = $request->toolid;
            $toolColor->save();
        }
        // TODO:: flash message
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param ToolColor $toolColor
     * @return void
     */
    public function show(ToolColor $toolColor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ToolColor $toolColor
     * @return void
     */
    public function edit(ToolColor $toolColor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ToolColor $toolColor
     * @return void
     */
    public function update(Request $request, ToolColor $toolColor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ToolColor $toolColor
     * @return void
     */
    public function destroy(ToolColor $toolColor)
    {
        //
    }
}
