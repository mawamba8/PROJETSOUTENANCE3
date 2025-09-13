<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InsuranceClaim extends Model {
    
    protected $fillable=['patient_id','invoice_id','insurance_id','status','response_due_at'];
    protected $casts=['response_due_at'=>'datetime'];
    public function invoice(){ return $this->belongsTo(BillingInvoice::class,'invoice_id'); }
    public function insurance(){ return $this->belongsTo(Insurance::class); }
    public function patient(){ return $this->belongsTo(User::class,'patient_id'); }
}
