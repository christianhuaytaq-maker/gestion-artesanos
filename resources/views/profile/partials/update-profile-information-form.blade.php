<section>
    <header>
        <h2 style="font-size: 1.125rem; font-weight: bold; color: #1e293b; margin: 0;">
            {{ __('profile.info_perfil') }}
        </h2>

        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #64748b;">
            {{ __('profile.info_subtitulo') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" style="margin-top: 1.5rem;">
        @csrf
        @method('patch')

        <div style="margin-bottom: 1rem;">
            <label for="name" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #374151;">{{ __('profile.nombre') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            @error('name') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 0.5rem; color: #374151;">{{ __('profile.email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
            @error('email') <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display: flex; align-items: center; gap: 1rem;">
            <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: bold;">
                {{ __('profile.guardar') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p style="font-size: 0.875rem; color: #10b981;">{{ __('profile.guardado') }}</p>
            @endif
        </div>
    </form>
</section>
