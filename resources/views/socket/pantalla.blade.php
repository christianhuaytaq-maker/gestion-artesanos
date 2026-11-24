<x-app-layout>
    <x-slot name="header">
        {{ __('panel.title') }}
    </x-slot>

    <!-- ESTILOS ESPECÍFICOS DEL PANEL -->
    <style>
        .kpi-card {
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .kpi-card::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            top: -50px;
            right: -50px;
        }
        .kpi-blue { background: linear-gradient(135deg, #4318FF 0%, #868CFF 100%); }
        .kpi-green { background: linear-gradient(135deg, #05CD99 0%, #4AD991 100%); }
        .kpi-orange { background: linear-gradient(135deg, #FFB547 0%, #FFCE20 100%); }

        .kpi-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
            margin: 0;
            font-weight: 600;
        }
        .kpi-number {
            font-size: 2.8rem;
            font-weight: 800;
            margin: 0.5rem 0 0 0;
            line-height: 1;
        }
        .kpi-icon {
            opacity: 0.3;
            z-index: 1;
        }
        .kpi-icon svg { width: 4rem; height: 4rem; }

        .panel-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            border: 1px solid #F1F5F9;
        }
        .panel-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2B3674;
            margin-top: 0;
            margin-bottom: 1.5rem;
        }

        .table-container { width: 100%; overflow-x: auto; }
        .modern-table { width: 100%; border-collapse: collapse; text-align: left; }
        .modern-table th {
            font-size: 0.75rem;
            color: #A3AED0;
            text-transform: uppercase;
            font-weight: 600;
            padding: 1rem;
            border-bottom: 1px solid #F1F5F9;
        }
        .modern-table td {
            padding: 1rem;
            border-bottom: 1px solid #F1F5F9;
            vertical-align: middle;
        }
        .modern-table tr:last-child td { border-bottom: none; }
        .modern-table tr:hover { background-color: #F8FAFC; }

        .badge-specialty {
            padding: 0.35rem 0.8rem;
            background-color: #F4F7FE;
            color: #4318FF;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>

    <!-- TARJETAS KPI -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">

        <!-- Tarjeta Artesanos -->
        <div class="kpi-card kpi-blue">
            <div>
                <p class="kpi-title">{{ __('panel.artesanos') }}</p>
                <p id="total-artesanos" class="kpi-number">{{ $totalArtesanos }}</p>
            </div>
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Tarjeta Productos -->
        <div class="kpi-card kpi-green">
            <div>
                <p class="kpi-title">{{ __('panel.productos') }}</p>
                <p id="total-productos" class="kpi-number">{{ $totalProductos }}</p>
            </div>
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
        </div>

        <!-- Tarjeta Usuarios -->
        <div class="kpi-card kpi-orange">
            <div>
                <p class="kpi-title">{{ __('panel.usuarios') }}</p>
                <p id="total-usuarios" class="kpi-number">{{ $totalUsuarios }}</p>
            </div>
            <div class="kpi-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- GRÁFICOS -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">

        <!-- Gráfico Circular -->
        <div class="panel-card">
            <h3 class="panel-title">Artesanos por Especialidad</h3>
            <div style="position: relative; height: 320px; width: 100%; display: flex; justify-content: center;">
                <canvas id="graficoEspecialidades"></canvas>
            </div>
        </div>

        <!-- Gráfico de Barras -->
        <div class="panel-card">
            <h3 class="panel-title">Últimas Ventas (S/)</h3>
            <div style="position: relative; height: 320px; width: 100%;">
                <canvas id="graficoVentas"></canvas>
            </div>
        </div>
    </div>

    <!-- TABLA DE ÚLTIMOS ARTESANOS -->
    <div class="panel-card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #F1F5F9; display: flex; justify-content: space-between; align-items: center;">
            <h3 class="panel-title" style="margin: 0;">{{ __('panel.ultimos_artesanos') }}</h3>
            <a href="{{ route('artesanos.index') }}" style="font-size: 0.875rem; font-weight: 600; color: #4318FF; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                {{ __('panel.ver_todos') }} <span>&rarr;</span>
            </a>
        </div>

        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>{{ __('panel.nombre_completo') }}</th>
                        <th>{{ __('panel.especialidad') }}</th>
                        <th>{{ __('panel.telefono') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimosArtesanos as $artesano)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg, #E0E7FF, #C7D2FE); color: #4318FF; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">
                                    {{ substr($artesano->nombres, 0, 1) }}
                                </div>
                                <div>
                                    <p style="font-weight: 600; color: #2B3674; margin: 0; font-size: 0.95rem;">{{ $artesano->nombres }} {{ $artesano->apellidos }}</p>
                                    <p style="font-size: 0.75rem; color: #A3AED0; margin: 0;">DNI: {{ $artesano->dni ?? 'No registrado' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-specialty">{{ $artesano->especialidad }}</span>
                        </td>
                        <td style="font-size: 0.9rem; color: #4B5563; font-weight: 500;">{{ $artesano->telefono }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 3rem; text-align: center; font-size: 0.9rem; color: #A3AED0;">
                            {{ __('panel.sin_registros') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = function() {
            // 1. GRÁFICO CIRCULAR (ESTILO DONUT MODERNO)
            var canvasGrafico = document.getElementById('graficoEspecialidades');
            if (canvasGrafico) {
                var ctx = canvasGrafico.getContext('2d');
                var labels = {!! json_encode($labelsGrafico ?? []) !!};
                var data = {!! json_encode($dataGrafico ?? []) !!};
                var backgroundColors = ['#4318FF', '#05CD99', '#FFB547', '#8B5CF6', '#EF4444', '#06B6D4'];

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColors,
                            borderWidth: 0,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 25,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: { family: 'Inter', size: 12 }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#111C44',
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        var label = context.label || '';
                                        var value = context.raw;
                                        var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        var percentage = total > 0 ? ((value / total) * 100).toFixed(1) + '%' : '0%';
                                        return ' ' + label + ': ' + value + ' (' + percentage + ')';
                                    }
                                }
                            }
                        },
                        cutout: '75%' // Hace el hueco central más grande (estilo moderno)
                    }
                });
            }

            // 2. GRÁFICO DE BARRAS (REDONDEADO Y LIMPIO)
            var canvasVentas = document.getElementById('graficoVentas');
            if (canvasVentas) {
                var ctx2 = canvasVentas.getContext('2d');
                var labelsVentas = {!! json_encode($labelsVentas ?? []) !!};
                var dataVentas = {!! json_encode($dataVentas ?? []) !!};

                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: labelsVentas,
                        datasets: [{
                            label: 'Total (S/)',
                            data: dataVentas,
                            backgroundColor: '#4318FF', // Azul moderno
                            borderRadius: 8, // Barras redondeadas
                            borderSkipped: false,
                            barThickness: 35
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#111C44',
                                padding: 12,
                                cornerRadius: 8,
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: '#F1F5F9', // Líneas de cuadrícula muy sutiles
                                    drawBorder: false
                                },
                                ticks: {
                                    font: { family: 'Inter', size: 11 },
                                    color: '#A3AED0',
                                    callback: function(value) { return 'S/ ' + value; }
                                }
                            },
                            x: {
                                grid: { display: false }, // Quita las líneas verticales
                                ticks: {
                                    font: { family: 'Inter', size: 11 },
                                    color: '#A3AED0'
                                }
                            }
                        }
                    }
                });
            }

            // 3. LÓGICA DEL SOCKET
            if (window.Echo) {
                window.Echo.channel('panel')
                    .listen('ArtesanoCreado', (e) => {
                        var contador = document.getElementById('total-artesanos');
                        if (contador) { contador.innerText = e.nuevoTotal; }
                    });
            }
        };
    </script>
</x-app-layout>
