<?php

use App\Livewire\Accueil;
use App\Livewire\AjoutOffre;
use App\Livewire\Candidat;
use App\Livewire\Candidature;
use App\Livewire\Demandes;
use App\Livewire\DemandesEmploye;
use App\Livewire\DemandesEspaceEmploye;
use App\Livewire\Formulaire2;
use App\Livewire\Offre;
use App\Livewire\OffreItem;
use App\Livewire\ProgramerUnEntretient;
use Illuminate\Support\Facades\Route;

use App\Livewire\LePersonnel;
use App\Livewire\Agentur;
use App\Livewire\Settings;
use App\Livewire\Diplome;
use App\Livewire\PaysVille;
use App\Livewire\DptFonction;
use App\Livewire\Users;


// Add comments to explain the purpose of each route and the middleware used

// Use the 'as' method to assign a route name alias for better code readability and maintainability


Route::get('/le_personnel', LePersonnel::class)
    ->middleware(['auth', 'verified'])
    ->name('le_personnel');

// Employee details route
Route::get('/employee-details/{agentId}', 'LePersonnel@showDetails')
    ->middleware(['auth', 'verified'])
    ->name('employee-details');

Route::get('/agentur/{id}', Agentur::class)
    ->middleware(['auth', 'verified'])
    ->name('agentur') ;

Route::get('/settings', Settings::class)
    ->middleware(['auth', 'verified'])
    ->name('settings');

Route::get('/pays_ville', PaysVille::class)
    ->middleware(['auth', 'verified'])
    ->name('pays_ville');

Route::get('/dpt_fonction', DptFonction::class)
    ->middleware(['auth', 'verified'])
    ->name('dpt_fonction');

Route::get('/diplome', Diplome::class)
    ->middleware(['auth', 'verified'])
    ->name('diplome');

Route::get('/users', Users::class)
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::get('/accueil', Accueil::class)
    ->middleware(['auth', 'verified'])
    ->name('accueil');

    Route::get('/demandes', DemandesEmploye::class)
    ->middleware(['auth', 'verified'])
    ->name('demandes');

    Route::get('/demandes_employe', DemandesEspaceEmploye::class)
    ->middleware(['auth', 'verified'])
    ->name('demandes_employe');

    Route::get('/candidat', Candidat::class)
    ->middleware(['auth', 'verified'])
    ->name('candidat');

    Route::get('/formulaire2', Formulaire2::class)
    ->middleware(['auth', 'verified'])
    ->name('formulaire2');


    Route::get('/offre', Offre::class)
    ->middleware(['auth', 'verified'])
    ->name('offre');

    
    Route::get('/candidature/{id}', Candidature::class)
    ->middleware(['auth', 'verified'])
    ->name('candidature');
    
    Route::get('/offre/{id}', OffreItem::class)
    ->middleware(['auth', 'verified'])
    ->name('offre_item');

    Route::get('/ajoutoffre', AjoutOffre::class)
    ->middleware(['auth', 'verified'])
    ->name('ajoutoffre');


 Route::get('/programer_un_entretient', ProgramerUnEntretient::class)
    ->middleware(['auth', 'verified'])
    ->name('programer_un_entretient');


// Add comments to explain the purpose of each route and the middleware used
Route::view('/', 'welcome')
->name('welcome');

Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

