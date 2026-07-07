@extends('layouts.app')

@section('content')
<h2 class="mb-4"><i class="bi bi-speedometer2 text-primary"></i> Tableau de bord</h2>

{{-- Cartes statistiques --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #1F4E79, #2E75B6);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Total Soutenances</h6>
                        <h2 class="mb-0">{{ $totalSoutenances }}</h2>
                    </div>
                    <i class="bi bi-calendar3 fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #198754, #28a745);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Membres du Jury</h6>
                        <h2 class="mb-0">{{ $totalJury }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #fd7e14, #ffc107);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">PV Générés</h6>
                        <h2 class="mb-0">{{ $totalPV }}</h2>
                    </div>
                    <i class="bi bi-file-earmark-text fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white" style="background: linear-gradient(135deg, #6f42c1, #9c5fd6);">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 opacity-75">Documents Archivés</h6>
                        <h2 class="mb-0">{{ $totalArchives }}</h2>
                    </div>
                    <i class="bi bi-archive fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Barre de progression statuts --}}
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title mb-3"><i class="bi bi-pie-chart text-primary"></i> État des soutenances</h5>
        <div class="row text-center">
            <div class="col-md-4">
                <h3 class="text-primary">{{ $soutenancesPlanifiees }}</h3>
                <p class="text-muted mb-0">Planifiées</p>
            </div>
            <div class="col-md-4">
                <h3 class="text-success">{{ $soutenancesTerminees }}</h3>
                <p class="text-muted mb-0">Terminées</p>
            </div>
            <div class="col-md-4">
                <h3 class="text-secondary">{{ $totalSoutenances - $soutenancesPlanifiees - $soutenancesTerminees }}</h3>
                <p class="text-muted mb-0">Autres</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Prochaines soutenances --}}
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-calendar-check text-primary"></i> Prochaines soutenances
                </h5>
                @forelse($prochainesSoutenances as $s)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <strong>{{ $s->etudiant_prenom }} {{ $s->etudiant_nom }}</strong><br>
                        <small class="text-muted">{{ Str::limit($s->titre_memoire, 40) }}</small>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary">{{ \Carbon\Carbon::parse($s->date_soutenance)->format('d/m/Y') }}</span><br>
                        <small class="text-muted">{{ $s->salle }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-3">Aucune soutenance à venir</p>
                @endforelse
                <div class="text-end mt-3">
                    <a href="{{ route('soutenances.index') }}" class="btn btn-sm btn-outline-primary">
                        Voir tout le planning <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Dernières archives --}}
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="bi bi-archive text-primary"></i> Dernières archives
                </h5>
                @forelse($dernieresArchives as $archive)
                <div class="d-flex align-items-center border-bottom py-2">
                    <i class="bi bi-file-earmark-pdf text-danger fs-4 me-2"></i>
                    <div>
                        <small class="fw-bold">{{ Str::limit($archive->nom_fichier, 25) }}</small><br>
                        <small class="text-muted">{{ $archive->soutenance->etudiant_nom }}</small>
                    </div>
                </div>
                @empty
                <p class="text-muted text-center py-3">Aucune archive récente</p>
                @endforelse
                <div class="text-end mt-3">
                    <a href="{{ route('archives.index') }}" class="btn btn-sm btn-outline-primary">
                        Voir toutes les archives <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection