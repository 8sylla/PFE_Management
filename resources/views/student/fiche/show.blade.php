<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statut de ma Fiche PFE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                    <p class="font-bold">Succès !</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (isset($message))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded" role="alert">
                    <p>{{ $message }}</p>
                    <a href="{{ route('fiche.create') }}" class="mt-2 inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                        Soumettre ma fiche maintenant
                    </a>
                </div>
            @elseif ($fiche)
                @php
                    $remarque = strtolower($fiche->Remarque);
                    $bgColor = 'bg-yellow-100 border-yellow-500 text-yellow-700';
                    $icon = 'fas fa-clock';
                    $statusText = 'Votre fiche est en cours de validation par votre encadrant.';

                    if ($remarque == 'accepte') {
                        $bgColor = 'bg-green-100 border-green-500 text-green-700';
                        $icon = 'fas fa-check-circle';
                        $statusText = 'Félicitations ! Votre fiche a été validée avec succès.';
                    } elseif ($remarque == 'refuse') {
                        $bgColor = 'bg-red-100 border-red-500 text-red-700';
                        $icon = 'fas fa-times-circle';
                        $statusText = 'Votre fiche a été refusée. Veuillez contacter votre encadrant pour plus de détails et soumettre une nouvelle proposition.';
                    }
                @endphp

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 {{ $bgColor }}">
                        <div class="flex items-center">
                            <i class="{{ $icon }} fa-2x mr-4"></i>
                            <div>
                                <p class="font-bold text-lg">Statut : {{ ucfirst($remarque) }}</p>
                                <p>{{ $statusText }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl font-bold mb-4">Détails de la fiche soumise</h3>
                        <div class="space-y-4">
                            <div><strong class="w-48 inline-block">Intitulé du PFE:</strong> {{ $fiche->intitule_pfe }}</div>
                            <div><strong class="w-48 inline-block">Société d'accueil:</strong> {{ $fiche->societe_acceuil }}</div>
                            <div><strong class="w-48 inline-block">Encadrant externe:</strong> {{ $fiche->encadrant_externe }}</div>
                             <div><strong class="w-48 inline-block">Technologies:</strong> {{ $fiche->technologies_utilisees }}</div>
                        </div>

                        @if($remarque == 'accepte')
                            <div class="mt-6 text-right">
                                <a href="{{ route('fiche.pdf') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    <i class="fas fa-download mr-2"></i> Télécharger en PDF
                                a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>