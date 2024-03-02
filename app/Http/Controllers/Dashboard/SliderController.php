<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = Slider::when($request -> search , function ($query) use ($request) {
            return $query -> where('title', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);

        return view('dashboard.sliders.index', compact('sliders'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sliders.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> image){
                $image_path = uploadImage('uploads/sliders/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = 'default.png';
            }

            $slider =  Slider::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('dashboard.sliders.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.sliders.index');
        }// end of try & catch

    } // end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $slider = Slider::find($id);

            if(!$slider){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.sliders.index');
            }

            return view('dashboard.sliders.edit', compact('slider'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.sliders.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $slider = Slider::find($id);

            if(!$slider){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('dashboard.sliders.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);


            DB::beginTransaction();

            $imagePath = "";
            if($request -> image){
                if ($slider -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/sliders/' . $slider -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/sliders/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = $slider -> image;
            }// end of outer if

            $slider -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('dashboard.sliders.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.sliders.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('dashboard.sliders.index');
        }

        try {
            if ($slider->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/sliders/' . $slider->image);
            }

            $slider->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('dashboard.sliders.index');
        } catch (\Exception $exception) {

            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.sliders.index');
        } // end of try -> catch

    } // end of destroy

} // end of controller
