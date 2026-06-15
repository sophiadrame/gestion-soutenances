@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-plus text-primary"></i> Ajouter un membre du jury</h2>
    <a href="{{ route('juries.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour
    </a>
</div>

<div class="card">
    <div class="card-body p-4">
        <form action="{{ route('juries.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Soutenance concernée</label>
                    <select name="soutenance_id" class="form-select @error('soutenance_id') is-invalid @enderror">
                        <option value="">-- Choisir une soutenance --</option>
                        @foreach($soutenances as $s)
                            <option value="{{ $s->id }}" {{ old('soutenance_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->etudiant_prenom }} {{ $s->etudiant_nom }} — {{ $s->titre_memoire }} ({{ \Carbon\Carbon::parse($s->date_soutenance)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('soutenance_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}" placeholder="Ex: THIOYE">
                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Prénom</label>
                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ old('prenom') }}" placeholder="Ex: Mactar">
                    @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Grade / Titre</label>
                    <input type="text" name="grade" class="form-control @error('grade') is-invalid @enderror"
                           value="{{ old('grade') }}" placeholder="Ex: Développeur Senior, Dr, Prof">
                    @error('grade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Rôle dans le jury</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror">
                        <option value="">-- Choisir un rôle --</option>
                        <option value="président" {{ old('role') == 'président' ? 'selected' : '' }}>Président</option>
                        <option value="rapporteur" {{ old('role') == 'rapporteur' ? 'selected' : '' }}>Rapporteur</option>
                        <option value="examinateur" {{ old('role') == 'examinateur' ? 'selected' : '' }}>Examinateur</option>
                    </select>
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Email <span class="text-muted">(optionnel)</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}" placeholder="Ex: mactar@isi.sn">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Téléphone <span class="text-muted">(optionnel)</span></label>
                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                           value="{{ old('telephone') }}" placeholder="Ex: 77 000 00 00">
                    @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection