<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            // General
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('welcome_phrase')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo')->default('default.png');
            $table->string('favicon')->default('favicon.png');
            // Our vision, mission and story
            $table->longText('mission')->nullable();
            $table->string('mission_image')->default('default.png');
            $table->longText('vision')->nullable();
            $table->string('vision_image')->default('default.png');
            $table->longText('story')->nullable();
            $table->string('story_image')->default('default.png');
            // Meta Section
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            // Google analytic integrations
            $table->longText('google_analytics')->nullable();
            $table->string('google_client_id')->nullable();
            $table->string('google_secret_key')->nullable();
            $table->string('google_redirect')->nullable();
            // Facebook intefrations
            $table->string('facebook_client_id')->nullable();
            $table->string('facebook_secret_key')->nullable();
            $table->string('facebook_redirect')->nullable();
            // Location
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            // Soft Delete
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
