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
            table: 'feedback',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->string(column: 'name')->nullable();

                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->index()
                    ->constrained(table: 'users')
                    ->nullOnDelete()
                    ->cascadeOnUpdate();

                $table->string(column: 'email');
                $table->string(column: 'phone')->nullable();
                $table->text(column: 'message');
                $table->timestamps();

                $table->index(columns: ['user_id', 'created_at']);
                $table->index(columns: ['email', 'created_at']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'feedback');
    }
};
