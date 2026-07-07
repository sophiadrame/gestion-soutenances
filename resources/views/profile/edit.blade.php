@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-circle text-primary"></i> Mon Profil</h2>
</div>

<div class="row g-3">

    {{-- Informations du profil --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title mb-3">Informations du profil</h5>
                <p class="text-muted small">Mettez à jour votre nom et votre adresse email.</p>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nom</label>
                        <input id="name" name="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required autofocus>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input id="email" name="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert alert-warning small">
                            Votre adresse email n'est pas vérifiée.
                            <button form="send-verification" class="btn btn-link p-0 small">
                                Cliquez ici pour renvoyer l'email de vérification.
                            </button>
                        </div>
                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success small">
                                Un nouveau lien de vérification a été envoyé.
                            </div>
                        @endif
                    @endif

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success ms-2">
                            <i class="bi bi-check-circle"></i> Enregistré !
                        </span>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Mise à jour du mot de passe --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title mb-3">Mettre à jour le mot de passe</h5>
                <p class="text-muted small">Utilisez un mot de passe long et aléatoire pour rester en sécurité.</p>

                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-bold">Mot de passe actuel</label>
                        <input id="current_password" name="current_password" type="password"
                               class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" autocomplete="current-password">
                        @error('current_password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Nouveau mot de passe</label>
                        <input id="password" name="password" type="password"
                               class="form-control @error('password', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                        @error('password', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">Confirmer le mot de passe</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" autocomplete="new-password">
                        @error('password_confirmation', 'updatePassword') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Enregistrer
                    </button>

                    @if (session('status') === 'password-updated')
                        <span class="text-success ms-2">
                            <i class="bi bi-check-circle"></i> Enregistré !
                        </span>
                    @endif
                </form>
            </div>
        </div>

        {{-- Suppression du compte --}}
        <div class="card mt-3 border-danger">
            <div class="card-body p-4">
                <h5 class="card-title text-danger mb-3">Supprimer le compte</h5>
                <p class="text-muted small">Une fois supprimé, toutes vos données seront définitivement perdues.</p>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="bi bi-trash"></i> Supprimer mon compte
                </button>

                <div class="modal fade" id="deleteAccountModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('delete')
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmer la suppression</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.</p>
                                    <label class="form-label fw-bold">Mot de passe</label>
                                    <input type="password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror">
                                    @error('password', 'userDeletion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>
@endsection