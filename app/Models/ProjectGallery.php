<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    public $timestamps = true;

    protected $table = 'project_galleries';

    protected $guarded = [];

    protected $appends = [
        'image_path'
    ];

    /* ***********************************
    Start of Relationships
    *********************************** */

    public function project()
    {
        return $this -> belongsTo(Project::class, 'project_id', 'id');
    } // end of products

    /* ***********************************
    End of Relationships
    *********************************** */

    public function getImageAttribute()
    {
        if(substr( $this -> image_path, 0, 4 ) === "http"){
            return $this -> image_path;
        } else {
            return asset('uploads/projects/gallery/' . $this -> image_path );
        } // end of if

    } // end of image path
}
