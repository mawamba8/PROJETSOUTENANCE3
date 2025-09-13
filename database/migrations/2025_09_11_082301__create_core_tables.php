<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('appointments', function (Blueprint $t){
            $t->id();
            $t->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $t->dateTime('scheduled_at');
            $t->enum('status',['pending','confirmed','cancelled','done'])->default('pending');
            $t->text('notes')->nullable();
            $t->timestamps();
        });

        Schema::create('medical_records', function (Blueprint $t){
            $t->id();
            $t->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $t->text('summary')->nullable();
            $t->text('diagnosis')->nullable();
            $t->text('treatment')->nullable();
            $t->timestamp('locked_at')->nullable(); // validation -> verrouillé
            $t->timestamps();
        });

        Schema::create('prescriptions', function (Blueprint $t){
            $t->id();
            $t->foreignId('patient_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
            $t->string('title');
            $t->text('notes')->nullable();
            $t->enum('status',['draft','validated'])->default('draft');
            $t->timestamps();
        });

        Schema::create('prescription_items', function (Blueprint $t){
            $t->id();
            $t->foreignId('prescription_id')->constrained()->cascadeOnDelete();
            $t->string('drug');
            $t->string('dosage');
            $t->string('frequency');
            $t->string('duration')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('prescription_items');
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('medical_records');
        Schema::dropIfExists('appointments');
    }
};
