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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('category');
            $table->string('type');
            $table->string('style');
            $table->integer('count');
            $table->integer('gender');
            $table->integer('priority');
            $table->integer('price');
            $table->boolean('iron')->default(false);
            $table->boolean('rafa')->default(false);
            $table->boolean('wash')->default(false);
            $table->boolean('tincture')->default(false);
            $table->unsignedBigInteger('task_id')->nullable()->index();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
