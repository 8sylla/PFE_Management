@extends('layouts.teacher')
{{-- ... sections title, page-title, breadcrumbs ... --}}
@section('content')
<!-- Cartes de Statistiques -->
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $studentCount }}</h3>
                <p>Étudiants Encadrés</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
            <a href="{{ route('teacher.students.index') }}" class="small-box-footer">
                Voir la liste <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-warning text-white">
            <div class="inner">
                <h3>{{ $fichesEnAttenteCount }}</h3>
                <p>Fiches à Valider</p>
            </div>
            <div class="icon"><i class="fas fa-file-signature"></i></div>
            
            <a href="{{ route('teacher.students.index') }}" class="small-box-footer">
                Traiter les fiches <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $soutenanceCount }}</h3>
                <p>Soutenances Planifiées</p>
            </div>
            <div class="icon"><i class="fas fa-calendar-check"></i></div>
            
            <a href="{{ route('teacher.soutenances.index') }}" class="small-box-footer">
                Voir le planning <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Section des fiches en attente -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title font-weight-bold"><i class="fas fa-exclamation-circle text-warning mr-2"></i>Fiches PFE en attente de votre validation</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Intitulé du PFE</th>
                            <th>Société d'accueil</th>
                            <th>Date de soumission</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fichesEnAttente as $fiche)
                            <tr>
                                <td>{{ $fiche->etudiant->name }}</td>
                                <td>{{ Str::limit($fiche->intitule_pfe, 50) }}</td>
                                <td>{{ $fiche->societe_acceuil }}</td>
                                <td>{{ $fiche->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{route('teacher.fiches.edit', $fiche)}}" class="btn btn-sm btn-primary">
                                        Évaluer
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-check-double text-success fa-2x mb-2"></i><br>
                                    Excellent travail ! Aucune fiche n'est en attente.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection