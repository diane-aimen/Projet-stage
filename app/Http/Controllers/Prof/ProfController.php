<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Etudiant;
use App\Models\Filiere;

use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Seance;
use App\Models\Absence;
use Auth;

class ProfController extends Controller
{
    public function index()
    {
        return view('Enseignant.EspaceProf');
    }

    public function createSeance()
    {
        // get id of the current teacher
        $id_prof = Enseignant::where('id_user', Auth::id())->first();

        $matieres = Matiere::where('id_enseignant', $id_prof->id_enseignant)->select('id_matiere', 'nom_mat')->get();
        //dd($id_prof);

        return view('Enseignant.createSeance',compact('matieres','id_prof'));
    }

    public function saveSeance(Request $request)
    {
        //validation
        $request->validate([
            'date' => 'required',
            'H_debut' => 'required',
            'H_fin' => 'required',
        ]);
    
        // save into DB
        try {
            $seance = Seance::create([
                'date' => $request->date,
                'heure_debut' => $request->H_debut,
                'heure_fin' => $request->H_fin,
                'id_enseignant' => $request->id_prof,
                'id_matiere' => $request->matiere,
                'type' => $request->type_seance,
                'active' => $request->active
            ]);
    
            return redirect()->route('list.seance')->with(['success' => 'seance est Bien Ajoute']);
    
        } catch (\Exception $ex) {
            return redirect()->route('create.seance')->with(['error' => 'Erreur!!! ']);
        }
    }
    

// fonction permet d'afficher la liste des seances de l'ensaignant courant ayant le champ 'active=0'

public function listSeance()
{
    $id_prof = Enseignant::where('id_user', Auth::id())->value('id_enseignant');
    $seances = Seance::join('enseignants', 'seances.id_enseignant', '=', 'enseignants.id_enseignant')
        ->where('seances.id_enseignant', '=', $id_prof)
        ->with('matiere')
        ->get();

    return view('Enseignant.listSeance', compact('seances'));
}


// fonctions pour noter absence
public function PageNoteAbsence($id)
{
    // Retourner l'ID de la séance à partir de la liste des séances
    $seance = Seance::findOrFail($id);
    $id_matiere = $seance->id_matiere; // La matière de cette séance

    // Récupérer la filière à partir de l'ID de la matière
    $filiere = Matiere::find($id_matiere)->filiere()->first();
    $id_fil = $filiere->id_filiere;

    // Récupérer les étudiants de la filière
    $etudiantIds = Etudiant::where('id_filiere', $id_fil)->pluck('id_etudiant');
    $etudiants = Etudiant::whereIn('id_etudiant', $etudiantIds)->get();

    return view('Enseignant.NoterAbsence', compact('seance', 'etudiants', 'filiere'));
}

public function PageNoteAbsenceEdit($id)
{
    $seance = Seance::findOrFail($id);
    $id_matiere = $seance->id_matiere;
    $abs = $seance->absences()->get();

    $filiere = Matiere::find($id_matiere)->filiere()->get();

    foreach ($filiere as $f) {
        $id_fil = $f->id_filiere;
        $etudiants = Etudiant::where('id_filiere', $id_fil)->get();

        // Set default values for absent students
        foreach ($etudiants as $key => $e) {
            $absence = $abs->where('id_etudiant', $e->id_etudiant)->first();
            if ($absence) {
                $etudiants[$key]->etat = $absence->etat;
                $etudiants[$key]->justification = $absence->justification;
            } else {
                $etudiants[$key]->etat = 0;
                $etudiants[$key]->justification = 'Non Justifie';
            }
        }
    }

    return view('Enseignant.NoterAbsenceEdit', compact('seance', 'etudiants', 'filiere', 'abs'));
}


public function saveAbsence(Request $request)
{

     // validation
     $request -> validate([
         'absence.*.id_etu' => 'required |numeric',
         'absence.*.etat' => 'required |numeric|in:0,1',
     ]);

    $absences = $request->absence;
    $tableAbsence=[];
  try {
       foreach ($absences as $absence) {
        // Absence::where('id_sea',$request->id_sea)->where('id_etu',$absence['id_etu']);
          $tableAbsence[]= [

            'id_seance' => $request->id_sea,
            'id_etudiant' => $absence['id_etu'] ,
            'etat' => $absence['etat'] ,
            'justification' => $absence['justification'] ,
        ];

    }
     // inserer les absences dans la table absence
    Absence::insert($tableAbsence);
    // remplacer la valeur du champ 'active' par '1' pour ne pas re-enregistrer l'absence la deuxieme fois
    Seance::where('id_seance',$request->id_sea)->update(['active' => 1]);

       return redirect()->route('list.seance')->with(['success' => 'absence est bien ajouter ']);
  } catch (\Exception $ex) {
      return $ex;
    return redirect()->route('list.seance')->with(['error' => 'Erreur!!! ']);
  }

}
public function editAbsence(Request $request)
{
    // Validation
    $request->validate([
        'absence.*.id_etu' => 'required |numeric',
        'absence.*.etat' => 'required |numeric|in:0,1',
    ]);

    $absences = $request->absence;
    $tableAbsence = [];

    try {
        foreach ($absences as $absence) {
            $tableAbsence[] = [
                'id_seance' => $request->id_sea,
                'id_etudiant' => $absence['id_etu'],
                'etat' => $absence['etat'],
                'justification' => $absence['justification'],
            ];
        }

        // Update or create absences using the Absence model
        foreach ($tableAbsence as $absenceData) {
            Absence::updateOrCreate(
                [
                    'id_seance' => $absenceData['id_seance'],
                    'id_etudiant' => $absenceData['id_etudiant'],
                ],
                $absenceData
            );
        }

        // Update the 'active' field to avoid re-registering the absence
        Seance::where('id_seance', $request->id_sea)->update(['active' => 1]);

        return redirect()->route('list.seance')->with(['success' => 'Absence modifiée avec succès']);
    } catch (\Exception $ex) {
        return redirect()->route('list.seance')->with(['error' => 'Erreur lors de la modification de l\'absence']);
    }
}

// afficher l'historique d'absence
public function historiqueAbsence()
{
    $enseignant = Enseignant::select('id_enseignant')->where('id_user', '=', Auth::user()->id)->first();
    $id_prof = $enseignant ? $enseignant->id_enseignant : null;   

    $matieres = Matiere::where('id_enseignant','=',$id_prof)->get();
    $seances = Seance::with('matiere')->where('id_enseignant','=',$id_prof)
    ->where('active',1)
    ->get();
    $absence = [];

    foreach($seances as $key=>$s){
        $absence[$key] = $s->absences()->get();
    }
    //dd($matieres);


   return view('Enseignant.historiqueAbsence',compact('seances','absence','matieres'));
}

}

