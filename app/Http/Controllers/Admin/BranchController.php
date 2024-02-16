<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branches = Branch::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> image){
                $image_path = uploadImage('uploads/branches/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = 'default.png';
            }

            $branch =  Branch::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('admin.branches.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'contact admin');
            return redirect()->route('admin.branches.index');
        }// end of try & catch

    } // end of store


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $branch = Branch::find($id);

            if(!$branch){
                session()->flash('error', 'Does not exist');
                return redirect()->route('admin.branches.index');
            }

            return view('admin.branches.edit', compact('branch'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('admin.branches.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchRequest  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateBranchRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $branch = Branch::find($id);

            if(!$branch){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('admin.branches.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> image){
                if ($branch -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/branches/' . $branch -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/branches/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = $branch -> image;
            }// end of outer if

            $branch -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('admin.branches.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('admin.branches.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('admin.branches.index');
        }

        try {
            if ($branch->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/branches/' . $branch->image);
            }

            $branch->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('admin.branches.index');
        } catch (\Exception $exception) {

            session()->flash('error', 'contact admin');
            return redirect()->route('admin.branches.index');
        } // end of try -> catch

    } // end of destroy

} // end of controller
