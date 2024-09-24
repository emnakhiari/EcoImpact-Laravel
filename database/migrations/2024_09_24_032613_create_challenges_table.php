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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('title');  // Title of the challenge
            $table->text('description');  // Description of the challenge
            $table->date('start_date');  // When the challenge starts
            $table->date('end_date');  // When the challenge ends
            $table->integer('reward_points');  // Points for completing the challenge
            $table->timestamps();  // Created and Updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
};
