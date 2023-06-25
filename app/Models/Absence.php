<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    //
    protected $primaryKey='id_absence';
    protected $fillable = [
    'justification',
    'etat',
    'id_seance',
    'id_etudiant'
    ];

    public function Seance(){
        return $this->belongsTo(Seance::class,'id_seance');
    
    }
    public function etudiant(){
        return $this->belongsTo(Etudiant::class,'id_etudiant');
    
    }

}
