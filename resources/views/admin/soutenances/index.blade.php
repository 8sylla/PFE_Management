@extends('auth.admindashboard')

@section('title', 'Planning des Soutenances')
@section('page-title', 'Soutenances Planifiées')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Soutenances</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Calendrier de toutes les soutenances</h3>
        <a href="{{ route('addsoutenance') }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus mr-2"></i>Planifier une soutenance
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Date & Heure</th>
                    <th>Étudiant</th>
                    <th>Encadrant</th>
                    <th>Jury</th>
                    <th>Salle</th>
                    <th class="text-center">Note</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($soutenances as $soutenance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($soutenance->date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $soutenance->etudiant->name ?? 'N/A' }}</td>
                        <td>{{ $soutenance->enseignant->name ?? 'N/A' }}</td>
                        <td>{{ $soutenance->jury->name ?? 'N/A' }}</td>
                        <td>{{ $soutenance->sale->numero ?? 'N/A' }}</td>
                        <td class="text-center">
                            @if($soutenance->note)
                                <span class="badge badge-success">{{ $soutenance->note }} / 20</span>
                            @else
                                <span class="badge badge-secondary">Non noté</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('updatesoutenance', $soutenance->id) }}" class="btn btn-sm btn-info" title="Modifier la date/note">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" title="Annuler la soutenance" onclick="confirmDeletion({{ $soutenance->id }})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $soutenance->id }}" action="{{-- route('deletesoutenance', $soutenance->id) --}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                             <i class="fas fa-calendar-times fa-3x mb-3"></i>
                             <p>Aucune soutenance n'est planifiée pour le moment.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $soutenances->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDeletion(id) {
    if (confirm("Êtes-vous sûr de vouloir annuler cette soutenance ?")) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush