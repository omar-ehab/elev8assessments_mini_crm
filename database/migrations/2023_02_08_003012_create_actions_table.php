<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('note')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('recorded_by');
            $table->unsignedBigInteger('noted_by')->nullable();
            $table->timestamps();

            $table->foreign('recorded_by')
                ->references('id')
                ->on('users')
                ->restrictOnDelete();

            $table->foreign('noted_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('action_results');
    }
};
