<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StorePartnerRequest;
use App\Http\Requests\UpdatePartnerRequest;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Category;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $partners = Partner::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
        return view('dashboard.partners.index', compact('partners'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where(['type' => 2 ])-> get();
        return view('dashboard.partners.create', compact('categories'));
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'logo']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> logo){
                $logo_path = uploadImage('uploads/partners/',  $request -> logo);
                $request_data['logo'] = $logo_path;
            } else {
                $request_data['logo'] = 'default.png';
            }

            $partner =  Partner::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('dashboard.partners.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact System Admin');
            return redirect()->route('dashboard.partners.index');
        }// end of try & catch

    }// end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
            $partner = Partner::find($id);
            $categories = Category::where(['type' => 2 ])-> get();

            if(!$partner){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.partners.index');
            }

            return view('dashboard.partners.edit', compact(['partner', 'categories']));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.partners.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerRequest  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdatePartnerRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $partner = Partner::find($id);

            if(!$partner){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('dashboard.partners.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'logo']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> logo){
                if ($partner -> logo != 'default.png') {
                    Storage::disk('public_uploads')->delete('/partners/' . $partner -> logo);
                } // end of inner if
                $logo_path = uploadImage('uploads/partners/',  $request -> logo);
                $request_data['logo'] = $logo_path;
            } else {
                $request_data['logo'] = $partner -> logo;
            }// end of outer if

            $partner -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('dashboard.partners.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.partners.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::find($id);
        if (!$partner) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('dashboard.partners.index');
        }

        try {
            if ($partner->logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/partners/' . $partner->logo);
            }

            $partner->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('dashboard.partners.index');
        } catch (\Exception $exception) {
            return $exception;
            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.partners.index');
        } // end of try -> catch

    } // end of destroy
}
