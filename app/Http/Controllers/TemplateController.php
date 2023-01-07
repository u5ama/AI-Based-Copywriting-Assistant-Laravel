<?php

namespace App\Http\Controllers;

use App\Models\ContentTool;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemplateController extends Controller
{

    public function index(Request $request)
    {
        $contentTools = ContentTool::all()->toArray();
        return Inertia::render('App', compact('contentTools'));
    }
}
