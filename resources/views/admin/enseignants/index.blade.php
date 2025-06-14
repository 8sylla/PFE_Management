@extends('auth.admindashboard')

@section('title', 'Gestion des Encadrants')
@section('page-title', 'Liste des Encadrants')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Encadrants</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Tous les encadrants enregistrés</h3>
        
        {{-- LIGNE CORRIGÉE --}}
        <a href="{{ route('admin.enseignants.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Ajouter un encadrant
        </a>
    </div>
    <div class="card-body p-0"> {{-- p-0 pour que la table prenne toute la largeur --}}
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Spécialité</th>
                    <th style="width: 15%;" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $enseignant)
                    <tr>
                        <td>{{ $enseignant->id }}</td>
                        <td>{{ $enseignant->name }}</td>
                        <td><a href="mailto:{{ $enseignant->email }}">{{ $enseignant->email }}</a></td>
                        <td>{{ $enseignant->specialite ?? 'Non spécifiée' }}</td>
                        <td class="text-center">
                            {{-- LIEN DE MODIFICATION CORRIGÉ --}}
                            <a href="{{ route('admin.enseignants.edit', $enseignant) }}" class="btn btn-sm btn-info" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            {{-- BOUTON DE SUPPRESSION CORRIGÉ --}}
                            <button class="btn btn-sm btn-danger" title="Supprimer" onclick="confirmDeletion({{ $enseignant->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $enseignant->id }}" action="{{ route('admin.enseignants.destroy', $enseignant) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Aucun encadrant trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($data->hasPages())
    <div class="card-footer clearfix">
        {{-- Affichage de la pagination --}}
        {{ $data->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDeletion(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet encadrant ? Cette action est irréversible.")) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush