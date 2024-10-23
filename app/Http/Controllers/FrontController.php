<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Project;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;


class FrontController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', '1')->limit(4)->latest()->get();
        $awarded_projects = Project::where([['is_awarded', '1'], ['is_active', '1'] ])->limit(3)->latest()->get();
        $projects = Project::where([['add_to_home', '1'], ['is_active', '1'], ['is_awarded', '0'] ])->limit(6)->latest()->get();
        $clients = Client::where('is_active', '1')->get();
        $sliders = Slider::where('is_active', '1')->get();
        return view('front.index', compact('services', 'awarded_projects', 'projects', 'clients', 'sliders'));
    } // end of index

    public function about()
    {
        return view('front.about');
    } // end of about

    public function services()
    {
        $services = Service::where('is_active', '1')->latest()->get();
        $latest_projects = Project::where('is_active', '1')->limit(3)->latest()->get();
        $clients = Client::where('is_active', '1')->get();
        return view('front.services', compact('services', 'latest_projects', 'clients'));
    } // end of services

    public function serviceProjects($slug)
    {
        $service = Service::where([['slug', $slug], ['is_active', '1']])->first();
        $projects = $service->projects()->where([['is_active', '1'], ['image', '!=', 'default.png']])->latest()->paginate(FRONT_PAGINATION_COUNT);
        return view('front.projects', compact('projects'));
    } // end of seriveProjects

    public function contact()
    {
        // contact us map leaflet markers
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 24.677318871951606,
                    'lng' => 46.69372109952715
                ],
                'draggable' => false,
                'name' => 'Riyadh, HQ',
            ],
            [
                'position' => [
                    'lat' => 21.515651811291555,
                    'lng' => 39.167971995730014
                ],
                'draggable' => false,
                'name' => 'Jeddah',

            ],
            [
                'position' => [
                    'lat' => 18.240928214658666,
                    'lng' => 42.5605524
                ],
                'draggable' => false,
                'name' => 'Abha',
            ],
            [
                'position' => [
                    'lat' => 29.992976563119143,
                    'lng' => 30.984755887419173
                ],
                'draggable' => false,
                'name' => 'Egypt',
            ]
        ];

        return view('front.contact', compact('initialMarkers'));
    } //end of contact

    public function postContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        try {
            $request_data = $request -> except(['_token', '_method']);
            DB::beginTransaction();

            $contact =  Contact::create($request_data);

            DB::commit();

            session()->flash('success', ('Thank You for contacting us, we will reach to you ASAP'));
            return redirect()->route('contact');

        } catch (\Exception $exception) {
            DB::rollback();
            session()->flash('error', 'Something went wrong, please try again later');
            return redirect()->route('contact');
        }// end of try & catch
    } // end of postContact

    public function projects()
    {
        $projects = Project::where('is_active', '1')->orderBy('category_id')->latest()->paginate(FRONT_PAGINATION_COUNT);
        return view('front.projects', compact('projects'));
    } // end of project

    public function awardedProjects()
    {
        $projects = Project::where([['is_active', '1'], ['is_awarded', '1']])->orderBy('category_id')->latest()->paginate(FRONT_PAGINATION_COUNT);
        return view('front.projects', compact('projects'));
    } // end of awardedProjects

    public function categories()
    {
        $categories = Category::where([['is_active', '1'], ['type', '1']])->get();
        return view('front.categories', compact('categories'));
    } // end of catergories

    public function categoryProjects($slug)
    {
        $category = Category::where([['slug', $slug], ['is_active', '1']])->first();
        $projects = Project::where([['category_id', $category->id], ['is_active', '1']])->latest()->paginate(FRONT_PAGINATION_COUNT);
        return view('front.projects', compact('projects'));
    } //end of categoryProjects

    public function singleProject($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return view('front.single_project', compact('project'));
    } // end of singleProject
}
