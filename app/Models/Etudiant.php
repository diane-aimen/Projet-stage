<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    //
    protected $primaryKey='id_etudiant';
    protected $fillable = [
        'cne', 
        'nom_etu', 
        'prenom_etu',
        'phone_etu',
        'id_filiere',
        'id_user'
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');

    }
    public function filiere(){
        return $this->belongsTo(Filiere::class,'id_filiere');

    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function absences()
    {
        return $this->hasMany(Absence::class,'id_etudiant');

    }
}
