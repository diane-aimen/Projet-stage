<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    //
    protected $primaryKey='id_seance';
    protected $fillable = [
        
        'date',
        'type',
        'active',
        'heure_debut',
        'heure_fin',
        'id_matiere',
        'id_enseignant'
   ];
    public function enseignant(){
        return $this->belongsTo(Enseignant::class,'id_enseignant');

    
    }
    public function matiere(){
        return $this->belongsTo(Matiere::class,'id_matiere');

    
    }
    public function absences()
    {
        return $this->hasMany(Absence::class,'id_seance');
    
    }
}
