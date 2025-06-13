@extends('auth.admindashboard')

@section('title', 'Gestion des Salles')
@section('page-title', 'Liste des Salles')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Salles</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Toutes les salles de soutenance</h3>
        <a href="{{ route('addsalle') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Ajouter une Salle
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th>Numéro / Nom de la Salle</th>
                    <th>Département</th>
                    <th style="width: 15%;" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $salle)
                    <tr>
                        <td>{{ $salle->id }}</td>
                        <td>{{ $salle->numero }}</td>
                        <td>{{ $salle->depatement }}</td>
                        <td class="text-center">
                            {{-- <a href="#" class="btn btn-sm btn-info" title="Modifier"><i class="fas fa-edit"></i></a> --}}
                            <button class="btn btn-sm btn-danger" title="Supprimer" onclick="confirmDeletion({{ $salle->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $salle->id }}" action="{{-- route('deletesalle', $salle->id) --}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Aucune salle enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDeletion(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette salle ?")) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush