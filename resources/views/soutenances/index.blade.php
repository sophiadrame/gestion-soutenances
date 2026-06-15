@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-calendar3 text-primary"></i> Planning des Soutenances</h2>
    <a href="{{ route('soutenances.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nouvelle Soutenance
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Étudiant</th>
                    <th>Titre du mémoire</th>
                    <th>Filière</th>
                    <th>Date</th>
                    <th>Horaire</th>
                    <th>Salle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($soutenances as $s)
                <tr>
                    <td>{{ $s->etudiant_prenom }} {{ $s->etudiant_nom }}</td>
                    <td>{{ Str::limit($s->titre_memoire, 40) }}</td>
                    <td>{{ $s->filiere }}</td>
                    <td>{{ \Carbon\Carbon::parse($s->date_soutenance)->format('d/m/Y') }}</td>
                    <td>{{ $s->heure_debut }} – {{ $s->heure_fin }}</td>
                    <td>{{ $s->salle }}</td>
                    <td>
                        <span class="badge badge-{{ str_replace(' ', '-', $s->statut) }}">
                            {{ ucfirst($s->statut) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('soutenances.edit', $s) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('soutenances.destroy', $s) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cette soutenance ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <i class="bi bi-calendar-x fs-3"></i><br>Aucune soutenance planifiée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection