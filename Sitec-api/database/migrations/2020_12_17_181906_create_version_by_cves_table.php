<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionByCvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('version_by_cves', function (Blueprint $table) {
            $table->id();
            $table->integer('idVersion');
            $table->string('idCve');
            $table->foreign('idVersion')->references('id')->on('versions')->onDelete('cascade');
            $table->foreign('idCve')->references('id')->on('cves')->onDelete('cascade');
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
        Schema::dropIfExists('version_by_cves');
    }
}
