<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $forms = Contact::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
        return view('dashboard.contact.index', compact('forms'));
    }

    public function show($id)
    {
        try {
            $form = Contact::find($id);

            if(!$form){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.contact.index');
            }

            return view('dashboard.contact.show', compact('form'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.contact.index');
        } // end of try & catch
    }

    public function update(Request $request, $id)
    {
        try {
            $form = Contact::find($id);

            $request->has('status') ? $request->request->add(['status' => 1]) : $request->request->add(['status' => 0]);
            $request_data = $request -> except(['_token', '_method']);

            if(!$form){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.contact.index');
            }

            $form->update($request_data);


            session()->flash('success', 'Form Updated Successfully');
            return redirect()->route('dashboard.contact.index');

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.contact.index');
        } // end of try & catch
    }

} // end of controller
