@extends('auth.admindashboard')

@section('title', 'Tableau de bord Administrateur')
@section('page-title', 'Vue d\'ensemble')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Tableau de bord</li>
@endsection

@section('content')
<!-- Cartes de Statistiques -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $studentCount }}</h3>
                <p>Étudiants Inscrits</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $teachersCount }}</h3>
                <p>Encadrants Actifs</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="{{ route('admin.enseignants.index') }}" class="small-box-footer">Gérer <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $soutenanceCount }}</h3>
                <p>Soutenances Planifiées</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="{{ route('admin.soutenances.index') }}" class="small-box-footer">Voir le planning <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $fichesEnAttenteCount }}</h3>
                <p>Fiches à Valider</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-signature"></i>
            </div>
            <a href="{{ route('admin.fiches.index') }}" class="small-box-footer">Traiter les fiches <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Section Actions Rapides & Dernières Activités -->
<div class="row">
    <!-- Actions Rapides -->
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-rocket mr-2"></i>Actions Rapides</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.enseignants.create') }}" class="btn btn-app bg-success">
                    <i class="fas fa-user-plus"></i>Ajouter Encadrant
                </a>
                <a href="{{ route('admin.soutenances.create') }}" class="btn btn-app bg-warning">
                    <i class="fas fa-calendar-plus"></i>Planifier Soutenance
                </a>
                <a href="{{ route('admin.jurys.create') }}" class="btn btn-app bg-info">
                    <i class="fas fa-users-cog"></i>Créer Jury
                </a>
                <a href="{{ route('admin.salles.create') }}" class="btn btn-app bg-secondary">
                    <i class="fas fa-door-open"></i>Ajouter Salle
                </a>
            </div>
        </div>
    </div>

    <!-- Dernières Inscriptions -->
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history mr-2"></i>Derniers Étudiants Inscrits</h3>
            </div>
            <div class="card-body p-0">
                @if($recentStudents->isNotEmpty())
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($recentStudents as $student)
                        <li class="item">
                            <div class="product-img">
                                <img src="{{ $student->image ? asset('images_profil/' . $student->image) : asset('dist/img/user2-160x160.jpg') }}" alt="Image de profil" class="img-size-50 rounded-circle">
                            </div>
                            <div class="product-info">
                                <a href="{{ route('admin.users.show', $student) }}" class="product-title">{{ $student->name }}</a>
                                <span class="product-description">
                                    {{ $student->email }} - Inscrit le {{ $student->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center text-muted p-4">Aucun étudiant n'est encore inscrit.</p>
                @endif
            </div>
            <div class="card-footer text-center">
                 <a href="{{ route('admin.users.index') }}">Voir tous les étudiants</a>
            </div>
        </div>
    </div>
</div>
@endsection