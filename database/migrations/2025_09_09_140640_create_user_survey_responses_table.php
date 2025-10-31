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
        Schema::create('user_survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('satisfaction_rating'); // 1-5 rating
            $table->text('feedback')->nullable(); // Optional text feedback
            $table->boolean('would_recommend')->default(false); // Would recommend to others
            $table->text('improvements')->nullable(); // Suggested improvements
            $table->timestamps();
            
            // Ensure one survey per user
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_survey_responses');
    }
};
