<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $certificates = Certificate::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);

        return view('admin.certificates.index', compact('certificates'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.certificates.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificateRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> image){
                $image_path = uploadImage('uploads/certificates/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = 'default.png';
            }

            $certificate =  Certificate::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('admin.certificates.index');



        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
            session()->flash('error', 'contact admin');
            return redirect()->route('admin.certificates.index');
        }// end of try & catch
    } // end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $certificate = Certificate::find($id);

            if(!$certificate){
                session()->flash('error', 'Does not exist');
                return redirect()->route('admin.certificates.index');
            }

            return view('admin.certificates.edit', compact('certificate'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('admin.certificates.index');

        } // end of try & catch
    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificateRequest  $request
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCertificateRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $certificate = Certificate::find($id);

            if(!$certificate){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('admin.certificates.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'image']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> image){
                if ($certificate -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/certificates/' . $certificate -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/certificates/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = $certificate -> image;
            }// end of outer if

            $certificate -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('admin.certificates.index');

        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('admin.certificates.index');

        } // end of try & catch
    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificate = Certificate::find($id);
        if (!$certificate) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('admin.certificates.index');
        }

        try {
            if ($certificate->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/certificates/' . $certificate->image);
            }

            $certificate->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('admin.certificates.index');
        } catch (\Exception $exception) {

            session()->flash('error', 'contact admin');
            return redirect()->route('admin.certificates.index');
        } // end of try -> catch

    } // end of destroy
}
