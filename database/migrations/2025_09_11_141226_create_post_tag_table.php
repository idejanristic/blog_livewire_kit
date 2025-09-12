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
            table: 'post_tag',
            callback: function (Blueprint $table): void {
                $table->foreignId(column: 'post_id')
                    ->constrained(table: 'posts', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');

                $table->foreignId(column: 'tag_id')
                    ->constrained(table: 'tags', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');

                // Timestamps
                $table->timestamps();

                // Primary key (post_id, tag_id)
                $table->primary(columns: ['post_id', 'tag_id']);

                // Opcioni složeni indeks za brze upite po tag_id i sort po post_id
                $table->index(columns: ['tag_id', 'post_id']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'post_tag');
    }
};
