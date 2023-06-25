<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    //
    protected $primaryKey='id_enseignant';
    protected $fillable = [
        'nom_ens',
        'prenom_ens',
        'phone_ens',
        'adresse_ens',
        'id_user'
    ];
    
    public function userprof(){
        return $this->belongsTo(User::class,'id_user');
    
    }
    public function matieres()
    {
        return $this->hasMany(Matiere::class,'id_enseignant');
    
    }
    public function seances()
    {
        return $this->hasMany(Seance::class);
    
    }
}
