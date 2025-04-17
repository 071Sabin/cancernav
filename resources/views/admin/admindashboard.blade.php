@extends('admin.adminwelcome')
@php
    use Carbon\Carbon;
@endphp

@section('title', '| Dashboard')

@section('admincontent')

    <style>
        .custom-canvas {
            width: 250px;
            height: auto;
        }
    </style>
    <div class=" p-6 rounded-xl bg-teal-700 text-teal-300 my-10">
        <h2 class="font-bold text-xl lg:text-2xl mb-10">Admin Dashboard</h2>

        <div class="container mx-auto mt-5 p-4 bg-teal-800 rounded-lg">
            <h3 class="text-lg  font-semibold mb-4 text-white">Request Stats Overview</h3>
            <!-- Pie Chart Section -->
            @if(
                $pendingP2nRequestsCount > 0 ||
                $inProgressP2nRequestsCount > 0 ||
                $completedP2nRequestsCount > 0 ||
                $pendingN2aRequestsCount > 0 ||
                $inProgressN2aRequestsCount > 0 ||
                $completedN2aRequestsCount > 0
            )
                        <div class="p-4 rounded-lg flex flex-wrap flex-col lg:flex-row bg-white shadow-md w-full">

                            @if($pendingP2nRequestsCount > 0 || $inProgressP2nRequestsCount > 0 || $completedP2nRequestsCount > 0)
                                <!-- Pie chart for P2N -->
                                <div class="w-1/2 mx-auto custom-canvas">
                                    <h4 class="text-md font-semibold text-center text-teal-900">
                                        <a href="{{ route('showpatientrequests') }}" target="_blank" class="underline">Patient to
                                            Navigator</a>
                                    </h4>
                                    <canvas id="p2nPieChart"></canvas>
                                </div>
                            @endif

                            @if($pendingN2aRequestsCount > 0 || $inProgressN2aRequestsCount > 0 || $completedN2aRequestsCount > 0)
                                <!-- Pie chart for N2A -->
                                <div class="w-1/2 mx-auto custom-canvas">
                                    <h4 class="text-md font-semibold text-center text-teal-900">
                                        <a href="{{ route('shownavrequests') }}" target="_blank" class="underline">Navigator to Admin</a>
                                    </h4>
                                    <canvas id="n2aPieChart"></canvas>
                                </div>
                            @endif

                        </div>

            @else
                <p class="p-2 rounded bg-teal-900 text-white italic text-sm text-center">
                    There are no requests from patients or navigators!
                </p>
            @endif


        </div>

        <!-- Overdue High Priority Requests Section -->
        <div class="bg-teal-800 shadow rounded-lg p-4 mt-5">
            <h2 class="text-lg font-semibold text-white mb-4">Overdue High-Priority Requests <span class="text-xs">(more
                    than a day)</span></h2>

            <div class="flex flex-col md:flex-row gap-4">
                <!-- From Patients -->
                <div class="flex-1 bg-white p-4 rounded shadow">
                    <h3 class="text-sm font-semibold text-gray-700">Patients → Navigator</h3>
                    <hr class="my-2">
                    @if($overdueHighPriorityFromPatients > 0)
                        <p
                            class="text-3xl font-bold text-red-900 bg-red-100 w-fit px-3 py-1 rounded border-2 border-red-900 mt-2">
                            {{ $overdueHighPriorityFromPatients }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1">Pending for more than a day</p>
                        {{-- <a href="" class="inline-block mt-2 text-sm text-blue-700 hover:underline">View Details →</a> --}}
                    @else
                        <p class="text-md text-gray-600 mt-2">No critical overdue requests 🎉</p>
                    @endif
                </div>

                <!-- From Navigators -->
                <div class="flex-1 bg-white p-4 rounded shadow">
                    <h3 class="text-sm font-semibold text-gray-700">Navigators → Admin</h3>
                    <hr class="my-2">
                    @if($overdueHighPriorityFromNavigators > 0)
                        <p
                            class="text-3xl font-bold text-red-900 bg-red-100 w-fit px-3 py-1 rounded border-2 border-red-900 mt-2">
                            {{ $overdueHighPriorityFromNavigators }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1">Pending for more than a day</p>
                        {{-- <a href="{{ route('') }}" class="inline-block mt-2 text-sm text-blue-700 hover:underline">View
                        Details →</a> --}}
                    @else
                        <p class="text-md text-gray-600 mt-2">No critical overdue requests 🎉</p>
                    @endif
                </div>
            </div>
        </div>

    </div>










    {{-- pie chart script --}}

    <script>
        const p2nData = {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                label: 'Patient to Navigator',
                data: [{{ $pendingP2nRequestsCount }}, {{ $inProgressP2nRequestsCount }}, {{ $completedP2nRequestsCount }}],
                backgroundColor: ['#F59E0B', '#3B82F6', '#10B981'],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 20
            }]
        };

        // Pie chart data for N2A requests
        const n2aData = {
            labels: ['Pending', 'In Progress', 'Completed'],
            datasets: [{
                label: 'Navigator to Admin',
                data: [{{ $pendingN2aRequestsCount }}, {{ $inProgressN2aRequestsCount }}, {{ $completedN2aRequestsCount }}],
                backgroundColor: ['#F59E0B', '#3B82F6', '#10B981'],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 20
            }]
        };

        // Configuring the P2N Pie Chart
        const p2nConfig = {
            type: 'pie',
            data: p2nData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,  // This makes the legend items circular
                            pointStyle: 'circle', // Set the point style to circle
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    },
                    datalabels: {
                        display: true, // Display data labels
                        color: '#ffffff', // Text color for labels
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: function (value, context) {
                            return context.raw; // Display the count value inside the pie chart
                        }
                    }
                }
            }
        };

        // Configuring the N2A Pie Chart
        const n2aConfig = {
            type: 'pie',
            data: n2aData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,  // This makes the legend items circular
                            pointStyle: 'circle', // Set the point style to circle
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    },
                    datalabels: {
                        display: true, // Display data labels
                        color: '#ffffff', // Text color for labels
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: function (value, context) {
                            return context.raw; // Display the count value inside the pie chart
                        }
                    }
                }
            }
        };

        // Render the P2N Pie Chart
        var p2nCtx = document.getElementById('p2nPieChart').getContext('2d');
        new Chart(p2nCtx, p2nConfig);

        // Render the N2A Pie Chart
        var n2aCtx = document.getElementById('n2aPieChart').getContext('2d');
        new Chart(n2aCtx, n2aConfig);

    </script>




@endsection