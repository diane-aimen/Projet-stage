<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    //
    protected $primaryKey='id_matiere';
    protected $fillable = [

        'nom_mat',
        'id_filiere',
        'id_semestre',
        'id_enseignant'
    ];


    public function filiere(){
        return $this->belongsTo(Filiere::class,'id_filiere');
    
    }
    public function semestre(){
        return $this->belongsTo(Semestre::class,'id_semestre');
    
    }
    public function enseignant(){
        return $this->belongsTo(Enseignant::class,'id_enseignant');
    
    }
    public function seances()
    {
        return $this->hasMany(Seance::class);
    
    }

}
