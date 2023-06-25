<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //
    protected $primaryKey= 'id_departement';
    protected $fillable = [
        'nom_dep'
    ];

    public function filiers()
{
    return $this->hasMany(Filiere::class);

}

}
