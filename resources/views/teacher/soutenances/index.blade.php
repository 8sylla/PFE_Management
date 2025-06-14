@extends('layouts.teacher')

@section('title', 'Mes Soutenances')
@section('page-title', 'Planning de Mes Soutenances')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Soutenances</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste de toutes les soutenances que vous encadrez</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Date & Heure</th>
                    <th>Étudiant</th>
                    <th>Jury</th>
                    <th>Salle</th>
                    <th class="text-center">Note</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($soutenances as $soutenance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($soutenance->date)->format('d/m/Y H:i') }}</td>
                        <td>{{ $soutenance->etudiant->name ?? 'N/A' }}</td>
                        <td>{{ $soutenance->jury->name ?? 'N/A' }}</td>
                        <td>{{ $soutenance->sale->numero ?? 'N/A' }}</td>
                        <td class="text-center">
                            @if($soutenance->note)
                                <span class="badge badge-success">{{ $soutenance->note }} / 20</span>
                            @else
                                <span class="badge badge-secondary">Non noté</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-calendar-times fa-3x mb-3"></i>
                            <p>Aucune soutenance n'est planifiée pour vos étudiants pour le moment.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($soutenances->hasPages())
    <div class="card-footer clearfix">
        {{ $soutenances->links() }}
    </div>
    @endif
</div>
@endsection