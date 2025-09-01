<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            
            $table->timestamps();
        });
       // Insert default roles
    /* DB::table('roles')->insert([
        ['name' => 'admin'],
        ['name' => 'medecin'],
        ['name' => 'patient']
    ]);*/
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
