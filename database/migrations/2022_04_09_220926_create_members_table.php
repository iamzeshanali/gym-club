<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('club_id');
            $table->bigInteger('membership_id');
            $table->string('member_code');
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->string('image');
            $table->date('dob');
            $table->string('gender');
            $table->string('member_type');
            $table->string('member_role');
            $table->string('enrollment_type');
            $table->date('enrollment_date');
            $table->date('start_date');
            $table->string('status');
            $table->string('note');
            $table->string('comments');
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('members');
    }
};
