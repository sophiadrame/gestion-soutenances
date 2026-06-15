@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people text-primary"></i> Gestion du Jury</h2>
    <a href="{{ route('juries.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Ajouter un membre
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Membre</th>
                    <th>Grade</th>
                    <th>Rôle</th>
                    <th>Soutenance</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($juries as $jury)
                <tr>
                    <td>{{ $jury->prenom }} {{ $jury->nom }}</td>
                    <td>{{ $jury->grade ?? '—' }}</td>
                    <td>
                        @if($jury->role == 'président')
                            <span class="badge bg-primary">Président</span>
                        @elseif($jury->role == 'rapporteur')
                            <span class="badge bg-warning text-dark">Rapporteur</span>
                        @else
                            <span class="badge bg-secondary">Examinateur</span>
                        @endif
                    </td>
                    <td>
                        <small>{{ Str::limit($jury->soutenance->titre_memoire, 35) }}</small><br>
                        <small class="text-muted">{{ $jury->soutenance->etudiant_prenom }} {{ $jury->soutenance->etudiant_nom }}</small>
                    </td>
                    <td>{{ $jury->email ?? '—' }}</td>
                    <td>{{ $jury->telephone ?? '—' }}</td>
                    <td>
                        <a href="{{ route('juries.edit', $jury) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('juries.destroy', $jury) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce membre ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-people fs-3"></i><br>Aucun membre de jury enregistré
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection