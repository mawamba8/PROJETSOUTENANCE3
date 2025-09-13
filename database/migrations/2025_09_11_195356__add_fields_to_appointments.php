<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::table('appointments', function(Blueprint $t){
            if(!Schema::hasColumn('appointments','created_by')){
                $t->foreignId('created_by')->nullable()->after('doctor_id')->constrained('users')->nullOnDelete();
            }
            if(!Schema::hasColumn('appointments','urgency')){
                $t->enum('urgency',['low','normal','high','critical'])->default('normal')->after('scheduled_at');
            }
            if(!Schema::hasColumn('appointments','is_mandatory')){
                $t->boolean('is_mandatory')->default(false)->after('status'); // RDV imposé par médecin
            }
        });
    }
    public function down(): void{
        Schema::table('appointments', function(Blueprint $t){
            if(Schema::hasColumn('appointments','created_by')) $t->dropConstrainedForeignId('created_by');
            if(Schema::hasColumn('appointments','urgency')) $t->dropColumn('urgency');
            if(Schema::hasColumn('appointments','is_mandatory')) $t->dropColumn('is_mandatory');
        });
    }
};
