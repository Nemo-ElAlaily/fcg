<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSettings extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'site_settings';
    public $fillable = [
        'title',
        'welcome_phrase',
        'address',
        'city',
        'phone',
        'country',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'logo',
        'story',
        'mission',
        'vision',
        'story_image',
        'mission_image',
        'vision_image',
        'favicon',
        'google_analytics',
        'google_client_id',
        'google_secret_key',
        'google_redirect',
        'facebook_client_id',
        'facebook_secret_key',
        'facebook_redirect',
    ];

    protected $appends = [
        'logo_path',
        'favicon_path',
        'story_image_path',
        'mission_image_path',
        'vision_image_path',
    ];

    public function getLogoPathAttribute()
    {
        return asset('uploads/site/' . $this -> logo );
    } // end of logo

    public function getFaviconPathAttribute()
    {
        return asset('uploads/site/' . $this -> favicon );
    } // end of favivon

    public function getStoryImagePathAttribute()
    {
        return asset('uploads/site/' . $this -> story_image );
    } // end of story image

    public function getMissionImagePathAttribute()
    {
        return asset('uploads/site/' . $this -> mission_image );
    } // end of mission image

    public function getVisionImagePathAttribute()
    {
        return asset('uploads/site/' . $this -> vision_image );
    } // end of vision

} // end of model
