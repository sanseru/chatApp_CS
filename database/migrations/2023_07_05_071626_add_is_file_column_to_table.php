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
        Schema::table('chats', function (Blueprint $table) {
            $table->boolean('is_file')->default(0);
            $table->text('subject');
            $table->text('replyUuid')->nullable();;
            $table->boolean('is_important')->default(0)->nullable();;
            $table->boolean('res_req')->default(0)->nullable();;
            $table->boolean('withdraw')->default(0)->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropColumn('is_file');
        });
    }
};
