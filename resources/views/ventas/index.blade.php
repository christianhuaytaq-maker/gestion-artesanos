<x-app-layout>
    <x-slot name="header">
        {{ __('ventas.titulo') }}
    </x-slot>

    <div style="padding: 2rem; background-color: #f8fafc; min-height: 100vh;">

        <!-- Tarjetas de Reportes -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">

            <!-- Total Ventas (General) -->
            <div style="background: #3b82f6; color: white; padding: 1.5rem; border-radius: 0.5rem;">
                <p style="font-size: 0.875rem; opacity: 0.9;">{{ __('ventas.total_ventas') ?? 'Total Ventas' }}</p>
                <p style="font-size: 2rem; font-weight: bold;">{{ $ventas->count() }}</p>
            </div>

            <!-- Ingresos Totales -->
            <div style="background: #10b981; color: white; padding: 1.5rem; border-radius: 0.5rem;">
                <p style="font-size: 0.875rem; opacity: 0.9;">{{ __('ventas.ingresos_totales') ?? 'Ingresos Totales' }}</p>
                <p style="font-size: 2rem; font-weight: bold;">S/ {{ number_format($ventas->sum('total'), 2) }}</p>
            </div>

            <!-- Productos Vendidos -->
            <div style="background: #f59e0b; color: white; padding: 1.5rem; border-radius: 0.5rem;">
                <p style="font-size: 0.875rem; opacity: 0.9;">{{ __('ventas.productos_vendidos') ?? 'Productos Vendidos' }}</p>
                <p style="font-size: 2rem; font-weight: bold;">{{ $ventas->sum('cantidad') }}</p>
            </div>

            <!-- NUEVA TARJETA: VENTAS DE HOY (CON PLURAL CORREGIDO) -->
            <div style="background: linear-gradient(135deg, #8b5cf6, #6d28d9); color: white; padding: 1.5rem; border-radius: 0.5rem; box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);">
                <p style="font-size: 0.875rem; opacity: 0.9;">💰 Ventas de Hoy ({{ now()->format('d/m/Y') }})</p>
                <p style="font-size: 2rem; font-weight: bold;">S/ {{ number_format($totalVendidoHoy ?? 0, 2) }}</p>
                <p style="font-size: 0.75rem; opacity: 0.8; margin-top: 4px;">
                    {{ $cantidadVentasHoy ?? 0 }} {{ ($cantidadVentasHoy ?? 0) == 1 ? 'transacción hoy' : 'transacciones hoy' }}
                </p>
            </div>

        </div>

        <!-- Tabla de Ventas -->
        <div style="background-color: white; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <tr>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.id_venta') ?? 'ID Venta' }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.producto') ?? 'Producto' }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.cliente') ?? 'Cliente' }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.total') ?? 'Total' }}</th>
                        <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase;">{{ __('ventas.fecha') ?? 'Fecha' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #475569;">#{{ $venta->id }}</td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #0f172a;">{{ $venta->producto->nombre ?? 'Producto eliminado' }}</td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #64748b;">
                            <!-- AJUSTE: Muestra el nombre real si el usuario existe en la BD -->
                            {{ $venta->user ? $venta->user->name : 'Cliente Invitado' }} <br>
                            <span style="font-size: 0.75rem; color: #94a3b8;">DNI: {{ $venta->dni_cliente ?? 'No registrado' }}</span>
                        </td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #10b981;">S/ {{ number_format($venta->total, 2) }}</td>
                        <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #64748b;">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding: 3rem; text-align: center; color: #64748b;">{{ __('ventas.sin_registros') ?? 'No hay ventas registradas.' }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
