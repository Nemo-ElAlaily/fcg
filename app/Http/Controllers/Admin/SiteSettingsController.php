<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreSiteSettingsRequest;
use App\Http\Requests\UpdateSiteSettingsRequest;
use App\Models\Settings\SiteSettings;

class SiteSettingsController extends Controller
{
    public function generalShow($id)
    {
        $site_settings = SiteSettings::findorFail($id);
        return view('admin.site_settings.index', compact('site_settings'));
    } // end of general show

    public function generalUpdate($id, UpdateSiteSettingsRequest $request)
    {
        $site_settings = SiteSettings::findorFail($id);
        $request_data = $request->except(['_token', '_method']);
        $logoPath = "";
        if($request->logo){
            if ($site_settings -> logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/site/' . $site_settings -> logo);
            } // end of inner if
            $logoPath = uploadImage('uploads/site/',  $request -> logo);
        } else {
            $logoPath = $site_settings -> logo;
        }// end of outer if

        $faviconPath = "";
        if($request->favicon){
            if ($site_settings -> favicon != 'favicon.png') {
                Storage::disk('public_uploads')->delete('/site/' . $site_settings -> favicon);
            } // end of inner if
            $faviconPath = uploadImage('uploads/site/',  $request -> favicon);
        } else {
            $faviconPath = $site_settings -> favicon;
        }// end of outer if

        $storyImagePath = "";
        if($request->story_image){
            if ($site_settings -> story_image != 'default.png') {
                Storage::disk('public_uploads')->delete('/site/' . $site_settings -> story_image);
            } // end of inner if
            $storyImagePath = uploadImage('uploads/site/',  $request -> story_image);
        } else {
            $storyImagePath = $site_settings -> story_image;
        }// end of outer if

        $missionImagePath = "";
        if($request->mission_image){
            if ($site_settings -> mission_image != 'default.png') {
                Storage::disk('public_uploads')->delete('/site/' . $site_settings -> mission_image);
            } // end of inner if
            $missionImagePath = uploadImage('uploads/site/',  $request -> mission_image);
        } else {
            $missionImagePath = $site_settings -> mission_image;
        }// end of outer if

        $visionImagePath = "";
        if($request->vision_image){
            if ($site_settings -> vision_image != 'default.png') {
                Storage::disk('public_uploads')->delete('/site/' . $site_settings -> vision_image);
            } // end of inner if
            $visionImagePath = uploadImage('uploads/site/',  $request -> vision_image);
        } else {
            $visionImagePath = $site_settings -> vision_image;
        }// end of outer if

        $request_data['google_analytics']=$request->google_analytics;
        $request_data['google_client_id']=$request->google_client_id;
        $request_data['google_secret_key']=$request->google_secret_key;
        $request_data['google_redirect']=$request->google_redirect;

        $request_data['facebook_client_id']=$request->facebook_client_id;
        $request_data['facebook_secret_key']=$request->facebook_secret_key;
        $request_data['facebook_redirect']=$request->facebook_redirect;
        // dd($request->facebook_redirect);

        $request_data['logo'] = $logoPath;
        $request_data['favicon'] = $faviconPath;
        $request_data['story_image'] = $storyImagePath;
        $request_data['mission_image'] = $missionImagePath;
        $request_data['vision_image'] = $visionImagePath;
        $site_settings->update($request_data);

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.settings.site.show', $site_settings->id);

    } // end of social update
}
