<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
        return view('dashboard.clients.index', compact('clients'));
    } // end of index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'logo']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> logo){
                $logo_path = uploadImage('uploads/clients/',  $request -> logo);
                $request_data['logo'] = $logo_path;
            } else {
                $request_data['logo'] = 'default.png';
            }

            $client =  Client::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('dashboard.clients.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact System Admin');
            return redirect()->route('dashboard.clients.index');
        }// end of try & catch

    }// end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $client = Client::find($id);

            if(!$client){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.clients.index');
            }

            return view('dashboard.clients.edit', compact('client'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.clients.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateClientRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $client = Client::find($id);

            if(!$client){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('dashboard.clients.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method', 'logo']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> logo){
                if ($client -> logo != 'default.png') {
                    Storage::disk('public_uploads')->delete('/clients/' . $client -> logo);
                } // end of inner if
                $logo_path = uploadImage('uploads/clients/',  $request -> logo);
                $request_data['logo'] = $logo_path;
            } else {
                $request_data['logo'] = $client -> logo;
            }// end of outer if

            $client -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('dashboard.clients.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.clients.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('dashboard.clients.index');
        }

        try {
            if ($client->logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/clients/' . $client->logo);
            }

            $client->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('dashboard.clients.index');
        } catch (\Exception $exception) {

            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.clients.index');
        } // end of try -> catch

    } // end of destroy
}
