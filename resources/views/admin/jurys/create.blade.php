@extends('auth.admindashboard')

@section('title', 'Ajouter un Jury')
@section('page-title', 'Nouveau Jury')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('jury') }}">Jurys</a></li>
    <li class="breadcrumb-item active">Ajouter</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Formulaire de création d'un jury</h3>
            </div>
            <form action="{{ route('storejury') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nom du Jury</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-users"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Jury PFE-GI-2024-01" required>
                        </div>
                        @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                        <small class="form-text text-muted">Utilisez une nomenclature claire pour identifier facilement le jury.</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent text-right">
                    <a href="{{ route('jury') }}" class="btn btn-secondary mr-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-2"></i>Créer le Jury
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection