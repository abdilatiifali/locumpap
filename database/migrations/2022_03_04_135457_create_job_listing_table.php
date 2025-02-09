<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('location');
            $table->integer('rate_per_hour');
            $table->text('candidates');
            $table->foreignId('department_id');
            $table->foreignId('profession_id');
            $table->foreignId('county_id');
            $table->timestamp('deadline_at')->nullable();
            $table->foreignId('organization_id');
            $table->unsignedInteger('typable_id');
            $table->string('typable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
