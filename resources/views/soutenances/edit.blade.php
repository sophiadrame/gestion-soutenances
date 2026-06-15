@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-square text-warning"></i> Modifier une Soutenance</h2>
    <a href="{{ route('soutenances.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('soutenances.update', $soutenance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom de l'étudiant</label>
                    <input type="text" name="etudiant_nom" class="form-control @error('etudiant_nom') is-invalid @enderror"
                           value="{{ old('etudiant_nom', $soutenance->etudiant_nom) }}">
                    @error('etudiant_nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Prénom de l'étudiant</label>
                    <input type="text" name="etudiant_prenom" class="form-control @error('etudiant_prenom') is-invalid @enderror"
                           value="{{ old('etudiant_prenom', $soutenance->etudiant_prenom) }}">
                    @error('etudiant_prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-bold">Titre du mémoire</label>
                    <input type="text" name="titre_memoire" class="form-control @error('titre_memoire') is-invalid @enderror"
                           value="{{ old('titre_memoire', $soutenance->titre_memoire) }}">
                    @error('titre_memoire') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filière</label>
                    <select name="filiere" class="form-select @error('filiere') is-invalid @enderror">
                        <option value="">-- Choisir --</option>
                        <option value="Génie Logiciel" {{ old('filiere', $soutenance->filiere) == 'Génie Logiciel' ? 'selected' : '' }}>Génie Logiciel</option>
                        <option value="Réseaux & Télécoms" {{ old('filiere', $soutenance->filiere) == 'Réseaux & Télécoms' ? 'selected' : '' }}>Réseaux & Télécoms</option>
                        <option value="Systèmes d'Information" {{ old('filiere', $soutenance->filiere) == "Systèmes d'Information" ? 'selected' : '' }}>Systèmes d'Information</option>
                    </select>
                    @error('filiere') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Date de soutenance</label>
                    <input type="date" name="date_soutenance" class="form-control @error('date_soutenance') is-invalid @enderror"
                           value="{{ old('date_soutenance', $soutenance->date_soutenance) }}">
                    @error('date_soutenance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Salle</label>
                    <input type="text" name="salle" class="form-control @error('salle') is-invalid @enderror"
                           value="{{ old('salle', $soutenance->salle) }}">
                    @error('salle') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Heure de début</label>
                    <input type="time" name="heure_debut" class="form-control @error('heure_debut') is-invalid @enderror"
                           value="{{ old('heure_debut', $soutenance->heure_debut) }}">
                    @error('heure_debut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Heure de fin</label>
                    <input type="time" name="heure_fin" class="form-control @error('heure_fin') is-invalid @enderror"
                           value="{{ old('heure_fin', $soutenance->heure_fin) }}">
                    @error('heure_fin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Statut</label>
                    <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                        <option value="planifiée" {{ old('statut', $soutenance->statut) == 'planifiée' ? 'selected' : '' }}>Planifiée</option>
                        <option value="en cours" {{ old('statut', $soutenance->statut) == 'en cours' ? 'selected' : '' }}>En cours</option>
                        <option value="terminée" {{ old('statut', $soutenance->statut) == 'terminée' ? 'selected' : '' }}>Terminée</option>
                        <option value="annulée" {{ old('statut', $soutenance->statut) == 'annulée' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-warning px-5">
                        <i class="bi bi-check-lg"></i> Mettre à jour
                    </button>
                    <a href="{{ route('soutenances.index') }}" class="btn btn-outline-secondary ms-2">
                        Annuler
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection