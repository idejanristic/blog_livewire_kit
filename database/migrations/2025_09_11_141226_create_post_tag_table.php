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

                $table->timestamps();

                $table->primary(columns: ['post_id', 'tag_id']);
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
