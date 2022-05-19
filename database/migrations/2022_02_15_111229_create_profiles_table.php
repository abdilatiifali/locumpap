<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_number');
            $table->string('professional_registration_number');
            $table->unsignedInteger('profession_id');
            $table->unsignedInteger('county_id');
            $table->unsignedInteger('speciality_id');
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->string('cv')->nullable();
            $table->unsignedInteger('nationalId')->nullable();
            $table->string('recommendation_letter')->nullable();
            $table->text('about')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('profiles');
    }
}
