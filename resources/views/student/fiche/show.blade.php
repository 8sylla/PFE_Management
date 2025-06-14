@extends('layouts.student')

@section('title', 'Statut de ma Fiche PFE')
@section('page-title', 'Ma Fiche PFE')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Statut</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if (isset($message))
            {{-- Cas où aucune fiche n'a jamais été soumise --}}
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-file-alt fa-4x text-muted mb-4"></i>
                    <h3>Vous n'avez pas encore soumis de fiche PFE.</h3>
                    <p class="text-muted">La soumission de votre fiche est la première étape de votre projet.</p>
                    <a href="{{ route('fiche.create') }}" class="btn btn-lg btn-success mt-3">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Soumettre ma proposition maintenant
                    </a>
                </div>
            </div>
        @elseif ($fiche)
            @php
                $remarque = strtolower($fiche->Remarque);
                $alertClass = 'warning';
                $icon = 'fas fa-clock';
                $statusTitle = 'En Attente';
                $statusText = 'Votre proposition de fiche PFE est actuellement en cours de validation par votre encadrant. Vous serez notifié(e) de sa décision.';

                if ($remarque == 'accepte') {
                    $alertClass = 'success';
                    $icon = 'fas fa-check-circle';
                    $statusTitle = 'Acceptée';
                    $statusText = 'Félicitations ! Votre proposition de PFE a été validée. Vous pouvez maintenant télécharger la version PDF signée.';
                } elseif ($remarque == 'refuse') {
                    $alertClass = 'danger';
                    $icon = 'fas fa-times-circle';
                    $statusTitle = 'Refusée';
                    $statusText = 'Malheureusement, votre proposition a été refusée. Veuillez consulter les remarques de votre encadrant et soumettre une nouvelle proposition.';
                }
            @endphp

            <!-- Boîte d'alerte pour le statut -->
            <div class="alert alert-{{$alertClass}} alert-dismissible">
                <h4 class="alert-heading"><i class="icon fas {{ $icon }}"></i> Statut : {{ $statusTitle }}</h4>
                <p>{{ $statusText }}</p>
            </div>
            
            <!-- Détails de la fiche -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Détails de la fiche soumise le {{ $fiche->created_at->format('d/m/Y') }}
                    </h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Intitulé du PFE</dt>
                        <dd class="col-sm-9">{{ $fiche->intitule_pfe }}</dd>

                        <dt class="col-sm-3">Société d'accueil</dt>
                        <dd class="col-sm-9">{{ $fiche->societe_acceuil }}</dd>

                        <dt class="col-sm-3">Encadrant externe</dt>
                        <dd class="col-sm-9">{{ $fiche->encadrant_externe }}</dd>
                    </dl>
                    <hr>
                    <strong>Description et Technologies</strong>
                    <p class="text-muted">{{ $fiche->besions_fonctionnels }} - <small>Technologies : {{ $fiche->technologies_utilisees }}</small></p>

                    @if($remarque == 'accepte')
                        <div class="mt-4 text-right">
                            <a href="{{ route('fiche.pdf') }}" class="btn btn-primary">
                                <i class="fas fa-download mr-2"></i> Télécharger le PDF officiel
                            </a>
                        </div>
                    @elseif($remarque == 'refuse')
                        <div class="mt-4 text-right">
                             <a href="{{ route('fiche.create') }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i> Soumettre une nouvelle fiche
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection