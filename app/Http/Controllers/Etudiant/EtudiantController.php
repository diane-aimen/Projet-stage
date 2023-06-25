<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\Etudiant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    //
    public function index(){
        $user = Auth::id();
        $etudiant = Etudiant::with(['absences', 'absences.seance'])
        ->where('id_etudiant', $user)
        ->first();
        //dd($etudiant);
        if($etudiant){
        $abs = $etudiant->absences;
        return view('Etudiant.EspaceEtudiant',compact('etudiant','abs'));
        }
        else{
            return abort(403, 'Unauthorized');
        }
}
}
