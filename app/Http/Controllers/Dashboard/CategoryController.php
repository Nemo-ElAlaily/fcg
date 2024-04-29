<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::when($request -> search , function ($query) use ($request) {
            return $query -> where('name', 'like' , '%' . $request -> search . '%');
        })->latest()->paginate(ADMIN_PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method']);
            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $image_path = "";
            if($request -> image){
                $image_path = uploadImage('uploads/categories/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = 'default.png';
            }

            $category =  Category::create($request_data);

            DB::commit();

            session()->flash('success', ('Added Successfully'));
            return redirect()->route('dashboard.categories.index');



        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.categories.index');
        }// end of try & catch

    } // end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::find($id);

            if(!$category){
                session()->flash('error', 'Does not exist');
                return redirect()->route('dashboard.categories.index');
            }

            return view('dashboard.categories.edit', compact('category'));

        } catch (\Exception $exception) {
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.categories.index');

        } // end of try & catch

    } // end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateCategoryRequest $request)
    {
        $characters = array(' ', '/', '!', '\\');

        try {
            $category = Category::find($id);

            if(!$category){
                session()->flash('error', 'Does not Exist');
                return redirect()->route('dashboard.categories.index');
            }

            $request->has('is_active') ? $request->request->add(['is_active' => 1]) : $request->request->add(['is_active' => 0]);
            $request_data = $request -> except(['_token', '_method']);

            $request_data['slug'] = str_replace($characters, '-' , $request['name']);

            DB::beginTransaction();

            $imagePath = "";
            if($request -> image){
                if ($category -> image != 'default.png') {
                    Storage::disk('public_uploads')->delete('/categories/' . $category -> image);
                } // end of inner if
                $image_path = uploadImage('uploads/categories/',  $request -> image);
                $request_data['image'] = $image_path;
            } else {
                $request_data['image'] = $category -> image;
            }// end of outer if

            $category -> update($request_data);

            DB::commit();

            session()->flash('success', 'Updated Successfully');
            return redirect()->route('dashboard.categories.index');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Please Contact Admin');
            return redirect()->route('dashboard.categories.index');

        } // end of try & catch

    } // end of update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            session()->flash('error', 'Do not exists');
            return redirect()->route('dashboard.categories.index');
        }

        try {
            $category->delete();

            session()->flash('success', 'Deleted Successfully');
            return redirect()->route('dashboard.categories.index');

        } catch (\Exception $exception) {
            session()->flash('error', 'contact admin');
            return redirect()->route('dashboard.categories.index');
        } // end of try -> catch

    } // end of destroy

} // end of controller
