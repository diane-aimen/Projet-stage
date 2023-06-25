<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Prof\ProfController;
use App\Http\Controllers\Prof\EtudiantController as ProfEtudiantController;
use App\Http\Controllers\Etudiant\EtudiantController ;
use App\Http\Controllers\Admin\matiereController;
use App\Http\Controllers\Admin\profController as adminProfController;


/*      Admin     */

use App\Http\Controllers\Admin\adminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class,'index'])->name('home');

Route::group(['prefix' => 'Etudiant' , 'namespace' => 'Etudiant'], function () {

    Route::get('/',[EtudiantController::class,'index'])->name('home.student');


});


Route::view('/Administration','administration.administration');

//--------------  Espace Prof--------------------//
Route::middleware(['prof'])->prefix('Prof')->namespace('Prof')->group(function () {
    Route::get('/', [ProfController::class, 'index'])->name('home.prof');

    Route::get('/listmodules', [ProfEtudiantController::class, 'listModules'])->name('liste.modules');
    Route::get('/listmodules/{id}/etudiant', [ProfEtudiantController::class, 'listEtudiant'])->name('etudiant.list');

    Route::get('/create-seance', [ProfController::class, 'createSeance'])->name('create.seance');
    Route::post('/save-seance', [ProfController::class, 'saveSeance'])->name('save.seance');
    Route::get('/list-seance', [ProfController::class, 'listSeance'])->name('list.seance');

    Route::get('/noterabsence/{id}', [ProfController::class, 'PageNoteAbsence'])->name('pageAbsence');
    Route::get('/noterabsence/{id}/edit', [ProfController::class, 'PageNoteAbsenceEdit'])->name('pageAbsenceEdit');
    Route::post('/save-absence', [ProfController::class, 'saveAbsence'])->name('save.absence');
    Route::post('/edit-absence', [ProfController::class, 'editAbsence'])->name('edit.absence');

    Route::get('/historique-absence', [ProfController::class, 'historiqueAbsence'])->name('historique.absence');
});

//--------------  Espace Prof--------------------//


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
