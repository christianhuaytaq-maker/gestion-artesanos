<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: bold; font-size: 1.25rem; color: #1e293b; margin: 0;">
            {{ __('profile.mi_perfil') }}
        </h2>
    </x-slot>

    <div style="padding: 2rem; background-color: #f8fafc; min-height: 100vh;">
        <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 1.5rem;">

            <!-- Formulario 1: Info del perfil -->
            <div style="background-color: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                <div style="max-width: 600px; margin: 0 auto;">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Formulario 2: Contraseña -->
            <div style="background-color: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                <div style="max-width: 600px; margin: 0 auto;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Formulario 3: Eliminar cuenta -->
            <div style="background-color: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;">
                <div style="max-width: 600px; margin: 0 auto;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
