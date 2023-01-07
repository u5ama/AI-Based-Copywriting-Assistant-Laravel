<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProjects;
use App\Models\AdResponse;
use App\Models\ProjectsModel;
use App\Models\UserFavourite;
use App\Models\User;
use App\Models\Ads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->User = new User();
    }

    /**
     * Method to update user current project
     * @param Request $request
     * @return JsonResponse|RedirectResponse JSON
     */
	public function updateUserProject(Request $request)
	{
		try {
            $project_id = $request->project_id;
			$user = User::where('id', Auth::user()->id)->first(); // Fetch user data
			$user->current_project = $project_id;
			$user->save(); // Update user current project
            return redirect()->back();
		}
        catch(\Exception $err){
    		Log::error('Error in updateUserProject on ProjectController :'. $err->getMessage());
    		return response()->json(['status' => false]);
    	}
	}

    /**
     * Method to create Project
     * @param Request $request
     * @return string
     */
	public function createProject(Request $request)
	{
        $request->validate([
            "name" => "required",
        ]);
        if($request->project_id == '') {
            $project = new ProjectsModel();
        } else {
            $project = ProjectsModel::find($request->project_id);
        }
        $project->name = $request->name;
        $project->user_id = Auth::user()->id;
        if($project->save()) { // Update user current project
            if($request->project_id == '') {
                $userproject = new UserProjects();
                $userproject->user_id = Auth::user()->id;
                $userproject->project_id = $project->id;
                $userproject->save();
                $user = User::where('id', Auth::user()->id)->first(); // Fetch user data
                $user->current_project = $userproject->project_id;
                $user->save();
            }
            return redirect()->back();
        }
        else {
            return "failed to update";
        }
	}

	public function deleteProject(Request $request)
	{
		try {
            $project_id = $request->project_id;
			$project = ProjectsModel::find($project_id);
			if($project) {
                ProjectsModel::where('id',$project_id)->delete();
                UserProjects::where(['project_id'=>$project_id, 'user_id'=>Auth::user()->id])->delete();
                return redirect()->back();
			} else {
                return redirect()->back();
			}
		}
        catch(\Exception $err){
    		Log::error('Error in deleteProject on ProjectController :'. $err->getMessage());
    		return response()->json(['status' => false]);
    	}
	}

	public function allContents(Request $request)
	{
		try {
			$userData = User::where('id', $this->data['user']['userID'])->first();
			$this->data['contents'] = AdResponse::where(['user_id' => $userData->id, 'project_id' => $userData->current_project])->with('ads')->paginate(9);
			$this->data['total_contents'] = AdResponse::where(['user_id' => $userData->id, 'project_id' => $userData->current_project])->with('ads')->count();
			$this->data['projects'] = $this->getProjectList();
            $this->data['currentUser'] = User::where('id', $this->data['user']['userID'])->first();
			return view('admin.content.index', $this->data);
		}
        catch(\Exception $err){
    		Log::error('Error in allContents on ProjectController :'. $err->getMessage());
    		return back()->with('error', 'Oops! Something went wrong.');
    	}
	}

	public function allContentsData(Request $request)
	{
		try {
			$userData = User::where('id', $this->data['user']['userID'])->first();
            $this->data['contents'] = AdResponse::with('UserFavourite')->where(['project_id' => $userData->current_project])->orderBy('id', 'desc')->with('ads' ,'ads.ContentTool')->paginate(9)->onEachSide(0);
            $this->data['page'] =(string)\View::make('components/content', $this->data);
			$this->data['status'] = true;
			return response()->json($this->data);
		}
        catch(\Exception $err){
    		Log::error('Error in allContents on ProjectController :'. $err->getMessage());
    		return back()->with('error', 'Oops! Something went wrong.');
    	}
	}

	public function allFavoritesData(Request $request)
	{
		try {
			$userData = User::where('id', $this->data['user']['userID'])->first();
			$this->data['contents'] = AdResponse::join('user_favourites', 'user_favourites.ad_response_id', '=', 'ad_responses.id')
									->select('ad_responses.*')
									->where(['project_id' => $userData->current_project])
									->orderBy('ad_responses.id', 'desc')
									->with('ads')->paginate(9)
                                    ->onEachSide(0);
			$this->data['page'] = (string)\View::make('components/content',$this->data);
			$this->data['status'] = true;
			return response()->json($this->data);
		}
        catch(\Exception $err){
    		Log::error('Error in allFavouritesData on ProjectController :'. $err->getMessage());
    		return back()->with('error', 'Oops! Something went wrong.');
    	}
	}

	public function allTrashedsData(Request $request)
	{
		try {
			$userData = User::where('id', $this->data['user']['userID'])->first();
			$this->data['contents'] = AdResponse::where([ 'project_id' => $userData->current_project])
									->onlyTrashed()
									->orderBy('id', 'desc')
									->with('ads')
                                    ->paginate(9)
                                    ->onEachSide(0);
            $this->data['deleted'] = true;
			$this->data['page'] = (string)\View::make('components/content',$this->data);
			$this->data['status'] = true;
			return response()->json($this->data);
		}
        catch(\Exception $err){
    		Log::error('Error in all TrashedData on ProjectController :'. $err->getMessage());
    		return back()->with('error', 'Oops! Something went wrong.');
    	}
	}

	public function getContentDetails($ads_response_id = 0)
	{
		try {
			$data['content'] = AdResponse::findOrFail($ads_response_id);
			$data['ads'] = Ads::with('ContentTool')->findOrFail($data['content']->ads_id);
			if ($data['ads']->ContentTool){
                $data['ads']->img_url = $data['ads']->ContentTool->icon_path;
                $data['ads']->title = $data['ads']->ContentTool->title;
            }else{
                $data['ads']->title = $data['ads']->ads_category;

                if($data['ads']->ads_category == 'product-description'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/product-description.png';
                }elseif ($data['ads']->ads_category == 'copy-paste'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/file.png';
                }elseif ($data['ads']->ads_category == 'google'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/google-symbol.svg';
                }elseif ($data['ads']->ads_category == 'pas-framework'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/pas-framework.png';
                }elseif ($data['ads']->ads_category == 'aida-principle'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/sentence-expander.svg';
                }elseif ($data['ads']->ads_category == 'sentence-expander'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/sentence-expander.svg';
                }elseif ($data['ads']->ads_category == 'blog-outline'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/blog-outline.svg';
                }elseif ($data['ads']->ads_category == 'great-headlines'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/headline-generator.svg';
                }elseif ($data['ads']->ads_category == 'persuasive-bullet-points'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/persuasive-bullet-point.png';
                }elseif ($data['ads']->ads_category == 'marketing-angles'){
                    $data['ads']->img_url = 'assets/admin/images/newTemplate/marketing-angles.png';
                }else{
                    $data['ads']->img_url = '/assets/admin/images/newTemplate/google-symbol.svg';
                }
            }
			$data['favorites'] = UserFavourite::where(['ad_response_id' => $ads_response_id, 'user_id' => $this->data['user']['userID']])->first();
			$data['time'] = $data['content']->created_at->diffForHumans();
			$data['url'] = '';
			if($data['ads']->ads_category == 'facebook') {
				$data['url'] = url('facebook-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
				$data['input_url'] = url('facebook-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
			} elseif ($data['ads']->ads_category == 'google') {
				$data['url'] = url('google-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
				$data['input_url'] = url('google-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
			} elseif ($data['ads']->ads_category == 'product-description') {
				$data['url'] = url('product-description/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
				$data['input_url'] = url('product-description/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
			} elseif ($data['ads']->ads_category == 'facebook-headline') {
				$data['url'] = url('facebook-headline/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
				$data['input_url'] = url('facebook-headline/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
			} elseif ($data['ads']->ads_category == 'copy-paste') {
				$data['url'] = url('copypaste/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
				$data['input_url'] = url('copypaste/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
			}elseif ($data['ads']->ads_category == 'pas-framework') {
                $data['url'] = url('pas-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('pas-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }elseif ($data['ads']->ads_category == 'aida-principle') {
                $data['url'] = url('aida-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('aida-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }elseif ($data['ads']->ads_category == 'sentence-expander') {
                $data['url'] = url('sentence-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('sentence-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }elseif ($data['ads']->ads_category == 'blog-outline') {
                $data['url'] = url('blog-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('blog-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }elseif ($data['ads']->ads_category == 'great-headlines') {
                $data['url'] = url('great-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('great-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }elseif ($data['ads']->ads_category == 'persuasive-bullet-points') {
                $data['url'] = url('persuasive-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('persuasive-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }elseif ($data['ads']->ads_category == 'marketing-angles') {
                $data['url'] = url('marketing-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                $data['input_url'] = url('marketing-ad/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
            }else{
                if ($data['ads']->ContentTool){
                    $data['ads']->ads_category = $data['ads']->ContentTool->uri;
                    $data['url'] = url($data['ads']->ads_category.'/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id).'/'.encrypt($data['content']->id));
                    $data['input_url'] = url($data['ads']->ads_category.'/'.$data['ads']->company_name.'/'.encrypt($data['ads']->id));
                }
            }
			if($data['content'] != null) {
				return response()->json(['status' => true, 'data'=> $data]);
			}
			return response()->json(['status' => false, 'data'=> $data]);
		}
        catch(\Exception $err){
    		Log::error('Error in getContentDetails on ProjectController :'. $err->getMessage());
    		return response()->json(['status' => false]);
    	}
	}

	public function deleteResponse($ads_response_id = 0)
	{
		try {
			$response = AdResponse::findOrFail($ads_response_id);
			if($response) {
				$response->delete();
				return response()->json(['status' => true]);
			}
			return response()->json(['status' => false]);
		}
        catch (\Throwable $th) {
			Log::error('Error in deleteResponse on ProjectController :'. $th->getMessage());
    		return back()->with('error', 'Oops! Something went wrong.');
		}
	}

	public function favourite($ads_response_id = 0)
	{
		try {
			$response = UserFavourite::where(['ad_response_id' => $ads_response_id, 'user_id' => $this->data['user']['userID']])->first();
			if($response) {
				$response->delete();
				return response()->json(['status' => true, 'action' => 'remove']);
			} else {
				$ad_favourite = new UserFavourite;
				$ad_favourite->user_id = $this->data['user']['userID'];
				$ad_favourite->ad_response_id = $ads_response_id;
                $ad_favourite->created_at = Carbon::now();
				$ad_favourite->save();
				return response()->json(['status' => true, 'action' => 'add']);
			}
		}
        catch (\Throwable $th) {
			Log::error('Error in deleteResponse on ProjectController :'. $th->getMessage());
    		return back()->with('error', 'Oops! Something went wrong.');
		}
	}
	public function restore($ads_response_id = 0)
	{
        try {
             AdResponse::withTrashed()->find($ads_response_id)->restore();
             return response()->json(['status' => true]);
        }
        catch (\Throwable $th) {
            Log::error('Error in restore on ProjectController :'. $th->getMessage());
            return back()->with('error', 'Oops! Something went wrong.');
        }
	}

	public function updateResponse(Request $request)
	{
        $request->validate([
            "message" => "required",
        ]);
        $ads_response_id = $request->response_id;
        $response = AdResponse::findOrFail($ads_response_id);
        if($response) {
            $response->description = $request->message;
            $response->update();
        }
        return redirect()->back();
	}
}
