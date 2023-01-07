<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return Inertia::render('userProfile/Index', compact('user'));
    }

    // method for update first name and last name
    public function updateProfileName(Request $request)
    {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
        ]);
        $user = Auth::user();
        $user->fname = $request->first_name;
        $user->lname = $request->last_name;

        if ($user->save()) {
            return redirect()->back();
        } else {
            return "failed to update";
        }
    }

    // method for update first name and last name
    public function updateCompanyInfo(Request $request)
    {
        $request->validate([
            "companyName" => "required",
            "companyDescription" => "required",
        ]);

        $user = Auth::user();
        $user->cmp_name = $request->companyName;
        $user->cmp_description = $request->companyDescription;

        if ($user->save()) {
            return redirect()->back();
        } else {
            return "failed to update";
        }
    }

    // method for update profile photo
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            "img" => "required",
        ]);

        $user = Auth::user();
        if ($request->hasFile('img')) {
            $user->profile = $request->file('img')->store('profile-photo', 'public');
        }
        if ($user->save()) {
            $response = [
                'success' => true,
                'message' => "Image uploaded successfully",
            ];
            return response()->json($response, '200');
        } else {
            $response = [
                'success' => false,
                'message' => "Image not uploaded",
            ];
            return response()->json($response, '400');
        }
    }
}
