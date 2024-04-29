<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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

    public function getType()
    {
        // 1 = Projects, 2 = Partners
        return $this -> type == 1 ? 'Projects' : 'Partners';
    } // end fo get Active

    public function projects()
    {
        return $this -> hasMany(Project::class);
    } // end of projects

    public function getImagePathAttribute()
    {
        if ($this -> image != 'default.png') {
            return asset('uploads/categories/' . $this -> image );
        } else {
            $project = $this -> projects -> whereNotIn ('image', ['default.png', null]) -> last();
            if ($project) {
                return asset('uploads/projects/' . $project -> image );
            } else {
                return asset('uploads/categories/default.png');
            }
        }

    } // end of image path
}
