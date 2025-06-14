@extends('layouts.teacher')

@section('title', 'Mes Étudiants')
@section('page-title', 'Suivi des Étudiants et de leurs Projets')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Mes Étudiants</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste de vos étudiants et de leurs soumissions</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Fiche PFE (Statut)</th>
                    <th>Documents Soumis</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $student)
                <tr>
                    <td>
                        <img src="{{ $student->image ? asset('images_profil/' . $student->image) : asset('dist/img/user2-160x160.jpg') }}" alt="Avatar" class="img-circle img-sm mr-2">
                        {{ $student->name }}
                    </td>
                    <td>
                        @if ($student->latestFiche)
                            {{ Str::limit($student->latestFiche->intitule_pfe, 40) }}<br>
                            <span class="badge {{ $student->latestFiche->Remarque == 'accepte' ? 'badge-success' : ($student->latestFiche->Remarque == 'refuse' ? 'badge-danger' : 'badge-warning') }}">
                                {{ $student->latestFiche->Remarque }}
                            </span>
                        @else
                            <span class="text-muted">Non soumise</span>
                        @endif
                    </td>
                    <td>
                        @if ($student->documents->isNotEmpty())
                            <ul class="list-unstyled">
                                @foreach ($student->documents as $document)
                                    <li>
                                        <a href="{{ Storage::url($document->file_path) }}" target="_blank">
                                            <i class="fas fa-file-alt mr-1"></i> {{ $document->description }}
                                        </a>
                                        <small class="text-muted">({{ $document->created_at->format('d/m/Y') }})</small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Aucun document</span>
                        @endif
                    </td>
                    <td>
                        @if ($student->latestFiche)
                            <a href="{{ route('teacher.fiches.edit', $student->latestFiche) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-pen-to-square"></i> Évaluer Fiche
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-muted">Vous n'encadrez aucun étudiant pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection