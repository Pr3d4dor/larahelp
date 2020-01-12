<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
            $table->longText('answer');
            $table->unsignedBigInteger('faq_category_id');
            $table->foreign('faq_category_id')->references('id')->on('faq_categories');
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
        Schema::dropIfExists('faq_questions');
    }
}
