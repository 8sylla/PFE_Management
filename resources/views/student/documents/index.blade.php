@extends('layouts.student')

@section('title', 'Mes Documents PFE')
@section('page-title', 'Gestion de mes Documents')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Mes Documents</li>
@endsection

@section('content')
<div class="row">
    <!-- Colonne de gauche : Formulaire d'upload -->
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-upload mr-2"></i>Téléverser un nouveau document</h3>
            </div>
            <form method="post" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="description">Description du fichier</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Ex: Rapport de PFE v1.2, Présentation finale..." required>
                        @error('description')<div class="text-danger mt-1 text-sm">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Fichier (PDF, DOCX, PPTX - 10Mo max)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" required>
                            <label class="custom-file-label" for="file">Choisir un fichier...</label>
                        </div>
                         @error('file')<div class="text-danger mt-1 text-sm">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>Envoyer le document
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Colonne de droite : Liste des documents -->
    <div class="col-md-7">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i>Documents déjà soumis</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <tbody>
                        @forelse ($documents as $document)
                            <tr>
                                <td><i class="fas fa-file-alt text-muted"></i></td>
                                <td>
                                    <strong>{{ $document->description }}</strong><br>
                                    <small class="text-muted">{{ $document->file_name }}</small>
                                </td>
                                <td class="text-muted">{{ $document->created_at->diffForHumans() }}</td>
                                <td class="text-right">
                                    <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted p-4">
                                    Aucun document n'a été téléversé pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Pour afficher le nom du fichier dans le champ d'upload de Bootstrap
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
{{-- Vous devrez peut-être installer ce plugin si AdminLTE ne l'inclut pas par défaut --}}
{{-- npm install bs-custom-file-input --}}
{{-- Puis l'ajouter dans votre app.js : import 'bs-custom-file-input'; --}}
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endpush