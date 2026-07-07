<?php

namespace App\Http\Controllers;

use App\Models\ProcesVerbal;
use App\Models\Soutenance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProcesVerbalController extends Controller
{
    public function index()
    {
        $pvs = ProcesVerbal::with('soutenance')->orderBy('date_pv', 'desc')->get();
        return view('pvs.index', compact('pvs'));
    }

    public function create()
    {
        $soutenances = Soutenance::orderBy('date_soutenance')->get();
        return view('pvs.create', compact('soutenances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'soutenance_id' => 'required|exists:soutenances,id',
            'note'          => 'required|numeric|min:0|max:20',
            'mention'       => 'required|in:Passable,Assez Bien,Bien,Très Bien',
            'appreciation'  => 'nullable|string',
            'decision'      => 'required|in:Admis,Ajourné,Admis avec réserves',
            'date_pv'       => 'required|date',
        ]);

        ProcesVerbal::create($request->all());
        return redirect()->route('pvs.index')
                         ->with('success', 'PV créé avec succès !');
    }

    public function genererPDF(ProcesVerbal $pv)
    {
        $pv->load('soutenance.juries');
        $pdf = Pdf::loadView('pvs.pdf', compact('pv'))
                  ->setPaper('a4', 'portrait');
        return $pdf->download('PV_' . $pv->soutenance->etudiant_nom . '_' . $pv->soutenance->etudiant_prenom . '.pdf');
    }

    public function edit(ProcesVerbal $pv)
    {
    $soutenances = Soutenance::orderBy('date_soutenance')->get();
    return view('pvs.edit', compact('pv', 'soutenances'));
    }

    public function update(Request $request, ProcesVerbal $pv)
    {
    $request->validate([
        'soutenance_id' => 'required|exists:soutenances,id',
        'note'          => 'required|numeric|min:0|max:20',
        'mention'       => 'required|in:Passable,Assez Bien,Bien,Très Bien',
        'appreciation'  => 'nullable|string',
        'decision'      => 'required|in:Admis,Ajourné,Admis avec réserves',
        'date_pv'       => 'required|date',
    ]);

    $pv->update($request->all());
    return redirect()->route('pvs.index')
                     ->with('success', 'PV modifié avec succès !');
    }

    public function destroy(ProcesVerbal $pv)
    {
        $pv->delete();
        return redirect()->route('pvs.index')
                         ->with('success', 'PV supprimé.');
    }
}