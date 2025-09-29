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
            table: 'user_activities',
            callback: function (Blueprint $table) {
                $table->id();
                $table->string(column: 'type');
                $table->foreignId(column: 'user_id')
                    ->nullable()
                    ->constrained(table: 'users', column: 'id')
                    ->nullOnDelete()
                    ->nullOnUpdate();
                $table->string(column: 'ip_address')->nullable();
                $table->string(column: 'model');
                $table->bigInteger(column: 'model_id')->unsigned();
                $table->text(column: 'content');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'user_activities');
    }
};
