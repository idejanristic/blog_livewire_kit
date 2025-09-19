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
            table: 'permissions',
            callback: function (Blueprint $table): void {
                $table->id();
                $table->string(column: 'name');
                $table->string(column: 'slug')->unique();
                $table->string(column: 'description')->nullable();
                $table->timestamps();
            }
        );

        Schema::create(
            table: 'permission_role',
            callback: function (Blueprint $table): void {
                $table->foreignId(column: 'permission_id')
                    ->constrained(table: 'permissions', column: 'id')
                    ->onDelete(action: 'cascade');

                $table->foreignId(column: 'role_id')
                    ->constrained(table: 'roles', column: 'id')
                    ->onDelete(action: 'cascade');


                $table->timestamps();

                $table->primary(columns: ['role_id', 'permission_id']);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'permission_role');
        Schema::dropIfExists(table: 'permissions');
    }
};
