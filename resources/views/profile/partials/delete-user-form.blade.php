<section class="space-y-6">
    <header>
        <h2 style="font-size: 1.125rem; font-weight: bold; color: #1e293b; margin: 0;">
            {{ __('profile.eliminar_cuenta') }}
        </h2>

        <p style="margin-top: 0.25rem; font-size: 0.875rem; color: #64748b;">
            {{ __('profile.eliminar_aviso') }}
        </p>
    </header>

    <button type="button" onclick="confirm('{{ __('profile.eliminar_aviso') }}') ? document.getElementById('delete-form').submit() : ''" style="background-color: #ef4444; color: white; padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; cursor: pointer; font-weight: bold;">
        {{ __('profile.btn_eliminar') }}
    </button>

    <form id="delete-form" method="post" action="{{ route('profile.destroy') }}" class="hidden" style="display: none;">
        @csrf
        @method('delete')
    </form>
</section>
