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
            table: 'roles',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->string(column: 'name');
                $table->string(column: 'slug')->unique();
                $table->string(column: 'description')->nullable();
                $table->timestamps();
            }
        );

        Schema::create(
            table: 'role_user',
            callback: function (Blueprint $table): void {
                $table->foreignId(column: 'role_id')
                    ->constrained(table: 'roles', column: 'id')
                    ->onDelete(action: 'cascade');

                $table->foreignId(column: 'user_id')
                    ->constrained(table: 'users', column: 'id')
                    ->onDelete(action: 'cascade');

                $table->timestamps();

                $table->primary(columns: ['user_id', 'role_id']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'role_user');
        Schema::dropIfExists(table: 'roles');
    }
};
