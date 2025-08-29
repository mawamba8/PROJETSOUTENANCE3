<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendezVousTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('medecin_id')->constrained('users')->onDelete('cascade');
            $table->date('date_rdv');
            $table->Time('heure_rdv');
            $table->string('statut')->default('planifié'); // planifié, confirmé, annulé, terminé
            $table->string('type_consultation')->default('general');
            $table->integer('duree')->default(30); // en minutes
            $table->text('motif');
            $table->text('notes')->nullable();
            $table->timestamps();

            /*$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medecin_id')->references('id')->on('medecins')->onDelete('cascade');*/
             $table->index(['medecin_id', 'date_rdv', 'heure_rdv']);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void

    {
        Schema::dropIfExists('rendez_vous');
    }
}
