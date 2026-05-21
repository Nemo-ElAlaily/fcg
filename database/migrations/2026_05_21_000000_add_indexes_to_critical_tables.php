<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToCriticalTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('is_awarded');
            $table->index('add_to_home');
            $table->index('slug');
            $table->index('category_id');
            $table->index('client_id');
            $table->index(['is_active', 'category_id']);
            $table->index(['is_active', 'is_awarded']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('add_to_home');
            $table->index('slug');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('type');
            $table->index('is_active');
            $table->index('slug');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->index('slug');
            $table->index('is_active');
            $table->index('show_in_navbar');
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('projects_services', function (Blueprint $table) {
            $table->index('project_id');
            $table->index('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['is_awarded']);
            $table->dropIndex(['add_to_home']);
            $table->dropIndex(['slug']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['client_id']);
            $table->dropIndex(['is_active_category_id']);
            $table->dropIndex(['is_active_is_awarded']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['add_to_home']);
            $table->dropIndex(['slug']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['slug']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['show_in_navbar']);
        });

        Schema::table('sliders', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('projects_services', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
            $table->dropIndex(['service_id']);
        });
    }
}
