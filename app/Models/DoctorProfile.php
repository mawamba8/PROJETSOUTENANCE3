<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model {
    
    protected $fillable=['user_id','department_id','specialty_id','phone','about'];
    public function user(){ return $this->belongsTo(User::class); }
}
