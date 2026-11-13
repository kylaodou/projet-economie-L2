<?php

namespace App\Http\Controllers;

use App\Exports\JounalExport;
use App\Models\Mouvement;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;


class MouvementController extends Controller
{
    public function ajouterMouvement()
    {
        return view('mouvement.ajouter');
    }

    public function home()
    {
        return view('mouvement.home');
    }

    public function traitement(Request $request)
    {
        $data = $request->validate([
            'dates' => 'required|array|min:1',
            'dates.*' => 'required|date',
            'libelles.*' => 'required|string|max:255',
            'comptes.*' => 'required|numeric',
            'types.*' => 'required|string|in:crédité,débité,Crédité,Débité',
            'montant.*' => 'required|numeric|min:0',
        ]);

        foreach ($data['dates'] as $index => $date) {
            Mouvement::create([
                'date' => $date,
                'resultat' => '0',
                'libelle' => $data['libelles'][$index],
                'compte' => $data['comptes'][$index],
                'montant' => $data['montant'][$index],
                // Valeurs de la colonne ENUM : 'crédité' ou 'débité'
                'type' => mb_strtolower($data['types'][$index]),
            ]);
        }

        return back()->with('success', 'Movements have been saved successfully.');
    }

    public function liste()
    {
        $mouvementsParCompte = Mouvement::all()->groupBy('compte');

        // Préparer les données pour la vue
        $dataPourVue = [];
        foreach ($mouvementsParCompte as $compte => $mouvements) {
            foreach ($mouvements as $mouvement) {
                $dataPourVue[$compte][] = [
                    'date' => $mouvement->date,
                    'libelle' => $mouvement->libelle,
                    'credit' => $mouvement->type === 'crédité' ? $mouvement->montant : '0',
                    'debit' => $mouvement->type === 'débité' ? $mouvement->montant : '0',
                ];
            }
        }
        return view('mouvement.liste', ['dataPourVue' => $dataPourVue]);
    }

    public function affichier()
    {
        $journal = Mouvement::all(); // Assuming you have a JournalEntry model
        return view('mouvement.journal', compact('journal'));
    }

    public function exportjounal()
    {
        return Excel::download(new JounalExport(), 'jounal.xlsx');
    }

    public function rapport()
    {
        return view('mouvement.rapports');
    }

    public function exportJournalToPDF()
    {
        $journal = Mouvement::all();

        $pdf = PDF::loadView('mouvement.pdfjournal', compact('journal'));

        // Pour télécharger le PDF généré
        return $pdf->download('journal.pdf');
    }
}
