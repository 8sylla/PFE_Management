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
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-project-diagram mr-2"></i>Ma Progression PFE</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <!-- Étape 1 : Inscription (Toujours terminée) -->
                    <div>
                        <i class="fas fa-user-check bg-purple"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-check"></i> Terminé</span>
                            <h3 class="timeline-header text-purple font-weight-bold">Inscription à la Plateforme</h3>
                            <div class="timeline-body">
                                Bienvenue ! Votre parcours pour le PFE commence ici.
                            </div>
                        </div>
                    </div>

                    <!-- Étape 2 : Soumission de la Fiche PFE -->
                    <div>
                        @if($fiche)
                            {{-- L'étudiant a soumis une fiche --}}
                            @php
                                $remarque = strtolower($fiche->Remarque);
                                if ($remarque == 'accepte') {
                                    $iconClass = 'fas fa-check-circle bg-success';
                                    $headerClass = 'text-success';
                                    $statusText = 'Fiche Acceptée';
                                } elseif ($remarque == 'refuse') {
                                    $iconClass = 'fas fa-times-circle bg-danger';
                                    $headerClass = 'text-danger';
                                    $statusText = 'Fiche Refusée';
                                } else {
                                    $iconClass = 'fas fa-hourglass-half bg-warning';
                                    $headerClass = 'text-warning';
                                    $statusText = 'Fiche en Attente';
                                }
                            @endphp
                            <i class="{{ $iconClass }}"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> Soumis le {{ $fiche->created_at->format('d/m/Y') }}</span>
                                <h3 class="timeline-header {{ $headerClass }} font-weight-bold">Proposition de la Fiche PFE</h3>
                                <div class="timeline-body">
                                    Votre proposition de projet est actuellement : <strong>{{ $statusText }}</strong>.
                                </div>
                                <div class="timeline-footer">
                                    <a href="{{ route('fiche.show') }}" class="btn btn-primary btn-sm">Voir les détails</a>
                                </div>
                            </div>
                        @else
                            {{-- L'étudiant n'a pas encore soumis de fiche --}}
                            <i class="fas fa-file-alt bg-gray"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header font-weight-bold text-danger">Action Requise : Proposition de la Fiche PFE</h3>
                                <div class="timeline-body">
                                    La soumission de votre fiche est la prochaine étape cruciale. Veuillez la remplir dès que possible.
                                </div>
                                <div class="timeline-footer">
                                    <a href="{{ route('fiche.create') }}" class="btn btn-success btn-sm">Remplir ma fiche</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Étape 3 : Dépôt des Documents -->
                    <div>
                        <i class="fas fa-folder-open bg-gray"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header font-weight-bold">Dépôt des Documents</h3>
                            <div class="timeline-body">
                                Vous pourrez déposer ici les différentes versions de votre rapport et de votre présentation tout au long du projet.
                            </div>
                            <div class="timeline-footer">
                                <a href="{{ route('documents.index') }}" class="btn btn-primary btn-sm">Gérer mes documents</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Étape 4 : Planification de la Soutenance -->
                    <div>
                        @if ($soutenance)
                            <i class="fas fa-calendar-check bg-success"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header font-weight-bold text-success">Soutenance Planifiée</h3>
                                <div class="timeline-body">
                                    Votre soutenance est prévue pour le <strong>{{ \Carbon\Carbon::parse($soutenance->date)->format('d F Y à H:i') }}</strong>.
                                </div>
                                <div class="timeline-footer">
                                    <a href="{{ route('soutenance.student.show') }}" class="btn btn-primary btn-sm">Voir les détails</a>
                                </div>
                            </div>
                        @else
                            <i class="fas fa-calendar-alt bg-gray"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header font-weight-bold">Planification de la Soutenance</h3>
                                <div class="timeline-body">
                                    L'administration planifiera votre soutenance une fois votre projet suffisamment avancé et votre fiche validée.
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Fin de la Timeline -->
                    <div>
                        @if($isCompleted)
                            {{-- Si le processus est terminé (note attribuée) --}}
                            <i class="fas fa-trophy bg-success"></i>
                             <div class="timeline-item">
                                <h3 class="timeline-header font-weight-bold text-success">Projet Terminé et Validé</h3>
                                <div class="timeline-body">
                                    Félicitations pour avoir mené votre projet à son terme ! Votre note finale est enregistrée.
                                </div>
                            </div>
                        @else
                             {{-- Si le processus n'est pas encore terminé --}}
                            <i class="fas fa-trophy bg-gray"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Colonne Latérale: Infos & Aide -->
    <div class="lg:col-span-1 space-y-8">
        
        {{-- NOUVELLE CARTE DE L'ENCADRANT --}}
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    {{-- Photo de l'enseignant --}}
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ asset('dist/img/user2-160x160.jpg') }}" {{-- Mettre une image par défaut pour l'enseignant --}}
                         alt="Photo de l'encadrant">
                </div>

                <h3 class="profile-username text-center">
                    {{ $user->enseignant->name ?? 'Non assigné' }}
                </h3>

                <p class="text-muted text-center">
                    {{ $user->enseignant->specialite ?? 'Encadrant Pédagogique' }}
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> 
                        <a href="mailto:{{ $user->enseignant->email ?? '' }}" class="float-right">
                            {{ $user->enseignant->email ?? 'N/A' }}
                        </a>
                    </li>
                </ul>

                <a href="mailto:{{ $user->enseignant->email ?? '' }}" class="btn btn-primary btn-block">
                    <b><i class="fas fa-envelope mr-2"></i>Contacter par mail</b>
                </a>
            </div>
            <!-- /.card-body -->
        </div>
        {{-- FIN DE LA NOUVELLE CARTE --}}
@endsection