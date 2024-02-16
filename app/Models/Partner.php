<?php

namespace App\Models;

use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = [
        'logo_path',
    ];

    public function category()
    {
        return $this -> belongsTo(Category::class);
    } // end of categories

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

    public function getLogoPathAttribute()
    {
        return asset('uploads/partners/' . $this -> logo );
    } // end of logo path

} // End  of models
