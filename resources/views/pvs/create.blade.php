@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-earmark-plus text-primary"></i> Créer un PV</h2>
    <a href="{{ route('pvs.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('pvs.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Soutenance concernée</label>
                    <select name="soutenance_id" class="form-select @error('soutenance_id') is-invalid @enderror">
                        <option value="">-- Choisir une soutenance --</option>
                        @foreach($soutenances as $s)
                            <option value="{{ $s->id }}" {{ old('soutenance_id') == $s->id ? 'selected' : '' }}>
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
                           value="{{ old('note') }}" placeholder="Ex: 14.50">
                    @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Mention</label>
                    <select name="mention" class="form-select @error('mention') is-invalid @enderror" id="mention">
                        <option value="">-- Choisir --</option>
                        <option value="Passable" {{ old('mention') == 'Passable' ? 'selected' : '' }}>Passable (10-12)</option>
                        <option value="Assez Bien" {{ old('mention') == 'Assez Bien' ? 'selected' : '' }}>Assez Bien (12-14)</option>
                        <option value="Bien" {{ old('mention') == 'Bien' ? 'selected' : '' }}>Bien (14-16)</option>
                        <option value="Très Bien" {{ old('mention') == 'Très Bien' ? 'selected' : '' }}>Très Bien (16-20)</option>
                    </select>
                    @error('mention') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Décision</label>
                    <select name="decision" class="form-select @error('decision') is-invalid @enderror">
                        <option value="Admis" {{ old('decision') == 'Admis' ? 'selected' : '' }}>Admis</option>
                        <option value="Ajourné" {{ old('decision') == 'Ajourné' ? 'selected' : '' }}>Ajourné</option>
                        <option value="Admis avec réserves" {{ old('decision') == 'Admis avec réserves' ? 'selected' : '' }}>Admis avec réserves</option>
                    </select>
                    @error('decision') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date du PV</label>
                    <input type="date" name="date_pv" class="form-control @error('date_pv') is-invalid @enderror"
                           value="{{ old('date_pv', date('Y-m-d')) }}">
                    @error('date_pv') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Appréciation <span class="text-muted">(optionnel)</span></label>
                    <textarea name="appreciation" rows="3"
                              class="form-control @error('appreciation') is-invalid @enderror"
                              placeholder="Commentaires du jury sur le travail de l'étudiant...">{{ old('appreciation') }}</textarea>
                    @error('appreciation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-check-lg"></i> Enregistrer le PV
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection