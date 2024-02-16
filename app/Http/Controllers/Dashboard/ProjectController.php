<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
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
        $projects = Project::when($request -> search , function ($query) use ($request) {
            return $query -> where('title', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
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
            if($request -> image){
                $image = uploadImage('uploads/projects/',  $request -> image);
                $request_data['image'] = $image;
            } else {
                $request_data['image'] = 'default.png';
            }

            if($request -> gallery){
                $gallery_arr = [];
                foreach ( $request -> gallery as $index => $item){
                    $image_path = uploadImage('uploads/projects/gallery/',  $item);
                    $gallery_arr += [$index => $image_path,];
                }
                $request_data['gallery'] = json_encode($gallery_arr);
            }

            $project =  Project::create($request_data);

            foreach($request -> services as $service) {
                $project->services()->attach($service);
            }

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
            $request_data = $request -> except(['_token', '_method', 'image', 'gallery', 'services']);

            $request_data['slug'] = str_replace($characters, '-' , $request['title']);

            DB::beginTransaction();

            if($request -> file('image') || $request -> file('gallery')) {
                $imagePath = "";
                if($request -> file('image')){
                    if ($project -> image != 'default.png') {
                        Storage::disk('public_uploads')->delete('/projects/' . $project -> image);
                    } // end of inner if
                    $image_path = uploadImage('uploads/projects/',  $request -> image);
                    $request_data['image'] = $image_path;
                } else {
                    $request_data['image'] = $project -> image;
                }// end of outer if

                if($request -> file('gallery')){

                    if ($project -> gallery != null) {
                        foreach (json_decode($project->gallery, true) as $index => $item) {
                            Storage::disk('public_uploads')->delete('/projects/gallery/' . $item);
                        }
                        $project->update(['gallery' => null]);
                    } // end of inner if


                    $gallery_arr = [];
                    foreach ($request -> file('gallery') as $index => $item){
                        $gallery_arr += [ $index => $item ->hashName(),];
                        $image_path = uploadImage('uploads/projects/gallery/',  $item);
                        $gallery_arr += [$index => $image_path,];
                    }
                    $request_data['gallery'] = json_encode($gallery_arr);
                }
            }

            $project -> update($request_data);

            $project->services()->sync($request -> services);

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

            session()->flash('success', 'Project Deleted Successfully');
            return redirect()->route('dashboard.projects.index');

        } catch (\Exception $exception) {

            session()->flash('error', 'Something Went Wrong, Please Contact Administrator');
            return redirect()->route('dashboard.projects.index');

        }
    }
}
