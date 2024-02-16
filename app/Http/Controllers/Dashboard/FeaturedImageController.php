<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreFeaturedImageRequest;
use App\Http\Requests\UpdateFeaturedImageRequest;
use App\Models\Pages\FeaturedImage;

class FeaturedImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured_images = FeaturedImage::all();
        return view('dashboard.featured_images.index', compact('featured_images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeaturedImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeaturedImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pages\FeaturedImage  $featuredImage
     * @return \Illuminate\Http\Response
     */
    public function show(FeaturedImage $featuredImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pages\FeaturedImage  $featuredImage
     * @return \Illuminate\Http\Response
     */
    public function edit(FeaturedImage $featuredImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeaturedImageRequest  $request
     * @param  \App\Models\Pages\FeaturedImage  $featuredImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeaturedImageRequest $request, FeaturedImage $featuredImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pages\FeaturedImage  $featuredImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeaturedImage $featuredImage)
    {
        //
    }
}
