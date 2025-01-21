<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouvementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/ajouter', [MouvementController::class, 'ajouterMouvement']);
route::post('/traitement', [MouvementController::class, 'traitement']);
route::get('/liste', [MouvementController::class, 'liste']);
route::get('/journal', [MouvementController::class, 'affichier']);
route::get('', [MouvementController::class, 'home']);
route::get('/export-journal', [MouvementController::class, 'exportjounal']);
route::get('/rapport', [MouvementController::class, 'rapport']);
route::get('/export-journal-pdf', [MouvementController::class, 'exportJournalToPDF']);

