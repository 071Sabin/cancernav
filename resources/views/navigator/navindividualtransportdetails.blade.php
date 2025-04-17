@extends('navigator.navwelcome')
@section('title', '| Transports')

@section('navigatorcontent')
    <div class="bg-slate-800 rounded p-2">
        <div class="h-fit w-full flex justify-center">
            <div class=" bg-slate-700 p-6 mt-10 shadow-lg rounded-lg  w-full lg:w-1/2 h-fit">

                {{-- Transport Details --}}

                <h2 class="text-3xl font-semibold text-slate-300 border-b border-slate-600 pb-2 mb-4">Transport Provider
                    Details</h2>

                <table class="min-w-full border border-slate-600 text-left text-sm mt-10">
                    <tbody>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">Transport ID:</td>
                            <td class="text-white px-4">{{ $transportdetails->id }}</td>
                        </tr>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">Name:</td>
                            <td class="text-white px-4">{{ $transportdetails->name }}</td>
                        </tr>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">Entered by (Admin ID):</td>
                            <td class="text-white px-4">{{ $transportdetails->admin_id }}</td>
                        </tr>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">City:</td>
                            <td class="text-white px-4">{{ $transportdetails->city }}</td>
                        </tr>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">Availability:</td>
                            <td class="px-4">
                                <span
                                    class="px-2 py-1 rounded-md text-xs font-semibold {{ $transportdetails->availability ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-700' }}">
                                    {{ $transportdetails->availability ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                        </tr>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">Wheelchairs:</td>
                            <td class="text-white px-4">{{ $transportdetails->num_wheelchairs }}</td>
                        </tr>
                        <tr class="border-b border-slate-400">
                            <td class="font-medium py-2 px-4 text-slate-300">Caregivers:</td>
                            <td class="text-white px-4">{{ $transportdetails->num_caregivers }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>



        {{-- showing the data from json response --}}
        <div class="container mt-5 mx-auto p-6">
            <h2 class="text-3xl font-bold text-slate-300 mb-6 text-center">Available Transports</h2>

            @if(empty($transportdata))
                <p class="text-red-400 text-center bg-red-100 rounded p-3">No transport data available.</p>
            @else
                <div class="grid md:hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($transportdata as $transport)
                        <div class="bg-slate-700 text-slate-300 shadow-md rounded-lg p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $transport['vehicle_type'] }} - {{ $transport['city'] }},
                                {{ $transport['state'] }}
                            </h3>

                            <p><strong>Availability:</strong>
                                <span class="{{ $transport['available'] ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $transport['available'] ? 'Available' : 'Not Available' }}
                                </span>
                            </p>

                            <p><strong>Seats:</strong> {{ $transport['num_seats'] }}</p>

                            <p><strong>Wheelchair Access:</strong>
                                <span class="{{ $transport['has_wheelchair_access'] ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $transport['has_wheelchair_access'] ? 'Yes' : 'No' }}
                                </span>
                            </p>

                            <p><strong>Estimated Fare:</strong> ${{ number_format($transport['estimated_fare'], 2) }}</p>
                            <p><strong>ETA:</strong> {{ $transport['eta_minutes'] }} minutes</p>

                            <p><strong>Special Features:</strong> {{ implode(', ', $transport['special_features']) }}</p>

                            <p><strong>Contact:</strong> {{ $transport['contact_number'] }}</p>

                            <div class="mt-4">
                                <a href="{{ $transport['ride_link'] }}" target="_blank"
                                    class="block bg-blue-500 text-white text-center py-2 rounded-md hover:bg-blue-600">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <table class="w-full hidden lg:block border-collapse">
                    <thead>
                        <tr class="bg-slate-700 text-slate-300">
                            <th class="border border-gray-400 px-4 py-2">City</th>
                            <th class="border border-gray-400 px-4 py-2">State</th>
                            <th class="border border-gray-400 px-4 py-2">Vehicle Type</th>
                            <th class="border border-gray-400 px-4 py-2">Availability</th>
                            <th class="border border-gray-400 px-4 py-2">Seats</th>
                            <th class="border border-gray-400 px-4 py-2">Wheelchair Access</th>
                            <th class="border border-gray-400 px-4 py-2">Estimated Fare</th>
                            <th class="border border-gray-400 px-4 py-2">ETA</th>
                            <th class="border border-gray-400 px-4 py-2">Contact</th>
                            <th class="border border-gray-400 px-4 py-2">Ride Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transportdata as $transport)
                            <tr class="bg-slate-800 text-slate-300">
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['city'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['state'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['vehicle_type'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($transport['available'])
                                        <i class="bi bi-check-lg text-green-500 text-xl"></i> Yes
                                    @else
                                        <i class="bi bi-x text-red-400 text-xl"></i> No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['num_seats'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($transport['has_wheelchair_access'])
                                        <i class="bi bi-check-lg text-green-500 text-xl"></i> Yes
                                    @else
                                        <i class="bi bi-x text-red-400 text-xl"></i> No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">${{ number_format($transport['estimated_fare'], 2) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['eta_minutes'] }} mins</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['contact_number'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <a href="{{ $transport['ride_link'] }}" class="text-slate-300 underline"
                                        target="_blank">Book</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection