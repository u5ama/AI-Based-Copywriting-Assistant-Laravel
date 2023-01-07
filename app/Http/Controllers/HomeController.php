<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\Pricing;
use App\Models\NewsLetter;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

  	/**
    * Method to show landing page
    */
    public function index(Request $request)
    {
        $this->data['package']  = Pricing::where('id','>','0')->first();
        $this->data['page_content'] = PageContent::where('id','>','0')->first();
        return Inertia::render('Landing');
    }

  	/**
    * Method to show privacy page
    */
    public function privacy()
    {
        return view('home.privacy', $this->data);
    }

  	/**
    * Method to show privacy page
    */
    public function terms()
    {
        return view('home.terms', $this->data);
    }

	/**
    * Method to show website page
    */
    public function website(Request $request)
    {
        $this->data['package']  = Pricing::where('id','>','0')->first();
        $this->data['page_content'] = PageContent::where('id','>','0')->first();
        return view('home.index',$this->data);
    }

    /**
    * Method to store newsletter email
    */
    public function submitNewsletter(Request $request)
	{
		$count=NewsLetter::where('email', $request->email)->count();
		if($count > 0) {
			$data['status']=0;
			$data['message']="Thanks! We'll be in touch.";
		} else {
			$data= new NewsLetter;
			$data->email = $request->email;
			if($data->save()) {
				$data['status']=1;
				$data['message']="Thanks! We'll be in touch.";
			}else{
				$data['status']=0;
				$data['message']='Ops Something went wrong !!!';
			}
		}
		return json_encode($data);
	}

    public function members($value='')
    {
    	$user_id=$this->data['user']['id'];
    	$this->data['profile']=User::where('id',$user_id)->first();
    	$userR=$this->data['profile'];
    	$refers=User::where('parent_member',$this->data['profile']['parent_member'])->where('parent_member','!=',0)->get();
        return Inertia::render('members/Index', compact('userR','refers'));
    }

    public function deleteRef($value=0)
    {
        if(auth()->user()->linked_user_role =='admin'){
            $value = (int)$value;
            $UserDelete = User::findOrFail($value);
            if($UserDelete){
                $UserDelete->where('parent_member', auth()->user()->id);
                $UserDelete->delete();
                return response()->json(['Success' => 'true'],200);
            }
            else{
                return response()->json(['Success' => 'false'],400);
            }
        }
    }

    public function updateRef(Request $request,$value='')
    {
       	 User::find($value)->update(['linked_user_role'=>$request->linked_user_role]);
       	 return back()->with('msg','Record Successfully Updated!');
    }

    public function updatelink($value='')
    {
      	User::find($value)->update(['linkout'=>md5(rand(00000,99999))]);
        return response()->json(['Success' => 'true'],200);
    }

    public function login()
    {
        return view('login1', $this->data);
    }
}
