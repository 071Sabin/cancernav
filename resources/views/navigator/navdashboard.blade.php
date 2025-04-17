@extends('navigator.navwelcome')

@section('title', '| Dashboard')

@section('navigatorcontent')
    <style>
        .custom-canvas {
            width: 250px;
            height: auto;
        }
    </style>


    @if (count($navigatorbroadcastMesg) > 0)
        <div class="text-sm">
            @foreach ($navigatorbroadcastMesg as $dbm)
                @if ($dbm->broadcast_type == 'primary')
                    <div
                        class="bg-blue-100 mt-1 py-3 text-blue-800 rounded-md max-w-screen-xl flex flex-wrap justify-between mx-auto w-full p-4 flex-col">
                        <h1 class="font-bold">{{ $dbm->broadcast_title }}</h1>
                        <p class="ml-0 lg:ml-5">
                            {{ $dbm->message }}
                            <br>
                        </p>
                        @if ($dbm->linkname)
                            <p class=" rounded-lg px-2 py-1 text-blue-800 bg-blue-200 font-bold text-sm w-fit mt-1"><a target="_blank"
                                    href="{{ $dbm->link }}">{{ $dbm->linkname }}</a>
                            </p>
                        @endif
                    </div>
                @else
                    <div
                        class="bg-pink-100 mt-1 py-3 text-red-800 border border-red-900 rounded-md max-w-screen-xl flex flex-wrap justify-between mx-auto w-full p-4 flex-col">
                        <h1 class="font-bold">{{ $dbm->broadcast_title }}</h1>
                        <p class="ml-0 lg:ml-5">
                            {{ $dbm->message }}
                            <br>
                        </p>
                        @if ($dbm->linkname)
                            <p class="bg-red-200 rounded-lg px-2 py-1 text-red-700 font-bold text-sm w-fit mt-1"><a target="_blank"
                                    href="{{ $dbm->link }}">{{ $dbm->linkname }}</a>
                            </p>
                        @endif

                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <div class="bg-slate-800 rounded p-3  border-white border mt-10">

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        <div class="text-slate-300">
            <h2 class=" text-3xl font-bold mb-10"> Navigator Dashboard</h2>

            <div class="container mx-auto mt-5 p-4 bg-slate-700 rounded">
                <h3 class="text-lg  font-semibold mb-4">Request Stats Overview from Patients</h3>
                <!-- Pie Chart Section -->
                @if ($pendingP2nRequestsCount > 0 || $inProgressP2nRequestsCount > 0 || $completedP2nRequestsCount > 0)
                    <div class=" p-4 rounded-lg flex flex-wrap flex-col lg:flex-row shadow-md w-full bg-slate-600">

                        <!-- Pie chart for P2N -->
                        <div class="w-1/2 mx-auto custom-canvas">
                            <h4 class="text-md font-semibold text-center"><a href="{{ route('nav.patient_requests') }}"
                                    target="_blank" class="underline">
                                    Patient Request Stats
                                </a>
                            </h4>
                            <canvas id="p2nPieChart" class=""></canvas>
                        </div>
                    </div>
                @else
                    <p class="bg-slate-800 text-sm p-2 rounded mt-3 italic text-center">There is no any requests from your patients!
                    </p>
                @endif
            </div>

            <!-- Overdue High Priority Requests Section -->
            <div class="bg-slate-700 shadow rounded-lg p-4 mt-5">
                <h2 class="text-lg font-semibold mb-4">Overdue High-Priority Requests <span class="text-xs">(more than a
                        day)</span></h2>

                <div class="flex flex-col md:flex-row gap-4">
                    <!-- From Patients -->
                    <div class="flex-1 bg-slate-600 p-4 rounded shadow">
                        <h3 class="text-sm font-semibold">Patients → Navigator</h3>
                        <hr class="my-2">
                        @if($overdueHighPriorityFromPatients > 0)
                            <p
                                class="text-3xl font-bold text-red-900 bg-red-100 w-fit px-3 py-1 rounded border-2 border-red-900 mt-2">
                                {{ $overdueHighPriorityFromPatients }}
                            </p>
                            <p class="text-sm mt-1">Pending for more than a day</p>
                            {{-- <a href="" class="inline-block mt-2 text-sm text-blue-700 hover:underline">View Details →</a> --}}
                        @else
                            <p class="text-md mt-2">No critical overdue requests 🎉</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        // Pie chart data for P2N requests
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
                            boxWidth: 20,
                            color: '#cbd5e1',
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


    </script>



@endsection