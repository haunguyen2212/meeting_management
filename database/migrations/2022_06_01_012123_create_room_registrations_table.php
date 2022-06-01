<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('register_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('type_sp_id')->unsigned();
            $table->bigInteger('supporter_id')->unsigned()->nullable();
            $table->dateTime('test_time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->dateTime('approval_time')->nullable();
            $table->string('document', 100)->nullable();
            $table->string('status', 2)->default('0');
            $table->string('feedback', 500)->nullable();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('register_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_sp_id')->references('id')->on('types_support')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supporter_id')->references('id')->on('supporters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_registrations');
    }
}
