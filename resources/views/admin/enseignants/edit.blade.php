@extends('auth.admindashboard')

@section('title', 'Modifier un Encadrant')
@section('page-title', 'Modification de l\'Encadrant')

@section('breadcrumbs')
    {{-- LIEN CORRIGÉ DANS LE FIL D'ARIANE --}}
    <li class="breadcrumb-item"><a href="{{ route('admin.enseignants.index') }}">Encadrants</a></li>
    <li class="breadcrumb-item active">Modifier : {{ $data->name }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Mise à jour des informations de : <strong>{{ $data->name }}</strong></h3>
            </div>
            
            {{-- ACTION DU FORMULAIRE CORRIGÉE --}}
            <form action="{{ route('admin.enseignants.update', $data) }}" method="POST">
                @csrf
                @method('PUT') {{-- La méthode PUT est standard pour la mise à jour complète d'une ressource --}}
                
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">Nom complet</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $data->name) }}" required>
                        </div>
                        @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email institutionnel</label>
                        <div class="input-group">
                             <span class="input-group-text"><i class="fas fa-at"></i></span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $data->email) }}" required>
                        </div>
                         @error('email')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="specialite">Spécialité</label>
                         <div class="input-group">
                             <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                            <input type="text" class="form-control @error('specialite') is-invalid @enderror" id="specialite" name="specialite" value="{{ old('specialite', $data->specialite) }}">
                        </div>
                         @error('specialite')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>

                    <hr>
                    <p class="text-muted">Laissez les champs de mot de passe vides si vous ne souhaitez pas le modifier.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="password">Nouveau mot de passe (optionnel)</label>
                                <div class="input-group">
                                     <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                </div>
                                @error('password')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group mb-4">
                                <label for="password_confirmation">Confirmer le mot de passe</label>
                                <div class="input-group">
                                     <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent text-right">
                    {{-- LIEN D'ANNULATION CORRIGÉ --}}
                    <a href="{{ route('admin.enseignants.index') }}" class="btn btn-secondary mr-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection