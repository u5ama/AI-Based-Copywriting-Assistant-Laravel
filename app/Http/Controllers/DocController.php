<?php

namespace App\Http\Controllers;
use App\Models\Doc;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Doc[]|Collection
     */
    public function index()
    {
        return doc::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $docdata= new Doc();
        $docdata->title=$request->titleinput;
        $docdata->content=$request->contenttextarea;
        $tagsdata=serialize($request->tags);
        $docdata->tag=$tagsdata;
        $docdata->language=$request->language;
        $docdata->length=$request->message;
        $docdata->doccontent=$request->getHTML;
        $docdata->user_id= Auth::user()->id;
        $docdata->save();
        Doc::created($request->all());
        return response('');
    }

    /**
     * Display the specified resource.
     *
     * @param Doc $doc
     * @return JsonResponse
     */
    public function show( Doc $doc)
    {
        $docdata = Doc::paginate(3);
        return response()->json($docdata);
    }
    public function referrerRedirect($id)
    {
        // right a query to fetch data from database product table match with $id
        $this->data['docData'] = Doc::where('id', '=', $id)->firstOrFail();
        if(!empty($this->data['docData']['tag'])){
            $this->data['docData']['tag'] = unserialize($this->data['docData']['tag']);
        }
        return view('admin.docs.documentview')->with($this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function update( Request $request)
    {
        $docdata = Doc::find($request->id);
        $docdata->title= $request->title;
        $docdata->content = $request->content;
        $docdata->language = $request->language;
        $tagsdata=serialize($request->tag);
        $docdata->tag=$tagsdata;
        $docdata->length=$request->length;
        $docdata->doccontent=$request->doccontent;
        $docdata->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Doc $doc
     * @return void
     */
    public function destroy(Doc $doc)
    {
        //
    }
}
