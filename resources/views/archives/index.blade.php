@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-archive text-primary"></i> Archivage des Documents</h2>
    <a href="{{ route('archives.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Archiver un document
    </a>
</div>

{{-- Filtres --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('archives.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-bold">Année universitaire</label>
                <select name="annee" class="form-select">
                    <option value="">-- Toutes les années --</option>
                    @foreach($annees as $annee)
                        <option value="{{ $annee }}" {{ request('annee') == $annee ? 'selected' : '' }}>
                            {{ $annee }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Type de document</label>
                <select name="type" class="form-select">
                    <option value="">-- Tous les types --</option>
                    <option value="Mémoire" {{ request('type') == 'Mémoire' ? 'selected' : '' }}>Mémoire</option>
                    <option value="PV de soutenance" {{ request('type') == 'PV de soutenance' ? 'selected' : '' }}>PV de soutenance</option>
                    <option value="Rapport de stage" {{ request('type') == 'Rapport de stage' ? 'selected' : '' }}>Rapport de stage</option>
                    <option value="Autre" {{ request('type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel"></i> Filtrer
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Document</th>
                    <th>Type</th>
                    <th>Étudiant</th>
                    <th>Année</th>
                    <th>Description</th>
                    <th>Archivé le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($archives as $archive)
                <tr>
                    <td>
                        <i class="bi bi-file-earmark-pdf text-danger"></i>
                        {{ $archive->nom_fichier }}
                    </td>
                    <td><span class="badge bg-info text-dark">{{ $archive->type_document }}</span></td>
                    <td>{{ $archive->soutenance->etudiant_prenom }} {{ $archive->soutenance->etudiant_nom }}</td>
                    <td>{{ $archive->annee_universitaire }}</td>
                    <td>{{ Str::limit($archive->description, 40) ?? '—' }}</td>
                    <td>{{ $archive->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('archives.download', $archive) }}" class="btn btn-sm btn-success" title="Télécharger">
                            <i class="bi bi-download"></i>
                        </a>
                        <form action="{{ route('archives.destroy', $archive) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cette archive ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-archive fs-3"></i><br>Aucun document archivé
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection