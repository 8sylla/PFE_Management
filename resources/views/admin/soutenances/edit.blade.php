@extends('auth.admindashboard')

@section('title', 'Modifier une Soutenance')
@section('page-title', 'Mise à jour de la Soutenance')

@section('breadcrumbs')
    {{-- LIEN CORRIGÉ DANS LE FIL D'ARIANE --}}
    <li class="breadcrumb-item"><a href="{{ route('admin.soutenances.index') }}">Soutenances</a></li>
    <li class="breadcrumb-item active">Modifier</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Modification de la soutenance de <span class="font-weight-bold">{{ $data->etudiant->name ?? 'N/A' }}</span>
                </h3>
            </div>
            
            {{-- ACTION DU FORMULAIRE CORRIGÉE --}}
            <form action="{{ route('admin.soutenances.update', $data) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Étudiant concerné</label>
                                <input type="text" class="form-control" value="{{ $data->etudiant->name ?? 'N/A' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date et Heure</label>
                                <input type="datetime-local" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', \Carbon\Carbon::parse($data->date)->format('Y-m-d\TH:i')) }}" required>
                                @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salle_id">Salle</label>
                                <select name="salle_id" class="form-control select2 @error('salle_id') is-invalid @enderror" required>
                                    @foreach($salles as $salle)
                                        <option value="{{ $salle->id }}" {{ old('salle_id', $data->salle_id) == $salle->id ? 'selected' : '' }}>
                                            {{ $salle->numero }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('salle_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jury_id">Jury</label>
                                <select name="jury_id" class="form-control select2 @error('jury_id') is-invalid @enderror" required>
                                    @foreach($jurys as $jury)
                                        <option value="{{ $jury->id }}" {{ old('jury_id', $data->jury_id) == $jury->id ? 'selected' : '' }}>
                                            {{ $jury->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jury_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="note">Note finale (/20)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-star"></i></span>
                                    <input type="number" step="0.01" min="0" max="20" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note', $data->note) }}" placeholder="Ex: 16.50">
                                </div>
                                <small class="form-text text-muted">Laissez vide si la soutenance n'a pas encore eu lieu.</small>
                                @error('note')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-transparent text-right">
                    {{-- LIEN D'ANNULATION CORRIGÉ --}}
                    <a href="{{ route('admin.soutenances.index') }}" class="btn btn-secondary mr-2">Annuler</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Mettre à jour la soutenance</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection