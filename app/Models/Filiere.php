<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    //
    protected $primaryKey='id_filiere';
    protected $fillable = [
         'nom_filiere',
         'id_departement'
    ];
   

    public function etudiants()
{
    return $this->hasMany(Etudiant::class);

}
public function departement(){
    return $this->belongsTo(departement::class,'id_departement');

}

public function matiere()
{
    return $this->hasMany(Matiere::class);

}
}
