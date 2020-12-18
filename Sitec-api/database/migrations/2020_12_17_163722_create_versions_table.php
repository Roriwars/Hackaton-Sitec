<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('version');
            $table->integer('idProduct');
            $table->timestamps();
            $table->foreign('idProduct')->references('id')->on('products')->onDelete('cascade');
        });
        
        Schema::table('product_clients', function (Blueprint $table) {
            $table->foreign('idVersion')->references('id')->on('versions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versions');
    }
}
