<?php

namespace App\Http\Controllers;

use App\Models\Jury;
use App\Models\Soutenance;
use Illuminate\Http\Request;

class JuryController extends Controller
{
    public function index()
    {
        $juries = Jury::with('soutenance')->orderBy('created_at', 'desc')->get();
        return view('juries.index', compact('juries'));
    }

    public function create()
    {
        $soutenances = Soutenance::orderBy('date_soutenance')->get();
        return view('juries.create', compact('soutenances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'soutenance_id' => 'required|exists:soutenances,id',
            'nom'           => 'required|string|max:100',
            'prenom'        => 'required|string|max:100',
            'email'         => 'nullable|email|max:150',
            'telephone'     => 'nullable|string|max:20',
            'role'          => 'required|in:président,rapporteur,examinateur',
            'grade'         => 'nullable|string|max:100',
        ]);

        Jury::create($request->all());
        return redirect()->route('juries.index')
                         ->with('success', 'Membre du jury ajouté avec succès !');
    }

    public function edit(Jury $jury)
    {
        $soutenances = Soutenance::orderBy('date_soutenance')->get();
        return view('juries.edit', compact('jury', 'soutenances'));
    }

    public function update(Request $request, Jury $jury)
    {
        $request->validate([
            'soutenance_id' => 'required|exists:soutenances,id',
            'nom'           => 'required|string|max:100',
            'prenom'        => 'required|string|max:100',
            'email'         => 'nullable|email|max:150',
            'telephone'     => 'nullable|string|max:20',
            'role'          => 'required|in:président,rapporteur,examinateur',
            'grade'         => 'nullable|string|max:100',
        ]);

        $jury->update($request->all());
        return redirect()->route('juries.index')
                         ->with('success', 'Membre du jury modifié avec succès !');
    }

    public function destroy(Jury $jury)
    {
        $jury->delete();
        return redirect()->route('juries.index')
                         ->with('success', 'Membre supprimé.');
    }
}