@extends('auth.admindashboard')

@section('title', 'Ajouter un Encadrant')

@section('page-title', 'Nouvel Encadrant')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.ens') }}">Encadrants</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulaire de création d'un encadrant</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.createens') }}" method="POST" novalidate>
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nom complet</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Dr. Nadia El Fassi" required>
                        </div>
                        @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email institutionnel</label>
                        <div class="input-group">
                             <span class="input-group-text"><i class="fas fa-at"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Ex: nom.prenom@uae.ac.ma" required>
                        </div>
                         @error('email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="specialite">Spécialité</label>
                         <div class="input-group">
                             <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="text" class="form-control @error('specialite') is-invalid @enderror" id="specialite" name="specialite" value="{{ old('specialite') }}" placeholder="Ex: Génie Informatique (IA & Data Science)">
                        </div>
                         @error('specialite')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password">Mot de passe provisoire</label>
                        <div class="input-group">
                             <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        </div>
                        <small class="form-text text-muted">L'enseignant pourra changer ce mot de passe plus tard.</small>
                        @error('password')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="card-footer bg-transparent text-right">
                        <a href="{{ route('admin.ens') }}" class="btn btn-secondary mr-2">Annuler</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle mr-2"></i>Créer l'Encadrant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection