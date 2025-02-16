<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilisateursTable extends Migration
{
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->foreign('id')
                ->references('id')
                ->on('personnes')
                ->onDelete('cascade');

            $table->date('dateNaiss')->nullable();

            $table->foreignId('role_id')->nullable()
                ->constrained('roles')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
