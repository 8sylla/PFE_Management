<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Soumettre ma Fiche PFE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Formulaire de Proposition de PFE</h3>
                    <p class="text-gray-600 mb-6">Veuillez remplir toutes les informations ci-dessous avec précision. Une fois soumise, votre fiche sera envoyée à votre encadrant pour validation.</p>
                    
                    <form method="POST" action="{{ route('fiche.store') }}">
                        @csrf
                        
                        <!-- Champs cachés pour les IDs -->
                        <input type="hidden" name="etudiant_id" value="{{ $user->id }}">
                        <input type="hidden" name="enseignant_id" value="{{ $enseignant->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Société d'accueil -->
                            <div>
                                <x-input-label for="societe_acceuil" :value="__('Société d\'accueil')" />
                                <x-text-input id="societe_acceuil" class="block mt-1 w-full" type="text" name="societe_acceuil" :value="old('societe_acceuil')" required />
                                <x-input-error :messages="$errors->get('societe_acceuil')" class="mt-2" />
                            </div>

                            <!-- Encadrant externe -->
                            <div>
                                <x-input-label for="encadrant_externe" :value="__('Encadrant externe')" />
                                <x-text-input id="encadrant_externe" class="block mt-1 w-full" type="text" name="encadrant_externe" :value="old('encadrant_externe')" required />
                                <x-input-error :messages="$errors->get('encadrant_externe')" class="mt-2" />
                            </div>

                             <!-- Téléphone Société -->
                            <div>
                                <x-input-label for="ntel_societe" :value="__('Téléphone Société')" />
                                <x-text-input id="ntel_societe" class="block mt-1 w-full" type="text" name="ntel_societe" :value="old('ntel_societe')" required />
                                <x-input-error :messages="$errors->get('ntel_societe')" class="mt-2" />
                            </div>

                             <!-- Email Société -->
                            <div>
                                <x-input-label for="mail_societe" :value="__('Email Société')" />
                                <x-text-input id="mail_societe" class="block mt-1 w-full" type="email" name="mail_societe" :value="old('mail_societe')" required />
                                <x-input-error :messages="$errors->get('mail_societe')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Intitulé PFE -->
                        <div class="mt-6">
                            <x-input-label for="intitule_pfe" :value="__('Intitulé du PFE')" />
                            <x-text-input id="intitule_pfe" class="block mt-1 w-full" type="text" name="intitule_pfe" :value="old('intitule_pfe')" required />
                            <x-input-error :messages="$errors->get('intitule_pfe')" class="mt-2" />
                        </div>

                        <!-- Besoins fonctionnels -->
                        <div class="mt-6">
                            <x-input-label for="besions_fonctionnels" :value="__('Besoins fonctionnels')" />
                            <textarea id="besions_fonctionnels" name="besions_fonctionnels" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('besions_fonctionnels') }}</textarea>
                            <x-input-error :messages="$errors->get('besions_fonctionnels')" class="mt-2" />
                        </div>

                        <!-- Technologies utilisées -->
                         <div class="mt-6">
                            <x-input-label for="technologies_utilisees" :value="__('Technologies principales à utiliser')" />
                            <textarea id="technologies_utilisees" name="technologies_utilisees" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('technologies_utilisees') }}</textarea>
                            <x-input-error :messages="$errors->get('technologies_utilisees')" class="mt-2" />
                        </div>
                        
                        <!-- Langue -->
                        <div class="mt-6">
                            <x-input-label :value="__('Langue de rédaction du rapport')" />
                            <div class="flex items-center space-x-4 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="langue" value="Francais" checked>
                                    <span class="ml-2">Français</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="langue" value="Anglais">
                                    <span class="ml-2">Anglais</span>
                                </label>
                            </div>
                             <x-input-error :messages="$errors->get('langue')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button>
                                {{ __('Soumettre la fiche') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>