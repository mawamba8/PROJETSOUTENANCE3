<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model {

    
    protected $fillable=['patient_id','doctor_id','title','notes','status'];
    public function patient(){ return $this->belongsTo(User::class,'patient_id'); }
    public function doctor(){ return $this->belongsTo(User::class,'doctor_id'); }
    public function items(){ return $this->hasMany(PrescriptionItem::class); }
}
