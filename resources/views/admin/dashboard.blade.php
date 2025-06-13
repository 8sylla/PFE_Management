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
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $studentCount }}</h3>
                <p>Étudiants Inscrits</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $teachersCount }}</h3>
                <p>Encadrants Actifs</p>
            </div>
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
            <a href="{{ route('admin.ens') }}" class="small-box-footer">Gérer <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $soutenanceCount }}</h3>
                <p>Soutenances Planifiées</p>
            </div>
            <div class="icon"><i class="fas fa-calendar-alt"></i></div>
            <a href="{{ route('showsoutenance') }}" class="small-box-footer">Voir le planning <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{-- Compter les fiches en attente --}} Fiches PFE</h3>
                <p>En attente de validation</p>
            </div>
            <div class="icon"><i class="fas fa-file-signature"></i></div>
            <a href="#" class="small-box-footer">Valider les fiches <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<!-- Section Actions Rapides & Dernières Activités -->
<div class="row">
    <!-- Actions Rapides -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-rocket mr-2"></i>Actions Rapides</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.formaddenseignant') }}" class="btn btn-app bg-primary"><i class="fas fa-user-plus"></i>Ajouter Encadrant</a>
                <a href="{{ route('addsoutenance') }}" class="btn btn-app bg-warning"><i class="fas fa-calendar-plus"></i>Planifier Soutenance</a>
                <a href="{{ route('addjury') }}" class="btn btn-app bg-info"><i class="fas fa-users-cog"></i>Créer Jury</a>
                <a href="{{ route('addsalle') }}" class="btn btn-app bg-secondary"><i class="fas fa-door-open"></i>Ajouter Salle</a>
            </div>
        </div>
    </div>

    <!-- Dernières Inscriptions (Exemple) -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history mr-2"></i>Derniers Étudiants Inscrits</h3>
            </div>
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    {{-- @foreach($recentStudents as $student)
                    <li class="item">
                        <div class="product-img"><img src="{{ asset('images_profil/default.png') }}" alt="Image" class="img-size-50"></div>
                        <div class="product-info">
                            <a href="#" class="product-title">{{ $student->name }}</a>
                            <span class="product-description">{{ $student->email }} - Inscrit le {{ $student->created_at->format('d/m/Y') }}</span>
                        </div>
                    </li>
                    @endforeach --}}
                </ul>
            </div>
             <div class="card-footer text-center"><a href="#">Voir tous les étudiants</a></div>
        </div>
    </div>
</div>
@endsection