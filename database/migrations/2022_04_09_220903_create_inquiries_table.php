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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('club_id');
            $table->string('inquiry_code');
            $table->string('name');
            $table->string('mobile');
            $table->string('email');
            $table->string('inquiry_text');
            $table->string('source');
            $table->string('reference');
            $table->string('comments');
            $table->string('followup');
            $table->string('enroll_status');
            $table->string('status');
            $table->string('note');
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
        Schema::dropIfExists('inquiries');
    }
};
