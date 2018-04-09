<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\General\Status;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('birth_date')->nullable();
            $table->integer('application_type_id')->unsigned()->index()->nullable();
            $table->integer('gender_id')->unsigned()->index()->nullable();
            $table->integer('title_id')->unsigned()->index()->nullable();
            $table->integer('language_id')->unsigned()->index()->nullable();
            $table->integer('occupation_id')->unsigned()->index()->nullable();
            $table->integer('country_id')->unsigned()->index()->nullable();
            $table->string('email')->unique();
            $table->string('alt_email')->unique();
            $table->string('mobile')->nullable();
            $table->string('alt_mobile')->nullable();
            $table->string('telephone')->nullable();
            $table->string('alt_telephone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('skype')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('github')->nullable();
            $table->string('bitbucket')->nullable();
            $table->string('gitlab')->nullable();
            $table->text('bio')->nullable();
            $table->integer('status_id')->unsigned()->index()->default(Status::ACTIVE)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('application_type_id')->references('id')->on('application_types');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
