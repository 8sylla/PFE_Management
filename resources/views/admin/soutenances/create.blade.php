@extends('auth.admindashboard')

@section('title', 'Planifier une Soutenance')
@section('page-title', 'Nouvelle Soutenance')

@section('breadcrumbs')
    {{-- LIEN CORRIGÉ DANS LE FIL D'ARIANE --}}
    <li class="breadcrumb-item"><a href="{{ route('admin.soutenances.index') }}">Soutenances</a></li>
    <li class="breadcrumb-item active">Planifier</li>
@endsection

@section('content')
<!-- Etape 1: Sélection de l'étudiant -->
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user-graduate mr-2"></i>
            Étape 1 : Choisir un étudiant
        </h3>
    </div>
    <div class="card-body">
        {{-- ACTION DU FORMULAIRE CORRIGÉE --}}
        <form method="GET" action="{{ route('admin.soutenances.create') }}">
            <div class="form-group">
                <label>Sélectionner un étudiant n'ayant pas encore de soutenance :</label>
                <select name="etudiant_id" class="form-control select2" style="width: 100%;" onchange="this.form.submit()">
                    <option value="">-- Choisir un étudiant --</option>
                    @foreach($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}" {{ request('etudiant_id') == $etudiant->id ? 'selected' : '' }}>
                            {{ $etudiant->name }} ({{ $etudiant->email }})
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

<!-- Etape 2: Remplir les détails de la soutenance (s'affiche si un étudiant est sélectionné) -->
@if(request('etudiant_id') && $selectedStudent)
<div class="card card-outline card-success" style="animation: fadeIn 0.5s;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-calendar-alt mr-2"></i>
            Étape 2 : Planifier la soutenance pour <span class="font-weight-bold">{{ $selectedStudent->name }}</span>
        </h3>
    </div>
    {{-- ACTION DU FORMULAIRE CORRIGÉE --}}
    <form method="POST" action="{{ route('admin.soutenances.store') }}">
        @csrf
        <input type="hidden" name="etudiant_id" value="{{ $selectedStudent->id }}">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="enseignant_id">Encadrant Pédagogique (automatique)</label>
                        <input type="text" class="form-control" value="{{ $encadrent->name ?? 'Non défini' }}" readonly>
                        {{-- On ne soumet pas l'id de l'enseignant, il sera récupéré dans le contrôleur --}}
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label for="date">Date et Heure de la soutenance</label>
                        <input type="datetime-local" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                         @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>Jury</label>
                        <select name="jury_id" class="form-control select2 @error('jury_id') is-invalid @enderror" style="width: 100%;" required>
                            <option value="">-- Sélectionner un jury --</option>
                            @foreach($jurys as $jury)
                                <option value="{{ $jury->id }}" {{ old('jury_id') == $jury->id ? 'selected' : '' }}>{{ $jury->name }}</option>
                            @endforeach
                        </select>
                         @error('jury_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>Salle</label>
                        <select name="salle_id" class="form-control select2 @error('salle_id') is-invalid @enderror" style="width: 100%;" required>
                            <option value="">-- Sélectionner une salle --</option>
                            @foreach($salles as $salle)
                                <option value="{{ $salle->id }}" {{ old('salle_id') == $salle->id ? 'selected' : '' }}>{{ $salle->numero }} ({{ $salle->depatement }})</option>
                            @endforeach
                        </select>
                         @error('salle_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
             {{-- LIEN D'ANNULATION CORRIGÉ --}}
             <a href="{{ route('admin.soutenances.create') }}" class="btn btn-secondary">Annuler la sélection</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle mr-2"></i>Valider la Planification</button>
        </div>
    </form>
</div>
@endif

<style> @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } } </style>
@endsection