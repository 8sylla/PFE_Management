@extends($layout)

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Étudiants & Soutenances</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Soutenances</li>
        </ol>
      </div>
    </div>
</div>

<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 20%">Nom Étudiant</th>
            <th style="width: 20%">Email</th>
            <th style="width: 15%">Image</th>
            <th style="width: 25%">Fiche de l'étudiant(e)</th>
            <th style="width: 20%">Date de soutenance</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $soutenance)
            <tr>
                <td>{{ $soutenance->etudiant->name ?? 'N/A' }}</td>
                <td>{{ $soutenance->etudiant->email ?? 'N/A' }}</td>
                <td>
                    @if(!empty($soutenance->etudiant->image))
                        <img src="{{ asset('images_profil/' . $soutenance->etudiant->image) }}" style="width:50px;height:50px;" alt="Profile Image">
                    @else
                        <span class="text-muted">Aucune image</span>
                    @endif
                </td>
                <td>
                    @if (!empty($soutenance->etudiant->latest_fiche))
                        <a class="btn btn-info btn-sm" href="{{ route('updateformfiche', ['id' => $soutenance->etudiant->latest_fiche->id]) }}">
                            <i class="fas fa-pencil-alt"></i> Fiche
                        </a>
                    @else
                        <span class="text-muted">Aucune fiche disponible</span>
                    @endif
                </td>
                <td>{{ $soutenance->date }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-danger">Aucune soutenance trouvée.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
