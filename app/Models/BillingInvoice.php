<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BillingInvoice extends Model {
    
    protected $fillable=['patient_id','department_id','label','amount','status'];
    protected $casts=['amount'=>'decimal:2'];
    public function patient(){ return $this->belongsTo(\App\Models\User::class,'patient_id'); }
    public function department(){ return $this->belongsTo(\App\Models\Department::class,'department_id'); }
}
