<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PatientProfile extends Model {
    
    protected $fillable=['user_id','birthdate','sex','address','blood_group','allergies','insured','insurer_name','policy_number'];
    public function user(){ return $this->belongsTo(User::class); }
}
