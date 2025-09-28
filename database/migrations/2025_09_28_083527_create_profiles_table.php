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
            table: 'profiles',
            callback: function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'user_id')
                    ->constrained(table: 'users')
                    ->onDelete(action: 'cascade')
                    ->onUpdate(action: 'cascade');
                $table->string(column: 'first_name')->nullable();
                $table->string(column: 'last_name')->nullable();
                $table->string(column: 'img_path')->nullable();
                $table->string(column: 'title', length: 9)->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'profiles');
    }
};
