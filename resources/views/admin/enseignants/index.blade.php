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
        <a href="{{ route('admin.formaddenseignant') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Ajouter un encadrant
        </a>
    </div>
    <div class="card-body">
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
                            <a href="{{ route('updateform', $enseignant->id) }}" class="btn btn-sm btn-info" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" title="Supprimer" onclick="confirmDeletion({{ $enseignant->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $enseignant->id }}" action="{{ route('deleteens', $enseignant->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE') <!-- Important pour la suppression -->
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun encadrant trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{-- Pour la pagination future : {{ $data->links() }} --}}
    </div>
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