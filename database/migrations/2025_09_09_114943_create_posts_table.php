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
        Schema::create(
            table: 'posts',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->constrained(table: 'users', column: 'id')
                    ->nullOnDelete()
                    ->nullOnUpdate();
                $table->string(column: 'title');
                $table->text(column: 'excerpt');
                $table->text(column: 'body');
                $table->string(column: 'source');
                $table->integer('view_count')->unsigned()->default(value: 0);
                $table->timestamp(column: 'published_at')->nullable();
                $table->timestamps();

                $table->index('user_id');
                $table->index('published_at');

                $table->fullText(['title', 'body']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
