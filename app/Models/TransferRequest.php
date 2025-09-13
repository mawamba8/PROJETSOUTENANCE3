<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TransferRequest extends Model {

    protected $fillable=['patient_id','from_doctor_id','to_specialty_id','urgency','reason','status','assigned_doctor_id'];
    public function patient(){ return $this->belongsTo(User::class,'patient_id'); }
    public function toSpecialty(){ return $this->belongsTo(\App\Models\Specialty::class,'to_specialty_id'); }
    public function assignedDoctor(){ return $this->belongsTo(User::class,'assigned_doctor_id'); }
    public function fromDoctor(){ return $this->belongsTo(\App\Models\User::class, 'from_doctor_id'); }

}
