<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarnetMedicalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carnet_medical', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
             $table->unsignedBigInteger('consultation_id');
            $table->text('historique')->nullable();
            $table->text('antecedents')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');  
            $table->foreign('consultation_id')->references('id')->on('consultations')->onDelete('cascade');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void 
    {
        Schema::dropIfExists('carnet_medical');
    }
}
