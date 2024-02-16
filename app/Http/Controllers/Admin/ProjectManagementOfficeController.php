<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreProjectManagementOfficeRequest;
use App\Http\Requests\UpdateProjectManagementOfficeRequest;
use Illuminate\Http\Request;
use App\Models\ProjectManagementOffice;

class ProjectManagementOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offices = ProjectManagementOffice::when($request -> search , function ($query) use ($request) {
            return $query -> where('title', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
        return view('admin.pmo.index', compact('offices'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pmo.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectManagementOfficeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectManagementOfficeRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> image){
                $image_path = uploadImage('uploads/offices/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = 'default.png';
            }

            $service =  ProjectManagementOffice::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('admin.offices.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'contact admin');
            return redirect()->route('admin.offices.index');
        }// end of try & catch

    } // end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectManagementOffice  $projectManagementOffice
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectManagementOffice $projectManagementOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectManagementOffice  $projectManagementOffice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $office = ProjectManagementOffice::find($id);

            if(!$office){
                session()->flash('error', 'Does not exist');
                return redirect()->route('admin.offices.index');
            }

            return view('admin.pmo.edit', compact('office'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('admin.offices.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectManagementOfficeRequest  $request
     * @param  \App\Models\ProjectManagementOffice  $projectManagementOffice
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateProjectManagementOfficeRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $office = ProjectManagementOffice::find($id);

            if(!$office){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('admin.offices.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> image){
                if ($office -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/offices/' . $office -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/offices/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = $office -> image;
            }// end of outer if

            $office -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('admin.offices.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('admin.offices.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectManagementOffice  $projectManagementOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = ProjectManagementOffice::find($id);
        if (!$office) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('admin.offices.index');
        }

        try {
            if ($office->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/offices/' . $office->image);
            }

            $office->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('admin.offices.index');
        } catch (\Exception $exception) {

            session()->flash('error', 'contact admin');
            return redirect()->route('admin.offices.index');
        } // end of try -> catch

    } // end of destroy
}
