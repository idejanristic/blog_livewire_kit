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
                $table->boolean(column: 'status_comment')->nullable()->default(value: false);
                $table->integer(column: 'view_count')->unsigned()->default(value: 0);
                $table->timestamp(column: 'published_at')->nullable();
                $table->string(column: 'source');
                $table->timestamps();

                $table->index(columns: 'user_id');
                $table->index(columns: 'published_at');
                $table->fullText(columns: ['title', 'body']);
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
