@extends('layouts.student')

@section('title', 'Détails de ma Soutenance')
@section('page-title', 'Ma Soutenance')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Détails</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        @if ($soutenance)
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-calendar-check fa-3x text-primary"></i>
                        <h3 class="mt-3">Votre soutenance est planifiée !</h3>
                        <p class="text-muted">Voici les informations relatives à votre passage.</p>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle mr-2"></i>
                                Informations Clés
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <dl class="row m-0">
                                <dt class="col-sm-4 p-3 bg-light">Date et Heure</dt>
                                <dd class="col-sm-8 p-3 font-weight-bold text-lg text-success">
                                    {{ \Carbon\Carbon::parse($soutenance->date)->format('l d F Y à H:i') }}
                                </dd>

                                <dt class="col-sm-4 p-3">Salle</dt>
                                <dd class="col-sm-8 p-3">{{ $soutenance->sale->numero ?? 'N/A' }}</dd>

                                <dt class="col-sm-4 p-3 bg-light">Encadrant Pédagogique</dt>
                                <dd class="col-sm-8 p-3">{{ $soutenance->enseignant->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-4 p-3">Jury</dt>
                                <dd class="col-sm-8 p-3">{{ $soutenance->jury->name ?? 'N/A' }}</dd>

                                <dt class="col-sm-4 p-3 bg-light">Note Finale</dt>
                                <dd class="col-sm-8 p-3">
                                    @if($soutenance->note)
                                        <span class="badge badge-success" style="font-size: 1rem;">{{ $soutenance->note }} / 20</span>
                                    @else
                                        <span class="badge badge-warning">Non encore attribuée</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-4"></i>
                    <h3>Aucune soutenance n'est encore planifiée pour vous.</h3>
                    <p class="text-muted">Veuillez vérifier ultérieurement ou contacter votre encadrant.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour au Tableau de Bord
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection