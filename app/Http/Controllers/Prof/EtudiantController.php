<?php

namespace App\Http\Controllers\Prof;

use App\Models\Enseignant;
use App\Models\Etudiant;
use App\Http\Controllers\Controller;
use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    //
    public function listModules(){
       // $id_prof=Enseignant::select('id_enseignant')->where('id_user','=',Auth::id())->first()->id;
        $enseignant = Enseignant::select('id_enseignant')->where('id_user', '=', Auth::user()->id)->first();
        $id_prof = $enseignant ? $enseignant->id_enseignant : null;   

        $matieres=Matiere::select('id_matiere','nom_mat')->where('id_enseignant','=',$id_prof)->get();
        return view('Enseignant.listModules',compact('matieres'));
    }
    public function listEtudiant($id){
        $filiere = Matiere::find($id)->filiere()->get();
        foreach($filiere as $f){

          $id_fil = $f->id_filiere;
          $etudiants = Etudiant::where('id_filiere',$id_fil)->get();
        }
        //dd($etudiants);

          return view('Enseignant.listetudiant',compact('etudiants'));

    }
}
