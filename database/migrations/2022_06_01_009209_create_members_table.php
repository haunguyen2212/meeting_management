<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('position_id')->unsigned();
            $table->bigInteger('account_id')->unsigned();
            $table->date('date_of_birth');
            $table->char('sex', 1);
            $table->string('address', 200);
            $table->string('avatar', 200)->default('avt-default.jfif');
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->timestamps();
            $table->unique('email');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
