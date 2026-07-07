<?php

namespace App\Http\Controllers;

use App\Models\Soutenance;
use App\Models\Jury;
use App\Models\ProcesVerbal;
use App\Models\Archive;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSoutenances = Soutenance::count();
        $soutenancesPlanifiees = Soutenance::where('statut', 'planifiée')->count();
        $soutenancesTerminees = Soutenance::where('statut', 'terminée')->count();
        $totalJury = Jury::count();
        $totalPV = ProcesVerbal::count();
        $totalArchives = Archive::count();

        $prochainesSoutenances = Soutenance::where('date_soutenance', '>=', now())
            ->orderBy('date_soutenance')
            ->take(5)
            ->get();

        $dernieresArchives = Archive::with('soutenance')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalSoutenances',
            'soutenancesPlanifiees',
            'soutenancesTerminees',
            'totalJury',
            'totalPV',
            'totalArchives',
            'prochainesSoutenances',
            'dernieresArchives'
        ));
    }
}