<section>
    <header>
        <h2 style="font-size: 1.125rem; font-weight: bold; color: #1e293b; margin: 0;">
            {{ __('profile.actualizar_password') }}
        </h2>

        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #64748b;">
            {{ __('profile.password_subtitulo') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" style="margin-top: 1.5rem;">
        @csrf
        @method('put')

        <div style="margin-bottom: 1rem;">
            <label for="update_password_current_password" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #374151;">{{ __('profile.password_actual') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            @error('current_password', 'updatePassword') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="update_password_password" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #374151;">{{ __('profile.nueva_password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            @error('password', 'updatePassword') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="update_password_password_confirmation" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #374151;">{{ __('profile.confirmar_password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            @error('password_confirmation', 'updatePassword') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: bold;">
                {{ __('profile.guardar') }}
            </button>
        </div>
    </form>
</section>
