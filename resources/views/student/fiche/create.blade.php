@extends('layouts.student') {{-- On change 'layouts.app' --}}

@section('title', 'Soumettre ma Fiche PFE')
@section('page-title', 'Formulaire de Proposition de PFE')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('fiche.show') }}">Ma Fiche</a></li>
    <li class="breadcrumb-item active">Soumettre</li>
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header"><h3 class="card-title">Veuillez remplir toutes les informations</h3></div>
    <form method="POST" action="{{ route('fiche.store') }}">
        @csrf
        <div class="card-body">
            {{-- Ici, on utilise les classes de formulaires Bootstrap/AdminLTE --}}
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="societe_acceuil">Société d'accueil</label>
                    <input type="text" id="societe_acceuil" name="societe_acceuil" class="form-control" value="{{ old('societe_acceuil') }}" required>
                </div>
                <div class="col-md-6 form-group">
                    <label for="encadrant_externe">Encadrant externe</label>
                    <input type="text" id="encadrant_externe" name="encadrant_externe" class="form-control" value="{{ old('encadrant_externe') }}" required>
                </div>
                {{-- ... Répétez pour les autres champs (téléphone, email) ... --}}
            </div>
            <div class="form-group">
                <label for="intitule_pfe">Intitulé du PFE</label>
                <input type="text" id="intitule_pfe" name="intitule_pfe" class="form-control" value="{{ old('intitule_pfe') }}" required>
            </div>
             <div class="form-group">
                <label for="besions_fonctionnels">Besoins fonctionnels</label>
                <textarea id="besions_fonctionnels" name="besions_fonctionnels" class="form-control" rows="4">{{ old('besions_fonctionnels') }}</textarea>
            </div>
            {{-- ... etc. pour tous les champs ... --}}
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane mr-2"></i>Soumettre la fiche
            </button>
        </div>
    </form>
</div>
@endsection