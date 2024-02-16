<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Client;
use App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    } // end of title attr

    public function scopeActive($query)
    {
        return $query -> where('is_active' , 1);
    } // end of active

    public function getActive()
    {
        return $this -> is_active == 1 ? 'Active' : 'Not Active';
    } // end fo get Active

    public function category()
    {
        return $this -> belongsTo(Category::class);
    } // end of categories

    public function client()
    {
        return $this -> belongsTo(Client::class);
    } // end of categories


    public function services()
    {
        return $this -> belongsToMany(Service::class, 'projects_services');

    } // end of services

    public function getImagePathAttribute()
    {
        return asset('uploads/projects/' . $this -> image );

    } // end of image path

    public function getGalleryItemsAttribute()
    {
        if($this -> gallery != null){
            foreach (json_decode( $this -> gallery, true) as $index => $item){
                echo '{id: ' . $index . ' , src: "' . asset('uploads/projects/gallery/') . '/'. $item . '"},';
            }
        }
    } // end of getGalleryItemsAttribute

} // end of model
