@extends('layouts.teacher')

@section('title', 'Validation de Fiche PFE')
@section('page-title', 'Évaluation de la Fiche PFE')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('teacher.students.index') }}">Mes Étudiants</a></li>
    <li class="breadcrumb-item active">Évaluation</li>
@endsection

@section('content')
<form action="{{ route('teacher.fiches.update', $data) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Colonne de gauche : Détails du Projet -->
        <div class="col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt mr-2"></i>
                        Détails de la proposition de <strong>{{ $data->etudiant->name ?? 'N/A' }}</strong>
                    </h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Intitulé du PFE</dt>
                        <dd class="col-sm-8">{{ $data->intitule_pfe }}</dd>

                        <dt class="col-sm-4">Société d'accueil</dt>
                        <dd class="col-sm-8">{{ $data->societe_acceuil }}</dd>

                        <dt class="col-sm-4">Encadrant externe</dt>
                        <dd class="col-sm-8">{{ $data->encadrant_externe }}</dd>
                        
                        <dt class="col-sm-4">Contact Société</dt>
                        <dd class="col-sm-8">{{ $data->mail_societe }} / {{ $data->ntel_societe }}</dd>
                        
                        <dt class="col-sm-4">Langue</dt>
                        <dd class="col-sm-8">{{ $data->langue }}</dd>
                    </dl>
                    
                    <hr>
                    
                    <strong>Besoins fonctionnels :</strong>
                    <p class="text-muted">{{ $data->besions_fonctionnels }}</p>
                    
                    <strong>Technologies utilisées :</strong>
                    <p class="text-muted">{{ $data->technologies_utilisees }}</p>
                </div>
            </div>
        </div>

        <!-- Colonne de droite : Zone de Validation -->
        <div class="col-md-4">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-gavel mr-2"></i>
                        Votre Décision
                    </h3>
                </div>
                <div class="card-body">
                    @if (strtolower($data->Remarque) === 'en attente')
                        {{-- Si la fiche est EN ATTENTE, on affiche le formulaire de décision --}}
                        <h5 class="form-section-title text-center text-info">Zone de Validation de l'Encadrant</h5>
                        <p class="text-center text-muted mb-3">Veuillez évaluer et valider ou refuser cette proposition de PFE.</p>
                        
                        <div class="rad">
                            <strong>Décision :</strong>
                            <input name="Remarque" type="radio" value="accepte" id="radio-accepte" required/>
                            <label for="radio-accepte">Accepter</label>
                            
                            <input name="Remarque" type="radio" value="refuse" id="radio-refuse" />
                            <label for="radio-refuse">Refuser</label>
                        </div>
                        @error('Remarque') <div class="text-center text-danger mb-3">{{ $message }}</div> @enderror

                        <button type="submit">
                            <i class="fas fa-check-double mr-2"></i>Soumettre la décision
                        </button>
                    @else
                        {{-- Si la fiche est ACCEPTÉE ou REFUSÉE, on affiche un message de statut --}}
                        @php
                            $isAccepted = strtolower($data->Remarque) === 'accepte';
                            $alertClass = $isAccepted ? 'success' : 'danger';
                            $iconClass = $isAccepted ? 'fas fa-check-circle' : 'fas fa-times-circle';
                            $title = $isAccepted ? 'Proposition Acceptée' : 'Proposition Refusée';
                        @endphp
                        <div class="alert alert-{{ $alertClass }} text-center">
                            <h4><i class="{{ $iconClass }}"></i> {{ $title }}</h4>
                            <p>Une décision a déjà été prise pour cette fiche le {{ $data->updated_at->format('d/m/Y') }}. Aucune autre action n'est requise.</p>
                        </div>
                        
                    @endif
                    @error('Remarque') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                </div>
                
            </div>
        </div>
    </div>
</form>
@endsection