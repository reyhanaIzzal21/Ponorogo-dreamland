@extends('admin.layouts.app')

@section('style')
    <style>
        /* Custom Scrollbar for Tables */
        .hide-scroll::-webkit-scrollbar {
            display: none;
        }

        .hide-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Card Hover Effect */
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="p-4 md:p-6 bg-gray-50 min-h-screen">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
                <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, Admin! Berikut ringkasan hari ini.</p>
            </div>
            <div
                class="flex items-center gap-2 bg-white px-4 py-2 rounded-lg border border-gray-200 text-sm font-medium text-gray-600 shadow-sm">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ now()->format('d F Y') }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="stat-card bg-white p-6 rounded-2xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Visitors</p>
                        <h3 class="text-2xl font-bold text-gray-800">1,248</h3>
                        <p class="text-xs text-green-500 font-bold mt-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            +12.5% Hari Ini
                        </p>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Need Confirmation</p>
                        <h3 class="text-2xl font-bold text-gray-800">8</h3>
                        <p class="text-xs text-yellow-600 font-bold mt-2 flex items-center gap-1">
                            Reservasi Baru
                        </p>
                    </div>
                    <div class="p-3 bg-yellow-50 rounded-xl text-yellow-600 animate-pulse">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">WhatsApp Failed</p>
                        <h3 class="text-2xl font-bold text-red-600">3</h3>
                        <p class="text-xs text-gray-400 mt-2">Pesan gagal terkirim</p>
                    </div>
                    <div class="p-3 bg-red-50 rounded-xl text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl border border-gray-200 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Active Menu</p>
                        <h3 class="text-2xl font-bold text-gray-800">42</h3>
                        <p class="text-xs text-gray-400 mt-2">Item di Dam Cokro</p>
                    </div>
                    <div class="p-3 bg-green-50 rounded-xl text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex flex-col lg:flex-row gap-6 mb-8">

            <div class="w-full lg:w-[70%] bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Analitik Trafik & Reservasi</h2>
                        <p class="text-xs text-gray-500">Perbandingan pengunjung website vs konversi reservasi (7 Hari).</p>
                    </div>
                    <select
                        class="text-xs border-gray-300 rounded-lg text-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                        <option>7 Hari Terakhir</option>
                        <option>30 Hari Terakhir</option>
                    </select>
                </div>
                <div id="trafficChart" class="w-full h-80"></div>
            </div>

            <div class="w-full lg:w-[30%] bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Distribusi Booking</h2>
                <p class="text-xs text-gray-500 mb-6">Persentase pilihan venue.</p>

                <div id="distributionChart" class="flex-1 flex items-center justify-center"></div>

                <div class="mt-4 grid grid-cols-2 gap-2 text-center">
                    <div class="p-2 bg-green-50 rounded-lg">
                        <span class="block text-xs text-gray-500">Resto</span>
                        <span class="block font-bold text-green-700">65%</span>
                    </div>
                    <div class="p-2 bg-orange-50 rounded-lg">
                        <span class="block text-xs text-gray-500">Pendopo</span>
                        <span class="block font-bold text-orange-700">35%</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-800">Reservasi Terbaru</h2>
                    <a href="/admin/reservations" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua
                        →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                            <tr>
                                <th class="px-6 py-3 font-bold">Nama / Venue</th>
                                <th class="px-6 py-3 font-bold">Waktu</th>
                                <th class="px-6 py-3 font-bold text-center">WA Status</th>
                                <th class="px-6 py-3 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">
                                    <p class="font-bold text-gray-800">Budi Santoso</p>
                                    <span
                                        class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded font-bold">RESTO</span>
                                </td>
                                <td class="px-6 py-3 text-gray-500">
                                    29 Jan, 19:00
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full border border-red-100">
                                        ⚠ Failed
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <button
                                        class="text-xs bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700 transition">
                                        Resend WA
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">
                                    <p class="font-bold text-gray-800">Siti Aminah</p>
                                    <span
                                        class="text-[10px] bg-orange-100 text-orange-700 px-1.5 py-0.5 rounded font-bold">PENDOPO</span>
                                </td>
                                <td class="px-6 py-3 text-gray-500">
                                    10 Feb, 09:00
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full border border-green-100">
                                        ✓ Sent
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <button
                                        class="text-xs text-gray-500 hover:text-indigo-600 border border-gray-200 px-3 py-1.5 rounded hover:bg-gray-50 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-3">
                                    <p class="font-bold text-gray-800">Andi P.</p>
                                    <span
                                        class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded font-bold">RESTO</span>
                                </td>
                                <td class="px-6 py-3 text-gray-500">
                                    29 Jan, 12:00
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <span
                                        class="inline-flex items-center gap-1 text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full border border-green-100">
                                        ✓ Sent
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <button
                                        class="text-xs text-gray-500 hover:text-indigo-600 border border-gray-200 px-3 py-1.5 rounded hover:bg-gray-50 transition">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="lg:col-span-1 bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h2 class="text-lg font-bold text-gray-800">Aktivitas Terakhir</h2>
                    <p class="text-xs text-gray-500">Log perubahan konten & sistem.</p>
                </div>

                <div class="space-y-6 relative border-l-2 border-gray-100 ml-2">
                    <div class="pl-6 relative">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-blue-500 rounded-full border-2 border-white">
                        </div>
                        <p class="text-sm font-bold text-gray-800">Update Hero Landing Page</p>
                        <p class="text-xs text-gray-500 mt-0.5">Admin Utomo • 10 Menit lalu</p>
                    </div>
                    <div class="pl-6 relative">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-yellow-500 rounded-full border-2 border-white">
                        </div>
                        <p class="text-sm font-bold text-gray-800">Tambah Menu Baru "Sate"</p>
                        <p class="text-xs text-gray-500 mt-0.5">Admin Resto • 2 Jam lalu</p>
                    </div>
                    <div class="pl-6 relative">
                        <div class="absolute -left-[9px] top-1 w-4 h-4 bg-gray-300 rounded-full border-2 border-white">
                        </div>
                        <p class="text-sm font-bold text-gray-800">Ganti Password</p>
                        <p class="text-xs text-gray-500 mt-0.5">System • 1 Hari lalu</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        // 1. LINE CHART: Visitors vs Reservations
        var trafficOptions = {
            series: [{
                name: 'Website Visitors',
                data: [120, 200, 150, 80, 70, 110, 150]
            }, {
                name: 'Reservations',
                data: [12, 25, 18, 9, 8, 15, 20]
            }],
            chart: {
                type: 'area',
                height: 320,
                toolbar: {
                    show: false
                },
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#4F46E5', '#10B981'], // Indigo & Emerald
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: false
            },
            grid: {
                borderColor: '#F3F4F6',
                strokeDashArray: 4,
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right'
            }
        };

        var trafficChart = new ApexCharts(document.querySelector("#trafficChart"), trafficOptions);
        trafficChart.render();


        // 2. PIE CHART: Distribution
        var distOptions = {
            series: [65, 35], // Resto vs Pendopo
            labels: ['Dam Cokro Resto', 'Pendopo Ageng'],
            chart: {
                type: 'donut',
                height: 250,
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#10B981', '#F59E0B'], // Green & Orange
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function(w) {
                                    return w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            }, // Custom legend used in HTML
            stroke: {
                show: false
            }
        };

        var distChart = new ApexCharts(document.querySelector("#distributionChart"), distOptions);
        distChart.render();
    </script>
@endsection
