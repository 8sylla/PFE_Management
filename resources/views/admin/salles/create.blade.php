@extends('auth.admindashboard')

@section('title', 'Ajouter une Salle')
@section('page-title', 'Nouvelle Salle')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{-- route('salles.index') --}}">Salles</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulaire de création d'une salle</h3>
            </div>
            <form action="{{ route('storesalle') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="name">Numéro ou Nom de la salle</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-door-open"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Amphi A, Salle B-205" required>
                        </div>
                        @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="department">Département de rattachement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" placeholder="Ex: Génie Informatique" required>
                        </div>
                        @error('department')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="card-footer bg-transparent text-right">
                    <a href="{{-- route('salles.index') --}}" class="btn btn-secondary mr-2">Annuler</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Créer la Salle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection