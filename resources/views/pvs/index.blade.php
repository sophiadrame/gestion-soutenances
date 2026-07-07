@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-earmark-text text-primary"></i> Procès-Verbaux</h2>
    <a href="{{ route('pvs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nouveau PV
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Étudiant</th>
                    <th>Titre du mémoire</th>
                    <th>Note</th>
                    <th>Mention</th>
                    <th>Décision</th>
                    <th>Date PV</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pvs as $pv)
                <tr>
                    <td>{{ $pv->soutenance->etudiant_prenom }} {{ $pv->soutenance->etudiant_nom }}</td>
                    <td>{{ Str::limit($pv->soutenance->titre_memoire, 35) }}</td>
                    <td><strong>{{ $pv->note }}/20</strong></td>
                    <td>
                        @if($pv->mention == 'Très Bien')
                            <span class="badge bg-success">{{ $pv->mention }}</span>
                        @elseif($pv->mention == 'Bien')
                            <span class="badge bg-primary">{{ $pv->mention }}</span>
                        @elseif($pv->mention == 'Assez Bien')
                            <span class="badge bg-info text-dark">{{ $pv->mention }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $pv->mention }}</span>
                        @endif
                    </td>
                    <td>
                        @if($pv->decision == 'Admis')
                            <span class="badge bg-success">{{ $pv->decision }}</span>
                        @elseif($pv->decision == 'Ajourné')
                            <span class="badge bg-danger">{{ $pv->decision }}</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ $pv->decision }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($pv->date_pv)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('pvs.pdf', $pv) }}" class="btn btn-sm btn-success" title="Télécharger PDF">
                            <i class="bi bi-file-pdf"></i>
                        </a>
                        <a href="{{ route('pvs.edit', $pv) }}" class="btn btn-sm btn-warning" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('pvs.destroy', $pv) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce PV ?')">
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
                        <i class="bi bi-file-earmark-x fs-3"></i><br>Aucun PV enregistré
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection