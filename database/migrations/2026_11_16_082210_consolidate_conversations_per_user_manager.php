<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Konsolidasikan duplikasi percakapan jika ada beberapa percakapan antara user_id dan manager_id yang sama
        if (Schema::hasTable('conversations') && Schema::hasTable('messages')) {
            $pairs = DB::table('conversations')
                ->select('user_id', 'manager_id', DB::raw('count(*) as total'))
                ->groupBy('user_id', 'manager_id')
                ->having('total', '>', 1)
                ->get();

            foreach ($pairs as $pair) {
                $allConv = DB::table('conversations')
                    ->where('user_id', $pair->user_id)
                    ->where('manager_id', $pair->manager_id)
                    ->orderBy('created_at', 'asc')
                    ->get();

                if ($allConv->count() > 1) {
                    $primary = $allConv->first();
                    $duplicates = $allConv->slice(1);

                    foreach ($duplicates as $dup) {
                        // Pindahkan semua pesan ke percakapan utama
                        DB::table('messages')
                            ->where('conversation_id', $dup->id)
                            ->update(['conversation_id' => $primary->id]);

                        // Hapus percakapan duplikat
                        DB::table('conversations')
                            ->where('id', $dup->id)
                            ->delete();
                    }

                    // Update last_message_at percakapan utama
                    $latestMsg = DB::table('messages')
                        ->where('conversation_id', $primary->id)
                        ->orderBy('created_at', 'desc')
                        ->first();

                    if ($latestMsg) {
                        DB::table('conversations')
                            ->where('id', $primary->id)
                            ->update(['last_message_at' => $latestMsg->created_at]);
                    }
                }
            }

            // 2. Tambahkan unique constraint antara user_id dan manager_id
            Schema::table('conversations', function (Blueprint $table) {
                // Beri nama constraint yang jelas
                $table->unique(['user_id', 'manager_id'], 'conversations_user_manager_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('conversations')) {
            Schema::table('conversations', function (Blueprint $table) {
                $table->dropUnique('conversations_user_manager_unique');
            });
        }
    }
};
