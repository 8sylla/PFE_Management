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
                    <p class="text-muted">Veuillez évaluer cette proposition. Votre décision sera communiquée à l'étudiant.</p>
                    <div class="form-group">
                        <label>Statut de la Fiche</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="radio-accepte" name="Remarque" value="accepte" {{ old('Remarque', $data->Remarque) === 'accepte' ? 'checked' : '' }} required>
                            <label for="radio-accepte" class="custom-control-label">Accepter la proposition</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="radio-refuse" name="Remarque" value="refuse" {{ old('Remarque', $data->Remarque) === 'refuse' ? 'checked' : '' }}>
                            <label for="radio-refuse" class="custom-control-label">Refuser la proposition</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-warning" type="radio" id="radio-attente" name="Remarque" value="en Attente" {{ old('Remarque', $data->Remarque) === 'en Attente' ? 'checked' : '' }}>
                            <label for="radio-attente" class="custom-control-label">Laisser en attente</label>
                        </div>
                    </div>
                    @error('Remarque') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer la décision
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection