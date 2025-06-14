@extends('auth.admindashboard')

@section('title', 'Détail de l\'Étudiant')
@section('page-title', 'Profil de l\'Étudiant')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Étudiants</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Carte de Profil -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ $user->image ? asset('images_profil/' . $user->image) : asset('dist/img/user2-160x160.jpg') }}"
                         alt="Photo de profil de l'étudiant">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">{{ $user->email }}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Encadrant</b> <a class="float-right">{{ $user->enseignant->name ?? 'Non assigné' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Fiches Soumises</b> <a class="float-right">{{ $user->fiches->count() }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Statut Soutenance</b> <a class="float-right">{{ $user->soutenance ? 'Planifiée' : 'Non planifiée' }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#fiche" data-toggle="tab">Fiche PFE</a></li>
                    <li class="nav-item"><a class="nav-link" href="#soutenance" data-toggle="tab">Soutenance</a></li>
                    <li class="nav-item"><a class="nav-link" href="#documents" data-toggle="tab">Documents</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Onglet Fiche PFE -->
                    <div class="active tab-pane" id="fiche">
                        @if($user->latestFiche)
                            <h4>Dernière Fiche Soumise</h4>
                            <dl class="row">
                                <dt class="col-sm-4">Intitulé</dt><dd class="col-sm-8">{{ $user->latestFiche->intitule_pfe }}</dd>
                                <dt class="col-sm-4">Statut</dt><dd class="col-sm-8"><span class="badge badge-info">{{ $user->latestFiche->Remarque }}</span></dd>
                                <dt class="col-sm-4">Société</dt><dd class="col-sm-8">{{ $user->latestFiche->societe_acceuil }}</dd>
                            </dl>
                        @else
                            <p class="text-muted text-center">Cet étudiant n'a pas encore soumis de fiche PFE.</p>
                        @endif
                    </div>
                    <!-- Onglet Soutenance -->
                    <div class="tab-pane" id="soutenance">
                        @if($user->soutenance)
                            <h4>Détails de la Soutenance</h4>
                             <dl class="row">
                                <dt class="col-sm-4">Date & Heure</dt><dd class="col-sm-8">{{ \Carbon\Carbon::parse($user->soutenance->date)->format('d/m/Y H:i') }}</dd>
                                <dt class="col-sm-4">Salle</dt><dd class="col-sm-8">{{ $user->soutenance->sale->numero ?? 'N/A' }}</dd>
                                <dt class="col-sm-4">Jury</dt><dd class="col-sm-8">{{ $user->soutenance->jury->name ?? 'N/A' }}</dd>
                                <dt class="col-sm-4">Note</dt><dd class="col-sm-8">{{ $user->soutenance->note ? $user->soutenance->note . ' / 20' : 'Non noté' }}</dd>
                            </dl>
                        @else
                            <p class="text-muted text-center">Aucune soutenance n'est planifiée pour cet étudiant.</p>
                            <div class="text-center"><a href="{{ route('admin.soutenances.create', ['etudiant_id' => $user->id]) }}" class="btn btn-sm btn-success">Planifier une soutenance</a></div>
                        @endif
                    </div>
                    <!-- Onglet Documents -->
                    <div class="tab-pane" id="documents">
                        <h4>Documents Soumis</h4>
                        <ul class="list-group">
                        @forelse($user->documents as $document)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $document->description }}
                                <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="btn btn-xs btn-outline-primary"><i class="fas fa-eye"></i> Voir</a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center">Aucun document soumis.</li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection