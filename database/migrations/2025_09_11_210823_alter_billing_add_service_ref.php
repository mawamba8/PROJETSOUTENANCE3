<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('billing_invoices', function (Blueprint $t) {
            if (!Schema::hasColumn('billing_invoices','service_type')) {
                $t->enum('service_type',['consultation','examen','ordonnance','autre'])
                  ->default('autre')->after('department_id');
            }
            if (!Schema::hasColumn('billing_invoices','service_id')) {
                $t->unsignedBigInteger('service_id')->nullable()->after('service_type');
                // service_id pointer générique : prescription_id, exam_id, etc.
                // (pas de contrainte FK volontairement, car polymorphe)
            }
        });
    }
    public function down(): void {
        Schema::table('billing_invoices', function (Blueprint $t) {
            if (Schema::hasColumn('billing_invoices','service_id')) $t->dropColumn('service_id');
            if (Schema::hasColumn('billing_invoices','service_type')) $t->dropColumn('service_type');
        });
    }
};
