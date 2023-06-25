<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Filiere;
use App\Models\Semestre;
use App\Models\Enseignant;

class matiereController extends Controller
{
   

    public function addMatiere()
    {
        $filieres=Filiere::select('id_filiere','nom_filiere')->get();
        $semestres=Semestre::select('id_semestre','nom_sem')->get();
        $profs=Enseignant::select('id_enseignant','nom_ens')->get();

        return view('admin.matiere.addMatiere',compact('filieres','semestres','profs'));
    }
    public function showAllMatiere()
    {
        
        $matieres=Matiere::with('filiere','semestre','enseignant')->get();
       // return $matieres;
        return view('admin.matiere.showAll',compact('matieres'));
    }

    public function saveMatiere(Request $request){
    
        // validation
        $request->validate([
            'nom' => 'required',
            ]);
            
        // save matiere in DB
        try {
            
            Matiere::create(
                [
                    'nom_mat' => $request->nom,
                    'id_filiere' => $request->filiere,
                    'id_semestre' => $request->semestre,
                    'id_enseignant' => $request->prof,
                ]
                );
                   
                return redirect()->route('show.all.matiere')->with(['success' => 'Matiere bien Ajoute']);
                
            } catch (\Exception $ex) {
                
                
                return redirect()->route('add.matiere')->with(['error' => 'There is somthing went wrong ']);
        }
        
      
    }

    public function editMatiere($id)
    {

        $matiere=Matiere::find($id);
        if(!$matiere)
           redirect() -> route('show.all.matiere') -> with(['error' => 'Matiere Does not exist']);
         
           $filieres=Filiere::select('id_filiere','nom_filiere')->get();
           $semestres=Semestre::select('id_semestre','nom_sem')->get();
           $profs=Enseignant::select('id_enseignant','nom_ens')->get();

           //return $matiere;
        return view('admin.matiere.update',compact('matiere','filieres','semestres','profs'));
    }

    public function updateMatiere(Request $request)
    {
        
     // validation
     $request->validate([
        'nom' => 'required',
        ]);
        
      // save changes  
      try {
            
        Matiere::where('id_matiere',$request ->id) -> update([
            'nom_mat' => $request->nom,
            'id_filiere' => $request->filiere,
            'id_semestre' => $request->semestre,
            'id_enseignant' => $request->prof,
          ]);
               
            return redirect()->route('show.all.matiere')->with(['update' => 'Matiere Bien modifie']);
            
        } catch (\Exception $ex) {
            
            
            return redirect()->route('add.matiere')->with(['error' => 'There is somthing went wrong ']);
    }
      
    }

    public function deleteMatiere($id)
    {
        $matiere=Matiere::find($id);
        if(!$matiere)
           redirect() -> route('show.all.matiere') -> with(['error' => 'Matiere Does not exist']);

           Matiere::where('id_matiere',$id) -> delete();
           return redirect()->route('show.all.matiere')->with(['delete' => 'Matiere est supprime avec succes']); 
    }

    


}
