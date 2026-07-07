@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-square text-warning"></i> Modifier un PV</h2>
    <a href="{{ route('pvs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('pvs.update', $pv) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Soutenance concernée</label>
                    <select name="soutenance_id" class="form-select @error('soutenance_id') is-invalid @enderror">
                        @foreach($soutenances as $s)
                            <option value="{{ $s->id }}" {{ old('soutenance_id', $pv->soutenance_id) == $s->id ? 'selected' : '' }}>
                                {{ $s->etudiant_prenom }} {{ $s->etudiant_nom }} — {{ Str::limit($s->titre_memoire, 50) }}
                            </option>
                        @endforeach
                    </select>
                    @error('soutenance_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Note (/20)</label>
                    <input type="number" name="note" step="0.25" min="0" max="20"
                           class="form-control @error('note') is-invalid @enderror"
                           value="{{ old('note', $pv->note) }}">
                    @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Mention</label>
                    <select name="mention" class="form-select @error('mention') is-invalid @enderror">
                        <option value="Passable" {{ old('mention', $pv->mention) == 'Passable' ? 'selected' : '' }}>Passable</option>
                        <option value="Assez Bien" {{ old('mention', $pv->mention) == 'Assez Bien' ? 'selected' : '' }}>Assez Bien</option>
                        <option value="Bien" {{ old('mention', $pv->mention) == 'Bien' ? 'selected' : '' }}>Bien</option>
                        <option value="Très Bien" {{ old('mention', $pv->mention) == 'Très Bien' ? 'selected' : '' }}>Très Bien</option>
                    </select>
                    @error('mention') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Décision</label>
                    <select name="decision" class="form-select @error('decision') is-invalid @enderror">
                        <option value="Admis" {{ old('decision', $pv->decision) == 'Admis' ? 'selected' : '' }}>Admis</option>
                        <option value="Ajourné" {{ old('decision', $pv->decision) == 'Ajourné' ? 'selected' : '' }}>Ajourné</option>
                        <option value="Admis avec réserves" {{ old('decision', $pv->decision) == 'Admis avec réserves' ? 'selected' : '' }}>Admis avec réserves</option>
                    </select>
                    @error('decision') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date du PV</label>
                    <input type="date" name="date_pv" class="form-control @error('date_pv') is-invalid @enderror"
                           value="{{ old('date_pv', $pv->date_pv) }}">
                    @error('date_pv') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Appréciation</label>
                    <textarea name="appreciation" rows="3"
                              class="form-control @error('appreciation') is-invalid @enderror">{{ old('appreciation', $pv->appreciation) }}</textarea>
                    @error('appreciation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-warning px-5">
                        <i class="bi bi-check-lg"></i> Mettre à jour
                    </button>
                    <a href="{{ route('pvs.index') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection