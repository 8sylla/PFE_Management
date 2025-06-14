@extends('auth.admindashboard')

@section('title', 'Ajouter une Salle')
@section('page-title', 'Nouvelle Salle')

@section('breadcrumbs')
    {{-- LIEN CORRIGÉ DANS LE FIL D'ARIANE --}}
    <li class="breadcrumb-item"><a href="{{ route('admin.salles.index') }}">Salles</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulaire de création d'une salle</h3>
            </div>
            
            {{-- ACTION DU FORMULAIRE CORRIGÉE --}}
            <form action="{{ route('admin.salles.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="numero">Numéro ou Nom de la salle</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                            {{-- Le nom du champ a été corrigé de 'name' à 'numero' pour correspondre à la BDD et au contrôleur --}}
                            <input type="text" class="form-control @error('numero') is-invalid @enderror" id="numero" name="numero" value="{{ old('numero') }}" placeholder="Ex: Amphi A, Salle B-205" required>
                        </div>
                        @error('numero')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="depatement">Département de rattachement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                             {{-- Le nom du champ a été corrigé de 'department' à 'depatement' --}}
                            <input type="text" class="form-control @error('depatement') is-invalid @enderror" id="depatement" name="depatement" value="{{ old('depatement') }}" placeholder="Ex: Génie Informatique" required>
                        </div>
                        @error('depatement')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="card-footer bg-transparent text-right">
                    {{-- LIEN D'ANNULATION CORRIGÉ --}}
                    <a href="{{ route('admin.salles.index') }}" class="btn btn-secondary mr-2">Annuler</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Créer la Salle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection