<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\etudiantController;
use App\Http\Controllers\Admin\matiereController;

/*      Admin     */

use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\profController;

Route::get('/', [adminController::class, 'index'])->middleware('myadmin');

Route::middleware('myadmin')->prefix('teacher')->group(function () {
    Route::get('/addTeacher', [profController::class, 'addProf'])->name("add.prof");
    Route::get('/showAll', [profController::class, 'showAllProf'])->name("show.all.prof");
    Route::post('/saveProf', [profController::class, 'save'])->name('save');
    Route::get('/edit/{id}', [profController::class, 'editprof'])->name('editprof');
    Route::put('/update/{id}', [profController::class, 'updateprof'])->name('updateprof');
    Route::get('/delete/{id}', [profController::class, 'deleteprof'])->name('deleteprof');
    
});


    Route::middleware('myadmin')->prefix('student')->group(function () {

        Route::get('/addStudent', [EtudiantController::class, 'addStudent'])->name("add.student");
        Route::get('/showAll', [EtudiantController::class, 'showAllStudent'])->name("show.all.student");

        Route::post('/saveStudent',[EtudiantController::class,'saveStudent'])->name("save.student");
        Route::get('edit/{id}',[etudiantController::class,'editStudent'])->name("edit.student");
        Route::get('delete/{id}',[etudiantController::class,'deleteStudent'])->name("delete.student");
        Route::post('update',[etudiantController::class,'updateStudent'])->name("update.student");
    });

    Route::middleware(['myadmin'])->prefix('matiere')->group(function () {
        Route::get('/addMatiere', [matiereController::class, 'addMatiere'])->name("add.matiere");
        Route::get('/showAll', [matiereController::class, 'showAllMatiere'])->name("show.all.matiere");
        Route::post('/saveMatiere', [matiereController::class, 'saveMatiere'])->name("save.matiere");
        Route::get('/edit/{id}', [matiereController::class, 'editMatiere'])->name("edit.matiere");
        Route::get('/delete/{id}', [matiereController::class, 'deleteMatiere'])->name("delete.matiere");
        Route::post('/update', [matiereController::class, 'updateMatiere'])->name("update.matiere");
    });


