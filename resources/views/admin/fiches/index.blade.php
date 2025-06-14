@extends('auth.admindashboard')
@section('title', 'Fiches PFE en Attente')
@section('page-title', 'Validation des Fiches PFE')
@section('breadcrumbs')<li class="breadcrumb-item active">Fiches</li>@endsection

@section('content')
<div class="card">
    <div class="card-header"><h3 class="card-title">Fiches en attente de validation par les encadrants</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead><tr><th>Intitulé du PFE</th><th>Étudiant</th><th>Encadrant</th><th>Date Soumission</th></tr></thead>
            <tbody>
                @forelse ($fiches as $fiche)
                    <tr>
                        <td>{{ Str::limit($fiche->intitule_pfe, 50) }}</td>
                        <td>{{ $fiche->etudiant->name ?? 'N/A' }}</td>
                        <td>{{ $fiche->enseignant->name ?? 'N/A' }}</td>
                        <td>{{ $fiche->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center p-4">Aucune fiche n'est en attente de validation.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
     @if($fiches->hasPages())<div class="card-footer">{{ $fiches->links() }}</div>@endif
</div>
@endsection