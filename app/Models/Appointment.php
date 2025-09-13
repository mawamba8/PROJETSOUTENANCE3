<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    
    protected $fillable=['patient_id','doctor_id','scheduled_at','status','notes'];
    protected $casts=['scheduled_at'=>'datetime'];
    public function patient(){ return $this->belongsTo(User::class,'patient_id'); }
    public function doctor(){ return $this->belongsTo(User::class,'doctor_id'); }
}
