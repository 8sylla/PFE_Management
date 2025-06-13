@extends('auth.teacherdashboard') {{-- ou le layout que vous utilisez pour les enseignants --}}

@section('title', 'Validation de Fiche PFE')
@section('page-title', 'Fiche PFE de l\'étudiant')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Validation Fiche</li>
@endsection

@push('styles')
{{-- Si votre CSS est dans un fichier séparé, vous pouvez le lier ici. Sinon, le style inline est aussi une option. --}}
<link rel="stylesheet" href="{{ asset('css/Fiche_PFE.css') }}">
@endpush

@section('content')
<div class="card p-0"> {{-- p-0 pour que le titre prenne toute la largeur --}}
    <span class="title">Fiche PFE - {{ $data->etudiant->name ?? 'N/A' }}</span>
    
    <form class="form" name="F" method="POST" action="{{ route('updatefiche', $data->id) }}">
        @csrf
        @method('PUT')

        {{-- Section informations sur l'entreprise --}}
        <h5 class="form-section-title">Informations sur l'entreprise d'accueil</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="group">
                    <input placeholder=" " type="text" name="societe_acceuil" value="{{ old('societe_acceuil', $data->societe_acceuil) }}" readonly>
                    <label for="name">Société d'accueil</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group">
                    <input placeholder=" " type="text" id="enc" name="encadrant_externe" value="{{ old('encadrant_externe', $data->encadrant_externe) }}" readonly>
                    <label for="enc">Encadrant externe</label>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="group">
                    <input placeholder=" " type="text" id="tel" name="ntel_societe" value="{{ old('ntel_societe', $data->ntel_societe) }}" readonly>
                    <label for="tel">Téléphone Société</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="group">
                    <input placeholder=" " type="email" id="email" name="mail_societe" value="{{ old('mail_societe', $data->mail_societe) }}" readonly>
                    <label for="email">Email Société</label>
                </div>
            </div>
        </div>

        {{-- Section détails du PFE --}}
        <h5 class="form-section-title mt-4">Détails du Projet de Fin d'Études</h5>
        <div class="group">
            <input placeholder=" " type="text" id="tit" name="intitule_pfe" value="{{ old('intitule_pfe', $data->intitule_pfe) }}" readonly>
            <label for="tit">Intitulé du PFE</label>
        </div>
         <div class="group">
            <textarea placeholder=" " id="bes" name="besions_fonctionnels" rows="5" readonly>{{ old('besions_fonctionnels', $data->besions_fonctionnels) }}</textarea>
            <label for="bes">Besoins fonctionnels</label>
        </div>
        <div class="group">
            <textarea placeholder=" " id="tech" name="technologies_utilisees" rows="5" readonly>{{ old('technologies_utilisees', $data->technologies_utilisees) }}</textarea>
            <label for="tech">Technologies utilisées</label>
        </div>
        
        {{-- Section de Validation par l'Encadrant --}}
        <hr class="my-4">
        <h5 class="form-section-title text-center text-info">Zone de Validation de l'Encadrant</h5>
        <p class="text-center text-muted mb-3">Veuillez évaluer et valider ou refuser cette proposition de PFE.</p>
        
        <div class="rad">
            Décision :
            <input name="Remarque" type="radio" value="accepte" {{ old('Remarque', $data->Remarque) === 'accepte' ? 'checked' : '' }} required/> Accepter
            <input name="Remarque" type="radio" value="refuse" {{ old('Remarque', $data->Remarque) === 'refuse' ? 'checked' : '' }}/> Refuser
            <input name="Remarque" type="radio" value="en Attente" {{ old('Remarque', $data->Remarque) === 'en Attente' ? 'checked' : '' }}/> Laisser en attente
        </div>

        <button type="submit">
            <i class="fas fa-check-double mr-2"></i>Mettre à jour le statut
        </button>
    </form>
</div>

<style>
    .form-section-title {
        font-weight: 600;
        color: #4a5568;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 20px;
    }
    input[readonly] {
        background-color: #e9ecef !important;
        cursor: not-allowed;
    }
</style>
@endsection