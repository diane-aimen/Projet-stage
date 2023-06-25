<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semestre; 
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create();
        $roles = [
            [
                'id_role' => 1,
                'type' => 'superadmin'
            ],
            [
                'id_role' => 2,
                'type' => 'admin'
            ],
            [
                'id_role' => 3,
                'type' => 'prof'
            ],
            [
                'id_role' => 4,
                'type' => 'etudiant'
            ],
            ];
        \App\Models\Role::insert($roles);
        $Departement=[
            [
            'id_departement' => 1,
            'nom_dep' => 'Informatique',
            ],
            [
                'id_departement'=>2,
                'nom_dep' => 'mecanique'
            ]

            ];
            // \App\Models\Departement::insert($Departement);
        $fil=[
            [
                'nom_filiere' => 'Developpement digital',
                'id_departement' => 1,

            ],
            [
                'nom_filiere' => 'infrastructure digital',
                'id_departement' => 1,

            ],
            [
                'nom_filiere' => 'Electro Mecanique',
                'id_departement' => 2,

            ],
            [
                'nom_filiere' => 'Fabrication Mecanique',
                'id_departement' => 2,

            ],
        ];    
        // \App\Models\Filiere::insert($fil);    
        $prof=[
            [
                'nom_ens'=>' bouchti',
                'prenom_ens'=>'hicham',
                'phone_ens'=>'0645658569',
                'adresse_ens'=>'casablanca',
                'id_user'=>1,
            ],
            [
                'nom_ens'=>' diane',
                'prenom_ens'=>'mohamed',
                'phone_ens'=>'0645658570',
                'adresse_ens'=>'casablanca',
                'id_user'=>1,
            ],
            [
                'nom_ens'=>' khedif',
                'prenom_ens'=>'bilal',
                'phone_ens'=>'0645658571',
                'adresse_ens'=>'fes',
                'id_user'=>1,
            ],
            ];
            // \App\Models\Enseignant::insert($prof);
        //     Semestre::create([
        //         'id_semestre' => 3,
        //         'nom_sem' => 'S3',        
        //  ]);
         
           
    }
}
