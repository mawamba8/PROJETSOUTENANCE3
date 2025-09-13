<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model {
    
    protected $fillable=['prescription_id','drug','dosage','frequency','duration'];
    public function prescription(){ return $this->belongsTo(Prescription::class); }
}
