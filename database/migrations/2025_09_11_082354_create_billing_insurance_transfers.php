<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('billing_invoices', function (Blueprint $t){
            $t->id();
            $t->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $t->string('label');
            $t->decimal('amount', 10, 2)->unsigned()->default(0);
            $t->enum('status',['draft','paid','cancelled'])->default('draft');
            $t->timestamps();
        });

        Schema::create('insurances', function (Blueprint $t){
            $t->id();
            $t->string('name');
            $t->string('contact')->nullable();
            $t->string('email')->nullable();
            $t->timestamps();
        });

        Schema::create('insurance_claims', function (Blueprint $t){
            $t->id();
            $t->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('invoice_id')->constrained('billing_invoices')->cascadeOnDelete();
            $t->foreignId('insurance_id')->constrained('insurances')->cascadeOnDelete();
            $t->enum('status',['pending','approved','rejected','timeout'])->default('pending');
            $t->timestamp('response_due_at')->nullable(); // +24h
            $t->timestamps();
        });

        Schema::create('transfer_requests', function (Blueprint $t){
            $t->id();
            $t->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('from_doctor_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('to_specialty_id')->constrained('specialties')->cascadeOnDelete();
            $t->enum('urgency',['low','normal','high','critical'])->default('normal');
            $t->text('reason')->nullable();
            $t->enum('status',['pending','approved','rejected'])->default('pending');
            $t->foreignId('assigned_doctor_id')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('transfer_requests');
        Schema::dropIfExists('insurance_claims');
        Schema::dropIfExists('insurances');
        Schema::dropIfExists('billing_invoices');
    }
};
