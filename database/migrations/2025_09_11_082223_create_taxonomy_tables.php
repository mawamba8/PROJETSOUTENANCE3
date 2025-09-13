<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('departments', function (Blueprint $t){
            $t->id();
            $t->string('name')->unique();
            $t->text('description')->nullable();
            $t->timestamps();
        });

        Schema::create('specialties', function (Blueprint $t){
            $t->id();
            $t->foreignId('department_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->timestamps();
        });

        Schema::create('doctor_profiles', function (Blueprint $t){
            $t->id();
            $t->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $t->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('specialty_id')->nullable()->constrained()->nullOnDelete();
            $t->string('phone')->nullable();
            $t->text('about')->nullable();
            $t->timestamps();
        });

        Schema::create('patient_profiles', function (Blueprint $t){
            $t->id();
            $t->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $t->date('birthdate')->nullable();
            $t->enum('sex',['M','F'])->nullable();
            $t->string('address')->nullable();
            $t->string('blood_group')->nullable();
            $t->text('allergies')->nullable();
            $t->boolean('insured')->default(false);
            $t->string('insurer_name')->nullable();
            $t->string('policy_number')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('patient_profiles');
        Schema::dropIfExists('doctor_profiles');
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('departments');
    }
};
