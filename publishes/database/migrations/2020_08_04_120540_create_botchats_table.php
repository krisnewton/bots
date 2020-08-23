<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotchatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('botchats', function (Blueprint $table) {
            $table->id();
            $table->string('bot_name');
            $table->integer('chat_id');
            $table->string('status')->nullable();
            $table->text('extra')->nullable();
            $table->enum('auth', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('botchats');
    }
}
