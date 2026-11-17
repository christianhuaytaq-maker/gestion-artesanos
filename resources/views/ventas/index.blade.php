<x-app-layout>
    <x-slot name="header">
        {{ __('ventas.titulo') }}
    </x-slot>

    <div style="padding: 2rem; background-color: #f8fafc; min-height: 100vh;">

        <!-- Tarjetas de Reportes -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
            <div style="background: #3b82f6; color: white; padding: 1.5rem; border-radius: 0.5rem;">
                <p style="font-size: 0.875rem; opacity: 0.9;">{{ __('ventas.total_ventas') }}</p>
                <p style="font-size: 2rem; font-weight: bold;">{{ $ventas->count() }}</p>
            </div>
            <div style="background: #10b981; color: white; padding: 1.5rem; border-radius: 0.5rem;">
                <p style="font-size: 0.875rem; opacity: 0.9;">{{ __('ventas.ingresos_totales') }}</p>
                <p style="font-size: 2rem; font-weight: bold;">S/ {{ number_format($ventas->sum('total'), 2) }}</p>
            </div>
            <div style="background: #f59e0b; color: white; padding: 1.5rem; border-radius: 0.5rem;">
                <p style="font-size: 0.875rem; opacity: 0.9;">{{ __('ventas.productos_vendidos') }}</p>
                <p style="font-size: 2rem; font-weight: bold;">{{ $ventas->sum('cantidad') }}</p>
            </div>
        </div>

        <!-- Tabla de Ventas -->
        <div style="background-color: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <tr>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.id_venta') }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.producto') }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.cliente') }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.total') }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.fecha') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #475569;">#{{ $venta->id }}</td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #0f172a;">{{ $venta->producto->nombre }}</td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #64748b;">
                            {{ $venta->user->name }} <br>
                            <span style="font-size: 0.75rem; color: #94a3b8;">DNI: {{ $venta->dni_cliente ?? 'No registrado' }}</span>
                        </td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #10b981;">S/ {{ number_format($venta->total, 2) }}</td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #64748b;">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 3rem; text-align: center; color: #64748b;">{{ __('ventas.sin_registros') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
