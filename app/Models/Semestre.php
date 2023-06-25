<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    //
    protected $primaryKey='id_semestre';
    protected $fillable = [
        'nom_sem'
    ];
   

    public function Matieres()
{
    return $this->hasMany(Matiere::class);

}
}
