<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users");
            $table->string("legal_name")->default("NULL")->require();
            $table->string("federal_tax_classification")->default("C-Corp")->require();
            $table->integer('ein_tin')->default("0000")->require();
            $table->string("type_of_corporation")->default("Corporation")->require();
            $table->string("owners_title")->default("SRS")->require();
            $table->integer("years_in_business")->default(1)->require();
            $table->string("address")->default("NULL")->require();
            $table->string("telephone")->default("0000")->require();
            $table->string("email")->unique()->default("")->require();
            $table->string("outside_picture_store")->default("")->require();
            $table->string("inside_pictures_store")->default("")->require();
            $table->string("status")->default("Pending");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
