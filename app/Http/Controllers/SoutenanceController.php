<?php

namespace App\Http\Controllers;

use App\Models\Soutenance;
use Illuminate\Http\Request;

class SoutenanceController extends Controller
{
    public function index()
    {
        $soutenances = Soutenance::orderBy('date_soutenance')->get();
        return view('soutenances.index', compact('soutenances'));
    }

    public function create()
    {
        return view('soutenances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre_memoire'   => 'required|string|max:255',
            'etudiant_nom'    => 'required|string|max:100',
            'etudiant_prenom' => 'required|string|max:100',
            'filiere'         => 'required|string|max:100',
            'date_soutenance' => 'required|date',
            'heure_debut'     => 'required',
            'heure_fin'       => 'required|after:heure_debut',
            'salle'           => 'required|string|max:50',
        ]);

        Soutenance::create($request->all());
        return redirect()->route('soutenances.index')
                         ->with('success', 'Soutenance planifiée avec succès !');
    }

    public function edit(Soutenance $soutenance)
    {
        return view('soutenances.edit', compact('soutenance'));
    }

    public function update(Request $request, Soutenance $soutenance)
    {
        $request->validate([
            'titre_memoire'   => 'required|string|max:255',
            'etudiant_nom'    => 'required|string|max:100',
            'etudiant_prenom' => 'required|string|max:100',
            'filiere'         => 'required|string|max:100',
            'date_soutenance' => 'required|date',
            'heure_debut'     => 'required',
            'heure_fin'       => 'required|after:heure_debut',
            'salle'           => 'required|string|max:50',
            'statut'          => 'required',
        ]);

        $soutenance->update($request->all());
        return redirect()->route('soutenances.index')
                         ->with('success', 'Soutenance modifiée avec succès !');
    }

    public function destroy(Soutenance $soutenance)
    {
        $soutenance->delete();
        return redirect()->route('soutenances.index')
                         ->with('success', 'Soutenance supprimée.');
    }
}