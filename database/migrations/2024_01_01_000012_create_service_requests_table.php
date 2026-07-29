<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->foreignId('citizen_id')->constrained()->onDelete('cascade');
            $table->string('service_type');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('employee_id')->nullable()->constrained('service_employees')->nullOnDelete();
            $table->text('admin_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
