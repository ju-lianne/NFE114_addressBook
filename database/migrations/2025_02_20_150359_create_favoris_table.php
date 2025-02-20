<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavorisTable extends Migration
{
    public function up()
    {
        Schema::create('favoris', function (Blueprint $table) {
            $table->foreignId('utilisateur_id')
                ->constrained('utilisateurs')
                ->onDelete('cascade');

            $table->foreignId('contact_id')
                ->constrained('contacts')
                ->onDelete('cascade');

            $table->primary(['utilisateur_id', 'contact_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favoris');
    }
}
