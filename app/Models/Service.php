<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = [
        'image_path',
    ];

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

    public function getImagePathAttribute()
    {
        return asset('uploads/services/' . $this -> image );
    } // end of image path

    public function projects()
    {
        return $this -> belongsToMany(Project::class, 'projects_services');
    } // end of projects

} // end of model
