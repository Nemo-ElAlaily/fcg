<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);

        return view('dashboard.services.index', compact('services'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.services.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> image){
                $image_path = uploadImage('uploads/services/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = 'default.png';
            }

            $service =  Service::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('dashboard.services.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.services.index');
        }// end of try & catch

    } // end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $service = Service::find($id);

            if(!$service){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.services.index');
            }

            return view('dashboard.services.edit', compact('service'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.services.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceRequest  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $service = Service::find($id);

            if(!$service){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('dashboard.services.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> image){
                if ($service -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/services/' . $service -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/services/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = $service -> image;
            }// end of outer if

            $service -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('dashboard.services.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.services.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('dashboard.services.index');
        }

        try {
            if ($service->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/services/' . $service->image);
            }

            $service->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('dashboard.services.index');
        } catch (\Exception $exception) {

            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.services.index');
        } // end of try -> catch
    } // end of destroy
}
