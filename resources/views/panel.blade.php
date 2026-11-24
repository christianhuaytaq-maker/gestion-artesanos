<x-app-layout>
    <x-slot name="header">
        {{ __('panel.title') }}
    </x-slot>

    <style>
        /* =========================================
           TARJETAS KPI - ESTILO PREMIOS + GOTITAS DE AGUA
           ========================================= */
        .grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(245px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .kpi-card {
            border-radius: 26px;
            padding: 1.55rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #FFFFFF;
            transition: all 0.35s cubic-bezier(0.22, 1, 0.36, 1);
            min-height: 150px;
            position: relative;
            overflow: hidden;
            border: 1.5px solid rgba(255, 255, 255, 0.55);
        }

        .kpi-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        /* Gotitas de agua / burbujas translúcidas con borde luminoso */
        .kpi-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 75% 22%, rgba(255, 255, 255, 0.55) 0px, rgba(255, 255, 255, 0.16) 17px, transparent 20px),
                radial-gradient(circle at 87% 40%, rgba(255, 255, 255, 0.48) 0px, rgba(255, 255, 255, 0.12) 10px, transparent 12px),
                radial-gradient(circle at 63% 66%, rgba(255, 255, 255, 0.42) 0px, rgba(255, 255, 255, 0.14) 14px, transparent 16px),
                radial-gradient(circle at 89% 78%, rgba(255, 255, 255, 0.50) 0px, rgba(255, 255, 255, 0.14) 22px, transparent 25px),
                radial-gradient(circle at 50% 16%, rgba(255, 255, 255, 0.36) 0px, transparent 8px),
                radial-gradient(circle at 79% 56%, rgba(255, 255, 255, 0.32) 0px, transparent 6px);
            pointer-events: none;
            z-index: 1;
        }

        /* Reflejo superior tipo cristal húmedo */
        .kpi-card::after {
            content: '';
            position: absolute;
            top: -32%;
            left: -15%;
            width: 130%;
            height: 75%;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.38) 0%, rgba(255, 255, 255, 0.06) 72%, transparent 100%);
            transform: rotate(-4deg);
            pointer-events: none;
            z-index: 1;
        }

        /* Paletas luminosas y vibrantes tipo premio */
        .kpi-blue {
            background: linear-gradient(135deg, #2563EB 0%, #4F46E5 48%, #06B6D4 100%);
            box-shadow: 0 18px 38px -8px rgba(37, 99, 235, 0.48), inset 0 1px 1px rgba(255, 255, 255, 0.65);
        }

        .kpi-green {
            background: linear-gradient(135deg, #059669 0%, #10B981 52%, #2DD4BF 100%);
            box-shadow: 0 18px 38px -8px rgba(16, 185, 129, 0.48), inset 0 1px 1px rgba(255, 255, 255, 0.65);
        }

        .kpi-orange {
            background: linear-gradient(135deg, #EA580C 0%, #F59E0B 52%, #FDE047 100%);
            box-shadow: 0 18px 38px -8px rgba(245, 158, 11, 0.52), inset 0 1px 1px rgba(255, 255, 255, 0.7);
        }

        .kpi-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.82rem;
            font-weight: 800;
            z-index: 2;
            text-transform: uppercase;
            letter-spacing: 1.1px;
        }

        .kpi-number {
            font-size: 3.25rem;
            font-weight: 900;
            margin: 0.45rem 0 0 0;
            line-height: 1;
            z-index: 2;
            text-shadow: 0 5px 16px rgba(0, 0, 0, 0.2);
        }

        .kpi-footer {
            font-size: 0.76rem;
            margin-top: 0.6rem;
            display: flex;
            align-items: center;
            gap: 5px;
            z-index: 2;
            font-weight: 800;
            background: rgba(255, 255, 255, 0.28);
            padding: 6px 12px;
            border-radius: 14px;
            width: fit-content;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        /* =========================================
           TARJETAS DE GRÁFICOS Y TABLA - TONOS CLAROS Y VIVOS
           ========================================= */
        .panel-card {
            border-radius: 26px;
            padding: 1.55rem;
            box-shadow: 0 14px 34px rgba(79, 70, 229, 0.08);
            border: 1.5px solid rgba(255, 255, 255, 0.85);
            transition: all 0.28s ease;
            position: relative;
            overflow: hidden;
        }

        .panel-card:hover {
            box-shadow: 0 20px 44px rgba(79, 70, 229, 0.15);
            transform: translateY(-3px);
        }

        /* Tarjeta izquierda: degradado claro azul-violeta-menta */
        .panel-card.accent-indigo {
            background: linear-gradient(155deg, #FFFFFF 0%, #F4F7FF 58%, #E9FBF5 100%);
            border-color: #D8E2FF;
        }
        .panel-card.accent-indigo::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, #3B82F6, #8B5CF6, #10B981);
        }

        /* Tarjeta derecha: degradado claro dorado-champagne-fucsia suave */
        .panel-card.accent-gold {
            background: linear-gradient(155deg, #FFFFFF 0%, #FFFBEB 55%, #FDF2F8 100%);
            border-color: #FDE68A;
        }
        .panel-card.accent-gold::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, #F59E0B, #EC4899, #8B5CF6);
        }

        /* Tarjeta tabla: degradado claro luminoso */
        .panel-card.accent-award {
            background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFF 65%, #EFF6FF 100%);
            border-color: #DBEAFE;
        }
        .panel-card.accent-award::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, #2563EB, #10B981, #F59E0B, #EC4899);
        }

        .panel-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1B2559;
            margin-top: 0;
            margin-bottom: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* TABLA MODERNA CON TONOS CLAROS */
        .table-container { width: 100%; overflow-x: auto; }
        .modern-table { width: 100%; border-collapse: collapse; text-align: left; }
        .modern-table th {
            font-size: 0.74rem;
            color: #4F46E5;
            text-transform: uppercase;
            font-weight: 800;
            padding: 1rem 1.25rem;
            background: linear-gradient(90deg, #EEF2FF 0%, #ECFDF5 50%, #FEF3C7 100%);
            border-bottom: 1px solid #DCE5FF;
            letter-spacing: 1px;
        }
        .modern-table td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #E2E8F0;
            vertical-align: middle;
        }
        .modern-table tbody tr {
            transition: all 0.2s ease;
        }
        .modern-table tbody tr:hover {
            background: linear-gradient(90deg, rgba(224, 231, 255, 0.55) 0%, rgba(209, 250, 229, 0.45) 100%);
        }

        /* BADGES DE ESPECIALIDAD VIBRANTES */
        .badge-specialty {
            display: inline-block;
            padding: 0.44rem 0.98rem;
            background: linear-gradient(135deg, #E0E7FF 0%, #FCE7F3 100%);
            color: #3730A3;
            border-radius: 20px;
            font-size: 0.76rem;
            font-weight: 800;
            border: 1px solid #C7D2FE;
            box-shadow: 0 4px 10px rgba(79, 70, 229, 0.1);
        }

        .btn-ver-todos {
            font-size: 0.85rem;
            font-weight: 800;
            color: #FFFFFF;
            text-decoration: none;
            background: linear-gradient(135deg, #4F46E5 0%, #EC4899 100%);
            padding: 0.65rem 1.25rem;
            border-radius: 14px;
            transition: all 0.25s ease;
            box-shadow: 0 8px 18px rgba(79, 70, 229, 0.32);
        }

        .btn-ver-todos:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(236, 72, 153, 0.38);
        }
    </style>

    <!-- TARJETAS SUPERIORES (KPIS) -->
    <div class="grid-cards">

        <!-- Artesanos -->
        <div class="kpi-card kpi-blue">
            <div class="kpi-header">
                <span>{{ __('panel.artesanos') }}</span>
                <svg style="width: 2rem; height: 2rem; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.22));" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p id="total-artesanos" class="kpi-number">{{ $totalArtesanos }}</p>
            <div class="kpi-footer">
                <span>↑ 2%</span> <span>vs mes anterior</span>
            </div>
        </div>

        <!-- Productos -->
        <div class="kpi-card kpi-green">
            <div class="kpi-header">
                <span>{{ __('panel.productos') }}</span>
                <svg style="width: 2rem; height: 2rem; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.22));" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <p id="total-productos" class="kpi-number">{{ $totalProductos }}</p>
            <div class="kpi-footer">
                <span>↑ 5%</span> <span>vs mes anterior</span>
            </div>
        </div>

        <!-- Usuarios -->
        <div class="kpi-card kpi-orange">
            <div class="kpi-header">
                <span>{{ __('panel.usuarios') }}</span>
                <svg style="width: 2rem; height: 2rem; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.22));" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <p id="total-usuarios" class="kpi-number">{{ $totalUsuarios }}</p>
            <div class="kpi-footer">
                <span>↑ 1%</span> <span>vs mes anterior</span>
            </div>
        </div>
    </div>

    <!-- GRÁFICOS -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">

        <div class="panel-card accent-indigo">
            <h3 class="panel-title">
                <span style="background: linear-gradient(135deg, #DBEAFE, #E0E7FF); padding: 8px; border-radius: 12px; color: #2563EB;">🏅</span>
                Artesanos por Especialidad
            </h3>
            <div style="position: relative; height: 280px; width: 100%; display: flex; justify-content: center;">
                <canvas id="graficoEspecialidades"></canvas>
            </div>
        </div>

        <div class="panel-card accent-gold">
            <h3 class="panel-title">
                <span style="background: linear-gradient(135deg, #FEF3C7, #FDE68A); padding: 8px; border-radius: 12px; color: #D97706;">🏆</span>
                Últimas Ventas (S/)
            </h3>
            <div style="position: relative; height: 280px; width: 100%;">
                <canvas id="graficoVentas"></canvas>
            </div>
        </div>
    </div>

    <!-- TABLA -->
    <div class="panel-card accent-award" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.45rem 1.55rem; border-bottom: 1px solid #DBEAFE; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(90deg, #EEF2FF 0%, #ECFDF5 55%, #FEF9C3 100%);">
            <h3 class="panel-title" style="margin: 0;">✨ {{ __('panel.ultimos_artesanos') }}</h3>
            <a href="{{ route('artesanos.index') }}" class="btn-ver-todos">
                {{ __('panel.ver_todos') }} &rarr;
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
                                <div style="width: 2.6rem; height: 2.6rem; border-radius: 50%; background: linear-gradient(135deg, #3B82F6, #EC4899); color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.92rem; box-shadow: 0 6px 14px rgba(59, 130, 246, 0.28);">
                                    {{ substr($artesano->nombres, 0, 1) }}
                                </div>
                                <div>
                                    <p style="font-weight: 800; color: #1B2559; margin: 0; font-size: 0.92rem;">{{ $artesano->nombres }} {{ $artesano->apellidos }}</p>
                                    <p style="font-size: 0.76rem; color: #64748B; margin: 0; font-weight: 600;">DNI: {{ $artesano->dni ?? 'No registrado' }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-specialty">{{ $artesano->especialidad }}</span>
                        </td>
                        <td style="font-size: 0.9rem; color: #1E293B; font-weight: 800;">{{ $artesano->telefono }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 2rem; text-align: center; color: #64748B;">
                            {{ __('panel.sin_registros') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPTS DE GRÁFICOS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.onload = function() {
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748B';

            // 1. GRÁFICO CIRCULAR
            var canvasGrafico = document.getElementById('graficoEspecialidades');
            if (canvasGrafico) {
                var ctx = canvasGrafico.getContext('2d');
                var labels = {!! json_encode($labelsGrafico ?? []) !!};
                var data = {!! json_encode($dataGrafico ?? []) !!};
                var backgroundColors = ['#2563EB', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899'];

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: backgroundColors,
                            borderWidth: 5,
                            borderColor: '#FFFFFF',
                            hoverOffset: 14
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 22,
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    font: { size: 12, weight: '700' }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#0F172A',
                                padding: 14,
                                cornerRadius: 12,
                            }
                        },
                        cutout: '70%'
                    }
                });
            }

            // 2. GRÁFICO DE BARRAS CON DEGRADADO VIVO
            var canvasVentas = document.getElementById('graficoVentas');
            if (canvasVentas) {
                var ctx2 = canvasVentas.getContext('2d');
                var labelsVentas = {!! json_encode($labelsVentas ?? []) !!};
                var dataVentas = {!! json_encode($dataVentas ?? []) !!};

                var gradient = ctx2.createLinearGradient(0, 0, 0, 280);
                gradient.addColorStop(0, '#F59E0B');
                gradient.addColorStop(0.5, '#EC4899');
                gradient.addColorStop(1, '#4F46E5');

                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: labelsVentas,
                        datasets: [{
                            label: 'Total (S/)',
                            data: dataVentas,
                            backgroundColor: gradient,
                            borderRadius: 12,
                            barThickness: 26
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { backgroundColor: '#0F172A', padding: 14, cornerRadius: 12 }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: { color: '#F1F5F9', drawBorder: false },
                                ticks: { font: { size: 11, weight: '700' }, callback: function(value) { return 'S/ ' + value; } }
                            },
                            x: {
                                grid: { display: false },
                                ticks: { font: { size: 11, weight: '700' } }
                            }
                        }
                    }
                });
            }

            // 3. SOCKET
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
