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
            table: 'comments',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->foreignId(column: 'post_id')
                    ->constrained(table: 'posts', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');

                $table->foreignId(column: 'user_id')
                    ->constrained(table: 'users', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');

                $table->text(column: 'body');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'comments');
    }
};
