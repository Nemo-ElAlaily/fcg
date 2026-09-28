<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreProjectRequest;
use App\Jobs\OptimizeImage;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Project;
use App\Models\Category;
use App\Models\Client;
use App\Models\Service;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::with(['category', 'client'])
            ->when($request -> search , function ($query) use ($request) {
                return $query -> where('title', 'like' , '%' . $request -> search . '%');
            })->latest()->paginate(defined('ADMIN_PAGINATION_COUNT') ? ADMIN_PAGINATION_COUNT : 10);
        return view('dashboard.projects.index', compact('projects'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where(['type' => 1 ])-> get();
        $clients = Client::where(['is_active' => 1 ])-> get();
        $services = Service::where(['is_active' => 1 ])-> get();
        return view('dashboard.projects.create', compact('categories', 'clients', 'services'));
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request->has('is_awarded') ? $request->request->add(['is_awarded' => 1]) : $request->request->add(['is_awarded' => 0]);
            $request->has('add_to_home') ? $request->request->add(['add_to_home' => 1]) : $request->request->add(['add_to_home' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image', 'gallery', 'services']);
            $request_data['slug'] = str_replace($characters, '-' , $request['title']);

            DB::beginTransaction();

            $image_path = "";
            if($request->hasFile('image')){
                $image = uploadImage('uploads/projects/',  $request -> image);
                OptimizeImage::dispatch(public_path('uploads/projects/' . $image))->onQueue('images');
                $request_data['image'] = $image;
            } else {
                $request_data['image'] = 'default.png';
            }

            if($request->hasFile('gallery')){
                $gallery_arr = [];
                foreach ( $request -> gallery as $index => $item){
                    $image_path = uploadImage('uploads/projects/gallery/',  $item);
                    OptimizeImage::dispatch(public_path('uploads/projects/gallery/' . $image_path))->onQueue('images');
                    $gallery_arr += [$index => $image_path,];
                }
                $request_data['gallery'] = json_encode($gallery_arr);
            }

            $project =  Project::create($request_data);

            foreach($request -> services as $service) {
                $project->services()->attach($service);
            }

            event(new \App\Events\CacheInvalidated([
                config('cache_keys.project_categories'),
                config('cache_keys.front.awarded_projects'),
                config('cache_keys.front.home_projects'),
                config('cache_keys.front.latest_projects'),
            ]));
            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('dashboard.projects.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact System Admin');
            return redirect()->route('dashboard.projects.index');
        }// end of try & catch

    } // end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $project  = Project::with('services')->find($id);
            $categories = Category::where(['type' => 1 ])-> get();
            $clients = Client::where(['is_active' => 1 ])-> get();
            $services = Service::where(['is_active' => 1 ])-> get();


            if(!$project){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.projects.index');
            }

            return view('dashboard.projects.edit', compact(['project', 'categories', 'clients', 'services']));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.projects.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $project = Project::find($id);

            if(!$project){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('dashboard.projects.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request->has('is_awarded') ? $request->request->add(['is_awarded' => 1]) : $request->request->add(['is_awarded' => 0]);
            $request->has('add_to_home') ? $request->request->add(['add_to_home' => 1]) : $request->request->add(['add_to_home' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image', 'gallery', 'old_gallery', 'gallery_present', 'services']);

            $request_data['slug'] = str_replace($characters, '-' , $request['title']);

            DB::beginTransaction();

            if($request -> file('image')){
                if ($project -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/projects/' . $project -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/projects/',  $request -> image);
                OptimizeImage::dispatch(public_path('uploads/projects/' . $image_path))->onQueue('images');
                $request_data['image'] = $image_path;
            }

            // The edit form always submits `gallery_present`; kept images come back as `old_gallery[]`
            // (their keys in the stored JSON), new uploads as `gallery[]` files.
            if($request->has('gallery_present')){
                $existing = $project->gallery ? json_decode($project->gallery, true) : [];
                $kept_ids = array_map('strval', (array) $request->input('old_gallery', []));
                $gallery_arr = [];

                foreach ($existing as $index => $item) {
                    if (in_array((string) $index, $kept_ids, true)) {
                        $gallery_arr[$index] = $item;
                    } else {
                        Storage::disk('public_uploads')->delete('/projects/gallery/' . $item);
                    }
                }

                $next_index = $existing ? max(array_map('intval', array_keys($existing))) + 1 : 0;
                foreach ((array) $request->file('gallery') as $item){
                    $image_path = uploadImage('uploads/projects/gallery/',  $item);
                    OptimizeImage::dispatch(public_path('uploads/projects/gallery/' . $image_path))->onQueue('images');
                    $gallery_arr[$next_index++] = $image_path;
                }

                $request_data['gallery'] = $gallery_arr ? json_encode($gallery_arr) : null;
            }

            $project -> update($request_data);

            $project->services()->sync($request -> services);
            event(new \App\Events\CacheInvalidated([
                config('cache_keys.project_categories'),
                config('cache_keys.front.awarded_projects'),
                config('cache_keys.front.home_projects'),
                config('cache_keys.front.latest_projects'),
            ]));

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('dashboard.projects.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.projects.index');

        } // end of try & catch
    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $project = Project::find($id);


            if($project -> image != 'default.png'){
                Storage::disk('public_uploads')->delete('/projects/' . $project ->image);
            }

            if ($project -> gallery != null) {
                foreach (json_decode($project->gallery, true) as $index => $item) {
                    Storage::disk('public_uploads')->delete('/projects/gallery/' . $item);
                }
                $project->update(['gallery' => null]);
            } // end of inner if

            $project -> delete();
            event(new \App\Events\CacheInvalidated([
                config('cache_keys.project_categories'),
                config('cache_keys.front.awarded_projects'),
                config('cache_keys.front.home_projects'),
                config('cache_keys.front.latest_projects'),
            ]));

            session()->flash('success', 'Project Deleted Successfully');
            return redirect()->route('dashboard.projects.index');

        } catch (\Exception $exception) {

            session()->flash('error', 'Something Went Wrong, Please Contact Administrator');
            return redirect()->route('dashboard.projects.index');

        }
    }
}
