@extends('layouts.student')

@section('title', 'Soumettre ma Fiche PFE')
@section('page-title', 'Formulaire de Proposition de PFE')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('fiche.show') }}">Ma Fiche</a></li>
    <li class="breadcrumb-item active">Soumettre</li>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Veuillez remplir toutes les informations avec précision</h3>
    </div>
    <form method="POST" action="{{ route('fiche.store') }}">
        @csrf
        <div class="card-body">
            {{-- Utilisation d'une grille pour organiser les champs --}}
            <div class="row">
                {{-- COLONNE DE GAUCHE --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="societe_acceuil">Société d'accueil</label>
                        <input type="text" id="societe_acceuil" name="societe_acceuil" class="form-control @error('societe_acceuil') is-invalid @enderror" value="{{ old('societe_acceuil') }}" required>
                        @error('societe_acceuil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="encadrant_externe">Encadrant externe</label>
                        <input type="text" id="encadrant_externe" name="encadrant_externe" class="form-control @error('encadrant_externe') is-invalid @enderror" value="{{ old('encadrant_externe') }}" required>
                        @error('encadrant_externe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- COLONNE DE GAUCHE --}}
                <div class="col-md-6">
                    <div class="form-group">
                        {{-- CHAMP MANQUANT --}}
                        <label for="ntel_societe">Téléphone de la Société</label>
                        <input type="text" id="ntel_societe" name="ntel_societe" class="form-control @error('ntel_societe') is-invalid @enderror" value="{{ old('ntel_societe') }}" required>
                        @error('ntel_societe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                {{-- COLONNE DE DROITE --}}
                <div class="col-md-6">
                    <div class="form-group">
                         {{-- CHAMP MANQUANT --}}
                        <label for="mail_societe">Email de la Société</label>
                        <input type="email" id="mail_societe" name="mail_societe" class="form-control @error('mail_societe') is-invalid @enderror" value="{{ old('mail_societe') }}" required>
                        @error('mail_societe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            
            <hr>

            <div class="form-group">
                <label for="intitule_pfe">Intitulé du PFE</label>
                <input type="text" id="intitule_pfe" name="intitule_pfe" class="form-control @error('intitule_pfe') is-invalid @enderror" value="{{ old('intitule_pfe') }}" required>
                @error('intitule_pfe') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

             <div class="form-group">
                <label for="besions_fonctionnels">Besoins fonctionnels</label>
                <textarea id="besions_fonctionnels" name="besions_fonctionnels" class="form-control @error('besions_fonctionnels') is-invalid @enderror" rows="4">{{ old('besions_fonctionnels') }}</textarea>
                @error('besions_fonctionnels') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
             <div class="form-group">
                 {{-- CHAMP MANQUANT --}}
                <label for="technologies_utilisees">Technologies principales à utiliser</label>
                <textarea id="technologies_utilisees" name="technologies_utilisees" class="form-control @error('technologies_utilisees') is-invalid @enderror" rows="4">{{ old('technologies_utilisees') }}</textarea>
                @error('technologies_utilisees') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                {{-- CHAMP MANQUANT --}}
                <label>Langue de rédaction du rapport</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="langue_fr" name="langue" value="Francais" {{ old('langue', 'Francais') == 'Francais' ? 'checked' : '' }}>
                    <label for="langue_fr" class="custom-control-label">Français</label>
                </div>
                 <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="langue_en" name="langue" value="Anglais" {{ old('langue') == 'Anglais' ? 'checked' : '' }}>
                    <label for="langue_en" class="custom-control-label">Anglais</label>
                </div>
                @error('langue') <div class="text-danger mt-2 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('fiche.show') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary ml-2">
                <i class="fas fa-paper-plane mr-2"></i>Soumettre la fiche
            </button>
        </div>
    </form>
</div>
@endsection