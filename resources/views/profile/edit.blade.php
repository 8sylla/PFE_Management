{{-- Déterminer le layout à étendre dynamiquement --}}
@php
    $layout = 'layouts.student'; // Layout par défaut
    if (Auth::guard('admin')->check()) {
        $layout = 'auth.admindashboard';
    } elseif (Auth::guard('teacher')->check()) {
        $layout = 'layouts.teacher';
    }
@endphp

@extends($layout)

@section('title', 'Mon Profil')
@section('page-title', 'Paramètres du Profil')
@section('breadcrumbs')<li class="breadcrumb-item active">Profil</li>@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <!-- Carte de l'avatar et informations générales -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile text-center">
                <div class="text-center mb-3">
                    <img class="profile-user-img img-fluid img-circle"
                         src="{{ Auth::user()->image ? asset('images_profil/' . Auth::user()->image) : asset('dist/img/user2-160x160.jpg') }}"
                         alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">
                    @if(Auth::guard('admin')->check()) Administrateur
                    @elseif(Auth::guard('teacher')->check()) Encadrant
                    @else Étudiant @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Informations Personnelles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Changer le Mot de Passe</a></li>
                    @if(!Auth::guard('admin')->check()) {{-- On ne permet pas à l'admin de supprimer son compte --}}
                    <li class="nav-item"><a class="nav-link text-danger" href="#delete" data-toggle="tab">Zone de Danger</a></li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Tab des informations personnelles -->
                    <div class="active tab-pane" id="info">
                        <form class="form-horizontal" method="post" action="{{ route(request()->route()->getName()) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            @if(Auth::guard('teacher')->check())
                            <div class="form-group row">
                                <label for="specialite" class="col-sm-2 col-form-label">Spécialité</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="specialite" name="specialite" value="{{ old('specialite', $user->specialite) }}">
                                </div>
                            </div>
                            @endif
                            <div class="form-group row"><div class="offset-sm-2 col-sm-10"><button type="submit" class="btn btn-success">Enregistrer</button></div></div>
                        </form>
                    </div>
                    <!-- Tab du mot de passe -->
                    <div class="tab-pane" id="password">
                        <form class="form-horizontal" method="post" action="{{ route(str_replace('profile.edit', 'password.update', request()->route()->getName())) }}">
                            @csrf
                            @method('put')
                            <div class="form-group row"><label for="current_password" class="col-sm-3 col-form-label">Mot de passe actuel</label><div class="col-sm-9"><input type="password" class="form-control" id="current_password" name="current_password" required></div></div>
                            <div class="form-group row"><label for="password" class="col-sm-3 col-form-label">Nouveau mot de passe</label><div class="col-sm-9"><input type="password" class="form-control" id="password" name="password" required></div></div>
                            <div class="form-group row"><label for="password_confirmation" class="col-sm-3 col-form-label">Confirmer</label><div class="col-sm-9"><input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required></div></div>
                            <div class="form-group row"><div class="offset-sm-3 col-sm-9"><button type="submit" class="btn btn-primary">Changer le mot de passe</button></div></div>
                        </form>
                    </div>
                    <!-- Tab de suppression -->
                    @if(!Auth::guard('admin')->check())
                    <div class="tab-pane" id="delete">
                        <p class="text-danger">Cette action est irréversible. Toutes vos données seront définitivement supprimées.</p>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-modal">Supprimer mon compte</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
@if(!Auth::guard('admin')->check())
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression du compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer votre compte ? Veuillez entrer votre mot de passe pour confirmer.</p>
                    <div class="form-group">
                        <label for="password_delete">Mot de passe</label>
                        <input id="password_delete" name="password" type="password" class="form-control" placeholder="Mot de passe" required>
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection