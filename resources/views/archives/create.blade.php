@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-archive text-primary"></i> Archiver un document</h2>
    <a href="{{ route('archives.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('archives.store') }}" method="POST" enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <label class="form-label fw-bold">Type de document</label>
                    <select name="type_document" class="form-select @error('type_document') is-invalid @enderror">
                        <option value="">-- Choisir --</option>
                        <option value="Mémoire" {{ old('type_document') == 'Mémoire' ? 'selected' : '' }}>Mémoire</option>
                        <option value="PV de soutenance" {{ old('type_document') == 'PV de soutenance' ? 'selected' : '' }}>PV de soutenance</option>
                        <option value="Rapport de stage" {{ old('type_document') == 'Rapport de stage' ? 'selected' : '' }}>Rapport de stage</option>
                        <option value="Autre" {{ old('type_document') == 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('type_document') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Année universitaire</label>
                    <input type="text" name="annee_universitaire"
                           class="form-control @error('annee_universitaire') is-invalid @enderror"
                           value="{{ old('annee_universitaire', '2025-2026') }}"
                           placeholder="Ex: 2025-2026">
                    @error('annee_universitaire') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Fichier <span class="text-muted">(PDF, DOC, DOCX — max 10MB)</span></label>
                    <input type="file" name="fichier" accept=".pdf,.doc,.docx"
                           class="form-control @error('fichier') is-invalid @enderror">
                    @error('fichier') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Description <span class="text-muted">(optionnel)</span></label>
                    <textarea name="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Courte description du document...">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-cloud-upload"></i> Archiver
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection