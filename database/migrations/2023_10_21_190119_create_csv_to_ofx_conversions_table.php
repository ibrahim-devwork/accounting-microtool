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
        Schema::create('csv_to_ofx_conversions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('csv_file_name', 100)->nullable();
            $table->string('ofx_file_name', 100);
            $table->enum('status', [0, 1, 2, 3])->default(0);
            $table->timestamp('start_process_date')->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_to_ofx_conversions');
    }
};
