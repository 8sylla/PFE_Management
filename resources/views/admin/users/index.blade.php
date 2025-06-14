@extends('auth.admindashboard')
@section('title', 'Liste des Étudiants')
@section('page-title', 'Gestion des Étudiants')
@section('breadcrumbs')<li class="breadcrumb-item active">Étudiants</li>@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Tous les étudiants inscrits</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Encadrant Assigné</th>
                    <th class="text-center">Statut Fiche</th>
                    <th style="width: 10%;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->enseignant->name ?? 'Non assigné' }}</td>
                        <td class="text-center">
                            @if($user->latestFiche)
                                <span class="badge badge-{{ $user->latestFiche->Remarque == 'accepte' ? 'success' : ($user->latestFiche->Remarque == 'refuse' ? 'danger' : 'warning') }}">{{ $user->latestFiche->Remarque }}</span>
                            @else
                                <span class="badge badge-secondary">Aucune</span>
                            @endif
                        </td>
                        <td class="text-right"><a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-primary">Détails</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center p-4">Aucun étudiant trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())<div class="card-footer">{{ $users->links() }}</div>@endif
</div>
@endsection