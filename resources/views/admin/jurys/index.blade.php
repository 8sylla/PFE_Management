@extends('auth.admindashboard')

@section('title', 'Gestion des Jurys')
@section('page-title', 'Liste des Jurys')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Jurys</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Tous les jurys disponibles</h3>
        
        {{-- LIEN CORRIGÉ --}}
        <a href="{{ route('admin.jurys.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Ajouter un Jury
        </a>
    </div>
    <div class="card-body">
        @if($data->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="fas fa-users-slash fa-3x mb-3"></i>
                <p>Aucun jury n'a été créé pour le moment.</p>
                
                {{-- LIEN CORRIGÉ --}}
                <a href="{{ route('admin.jurys.create') }}" class="btn btn-primary mt-2">Créer le premier jury</a>
            </div>
        @else
            <div class="row">
                @foreach ($data as $jury)
                <div class="col-md-4 col-sm-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <i class="fas fa-users fa-4x text-primary"></i>
                            </div>
                            <h3 class="profile-username text-center mt-3">{{ $jury->name }}</h3>
                            <p class="text-muted text-center">ID: {{ $jury->id }}</p>
                            
                            {{-- BOUTON DE SUPPRESSION CORRIGÉ --}}
                            <button class="btn btn-danger btn-block" onclick="confirmDeletion({{ $jury->id }})">
                                <b><i class="fas fa-trash mr-1"></i> Supprimer</b>
                            </button>
                            <form id="delete-form-{{ $jury->id }}" action="{{ route('admin.jurys.destroy', $jury) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
    @if($data->hasPages())
    <div class="card-footer clearfix">
        {{ $data->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
function confirmDeletion(id) {
    if (confirm("Êtes-vous sûr de vouloir supprimer ce jury ? Cette action est irréversible.")) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush