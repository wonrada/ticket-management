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
        Schema::create('tickets', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('contact_email');
            $table->string('priority');
            $table->string('organization');
            $table->string('vessel');
            $table->string('service_line');
            $table->string('assign_to')->nullable();
            $table->string('status')->nullable();
            $table->string('category')->nullable();
            // if have login process should collect user_id to see who is created this ticket
            // $table->string('user_id');
            $table->timestamps(); // Automatically adds `created_at` and `updated_at`
            $table->softDeletes(); // Adds `deleted_at` for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
