<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('isbn')->nullable();
            $table->string('publish_year')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->boolean('is_approved')->default(0);
            $table->unsignedInteger('total_view')->default(0);
            $table->unsignedInteger('total_search')->default(0);
            $table->unsignedInteger('total_borrowed')->default(0);
            $table->unsignedInteger('user_id')->nullable()->index();

            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('publisher_id')->index();
            $table->unsignedInteger('translator_id')->nullable()->index();
            
            $table->integer('qauntity')->default(1);
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
        Schema::dropIfExists('books');
    }
}
