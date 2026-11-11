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
        if (!Schema::hasTable('conversations')) {
            Schema::create('conversations', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('user_id');
                $table->uuid('manager_id');
                $table->uuid('vehicle_id')->nullable();
                $table->timestamp('last_message_at')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');

                $table->foreign('manager_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');

                $table->foreign('vehicle_id')
                      ->references('id')
                      ->on('vehicles')
                      ->onDelete('set null');
            });
        }

        if (!Schema::hasTable('messages')) {
            Schema::create('messages', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->uuid('conversation_id');
                $table->uuid('sender_id');
                $table->uuid('receiver_id');
                $table->text('message');
                $table->boolean('is_read')->default(false);
                $table->timestamps();

                $table->foreign('conversation_id')
                      ->references('id')
                      ->on('conversations')
                      ->onDelete('cascade');

                $table->foreign('sender_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');

                $table->foreign('receiver_id')
                      ->references('id')
                      ->on('users')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
    }
};
