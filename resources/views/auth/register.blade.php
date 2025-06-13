<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <!-- Left Side (Form) -->
            <div class="flex flex-col justify-center p-8 md:p-12">
                <span class="mb-3 text-4xl font-bold">Inscription</span>
                <span class="font-light text-gray-400 mb-8">
                    Veuillez remplir les informations pour créer votre compte
                </span>
                
                <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Profile Image Upload -->
                    <div class="flex items-center space-x-4">
                        <img id="image_preview" src="https://via.placeholder.com/80" alt="profile_image" class="w-20 h-20 rounded-full object-cover">
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Image de profil</label>
                            <input id="image" name="image" type="file" onchange="previewImage(event)" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" value="Nom Complet" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" value="Email Institutionnel" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Encadrant -->
                    <div>
                        <x-input-label for="enseignant_id" value="Choisir l'encadrant" />
                        <select id="enseignant_id" name="enseignant_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option selected disabled>-- Sélectionnez votre encadrant --</option>
                            @foreach($enseignant as $ens)
                                <option value="{{ $ens->id }}" {{ old('enseignant_id') == $ens->id ? 'selected' : '' }}>{{ $ens->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('enseignant_id')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="password" value="Mot de passe" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Register Button -->
                    <div>
                        <x-primary-button class="w-full flex justify-center">
                            S'inscrire
                        </x-primary-button>
                    </div>

                    <div class="text-center text-sm text-gray-600">
                        Déjà un compte?
                        <a class="underline hover:text-gray-900" href="{{ route('login') }}">
                            Se connecter
                        </a>
                    </div>
                </form>
            </div>

            <!-- Right Side (Branding) -->
            <div class="relative hidden md:block">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                     alt="img"
                     class="w-[400px] h-full hidden rounded-r-2xl object-cover md:block">
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-guest-layout>