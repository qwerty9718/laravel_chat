<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_user_tables', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chat_room_id');
            $table->unsignedBigInteger('user_id');

            $table->index('chat_room_id','ch_us_chat_room_idx');
            $table->index('user_id','ch_us_user_idx');

            $table->foreign('chat_room_id', 'ch_us_chat_room_fk')->on('chat_rooms')->references('id');
            $table->foreign('user_id', 'ch_us_user_fk')->on('users')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_user_tables');
    }
};
