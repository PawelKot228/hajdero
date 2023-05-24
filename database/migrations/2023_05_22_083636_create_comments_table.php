<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->foreignId('article_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('text');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->cascadeOnDelete();
        });

    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('article_id');
            $table->dropConstrainedForeignId('comment_id');
        });

        Schema::dropIfExists('comments');
    }
};
