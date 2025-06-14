@extends('layouts.student')

@section('title', 'Tableau de Bord Étudiant')
@section('page-title', 'Mon Tableau de Bord')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Vue d'ensemble</li>
@endsection

@section('content')
<!-- Cartes d'actions rapides -->
<div class="row">
    <div class="col-lg-6">
        <!-- Carte pour la Fiche PFE -->
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="fiche-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="fiche-statut-tab" data-toggle="pill" href="#fiche-statut" role="tab" aria-controls="fiche-statut" aria-selected="true">
                            <i class="fas fa-file-signature mr-2"></i>Statut de ma Fiche PFE
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="fiche-tabs-content">
                    <div class="tab-pane fade show active" id="fiche-statut" role="tabpanel" aria-labelledby="fiche-statut-tab">
                        @if ($fiche)
                            @php
                                $remarque = strtolower($fiche->Remarque);
                                $statusClass = 'warning';
                                $statusIcon = 'fas fa-clock';
                                if ($remarque == 'accepte') { $statusClass = 'success'; $statusIcon = 'fas fa-check-circle'; }
                                elseif ($remarque == 'refuse') { $statusClass = 'danger'; $statusIcon = 'fas fa-times-circle'; }
                            @endphp
                            <div class="alert alert-{{$statusClass}}">
                                <h5><i class="{{$statusIcon}}"></i> Statut : {{ ucfirst($remarque) }}</h5>
                                Votre proposition pour le projet "{{ Str::limit($fiche->intitule_pfe, 40) }}" est en cours d'évaluation.
                            </div>
                            <a href="{{ route('fiche.show') }}" class="btn btn-primary btn-block"><b>Voir les détails de ma fiche</b></a>
                        @else
                             <div class="alert alert-info">
                                <h5><i class="fas fa-info-circle"></i> Action Requise</h5>
                                Vous n'avez pas encore soumis de proposition de PFE.
                            </div>
                            <a href="{{ route('fiche.create') }}" class="btn btn-success btn-block"><b><i class="fas fa-plus-circle"></i> Soumettre ma fiche maintenant</b></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <!-- Carte pour la Soutenance -->
         <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="soutenance-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="soutenance-planning-tab" data-toggle="pill" href="#soutenance-planning" role="tab" aria-controls="soutenance-planning" aria-selected="true">
                           <i class="fas fa-calendar-check mr-2"></i>Planning de ma Soutenance
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                 <div class="tab-content" id="soutenance-tabs-content">
                    <div class="tab-pane fade show active" id="soutenance-planning" role="tabpanel" aria-labelledby="soutenance-planning-tab">
                        @if ($soutenance)
                            <div class="info-box bg-gradient-success">
                                <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Votre soutenance est planifiée</span>
                                    <span class="info-box-number">{{ \Carbon\Carbon::parse($soutenance->date)->format('d F Y à H:i') }}</span>
                                </div>
                            </div>
                             <a href="{{ route('soutenance.student.show') }}" class="btn btn-primary btn-block"><b>Consulter les détails</b></a>
                        @else
                            <div class="alert alert-secondary">
                                <h5><i class="fas fa-hourglass-half"></i> En attente</h5>
                                Votre soutenance n'a pas encore été planifiée par l'administration.
                            </div>
                            <button class="btn btn-secondary btn-block" disabled><b>Aucune information disponible</b></button>
                        @endif
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>

<!-- Timeline de progression du projet -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-project-diagram mr-2"></i>Ma Progression PFE</h3>
            </div>
            <div class="card-body">
                {{-- Ici, on insère la timeline que nous avions créée précédemment --}}
                <ol class="relative border-l border-gray-200" style="list-style: none; padding-left: 0;">                  
                    {{-- ... Code complet de la timeline ... --}}
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection