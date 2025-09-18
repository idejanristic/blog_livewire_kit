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
            table: 'dislikes',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->constrained(table: 'users', column: 'id')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');
                $table->integer(column: 'dislikeable_id');
                $table->string(column: 'dislikeable_type');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'dislikes');
    }
};
