@extends('navigator.navwelcome')

@section('title', '| Individual Housing')

@section('navigatorcontent')

    <div class="flex flex-col gap-8 mx-auto mt-3 bg-gray-800 my-10 p-6 rounded-xl w-full">
        {{-- Flash Messages --}}

        <!-- Details Box (left side) -->
        <div class="bg-slate-700 rounded-2xl shadow-xl p-8 border border-slate-100 md:w-1/2 mx-auto">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-slate-300">Housing Provider Details</h2>

            <table class="w-full table-auto border-collapse text-left text-white text-sm">
                <tbody>
                    <tr class="border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold w-1/3 text-slate-100">Housing ID</th>
                        <td class="py-2 px-4">{{ $housingdetails->id }}</td>
                    </tr>
                    <tr class="bg-slate-800/50 border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold text-slate-100">Name</th>
                        <td class="py-2 px-4">{{ $housingdetails->name }}</td>
                    </tr>
                    <tr class="border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold text-slate-100">State</th>
                        <td class="py-2 px-4">{{ $housingdetails->state }}</td>
                    </tr>
                    <tr class="bg-slate-800/50 border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold text-slate-100">City</th>
                        <td class="py-2 px-4">{{ $housingdetails->city }}</td>
                    </tr>
                    <tr class="border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold text-slate-100">Availability</th>
                        <td class="py-2 px-4">
                            <span
                                class="inline-block px-3 py-1 rounded text-white text-xs font-medium {{ $housingdetails->availability ? 'bg-green-600' : 'bg-red-600' }}">
                                {{ $housingdetails->availability ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="bg-slate-800/50 border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold text-slate-100">Wheelchairs</th>
                        <td class="py-2 px-4">
                            <span
                                class="inline-block px-3 py-1 rounded text-white text-xs font-medium {{ $housingdetails->has_wheelchair_access ? 'bg-green-600' : 'bg-red-600' }}">
                                {{ $housingdetails->has_wheelchair_access ? 'YES' : 'NO' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b border-slate-500">
                        <th class="py-2 px-4 font-semibold text-slate-100">Caregivers</th>
                        <td class="py-2 px-4">
                            <span
                                class="inline-block px-3 py-1 rounded text-white text-xs font-medium {{ $housingdetails->has_caregiver_support ? 'bg-green-600' : 'bg-red-600' }}">
                                {{ $housingdetails->has_caregiver_support ? 'YES' : 'NO' }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- DISPLAY HOUSING AVAILABLE FROM A PARTICULAR PROVIDER IN DETAIL WITH BOOKING LINK --}}
        <div class="container mx-auto p-6">
            <h2 class="text-3xl font-bold text-slate-300 mb-6 text-center">Available Housing</h2>

            @if(empty($housingdata))
                <p class="text-red-400 text-center">No housing data available.</p>
            @else
                <div class="grid md:hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($housingdata as $housing)
                        <div class="bg-slate-700 text-slate-300 shadow-md rounded-lg p-6">
                            <h3 class="text-xl underline font-semibold mb-2">{{ $housing['city'] }},
                                {{ $housing['state'] }}
                            </h3>
                            <p><strong>Rooms Available:</strong> {{ $housing['available_rooms'] }}</p>
                            <p><strong>Wheelchair Access:</strong>
                                <span class="{{ $housing['has_wheelchair_access'] ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $housing['has_wheelchair_access'] ? 'Yes' : 'No' }}
                                </span>
                            </p>
                            <p><strong>Medical Support:</strong>
                                <span class="{{ $housing['medical_support'] ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $housing['medical_support'] ? 'Yes' : 'No' }}
                                </span>
                            </p>
                            <p><strong>Price per Night:</strong> ${{ number_format($housing['price_per_night($)'], 2) }}</p>
                            <p><strong>Check-in/out:</strong> {{ $housing['check_in_out_times'] }}</p>
                            <p><strong>Amenities:</strong> {{ implode(', ', $housing['amenities']) }}</p>
                            <p><strong>Distance to Hospital:</strong> {{ $housing['hospital_proximity_km'] }} km</p>
                            <p><strong>Contact:</strong> {{ $housing['contact_number'] }}</p>

                            <div class="mt-4">
                                <a href="{{ $housing['housing_link'] }}" target="_blank"
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
                            <th class="border border-gray-400 px-4 py-2">Available Rooms</th>
                            <th class="border border-gray-400 px-4 py-2">Wheelchair Access</th>
                            <th class="border border-gray-400 px-4 py-2">Medical Support</th>
                            <th class="border border-gray-400 px-4 py-2">Price Per Night</th>
                            <th class="border border-gray-400 px-4 py-2">Contact</th>
                            <th class="border border-gray-400 px-4 py-2">Housing Link</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($housingdata as $housing)
                            <tr class="bg-slate-800 text-slate-300 text-center text-sm">
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['city'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['state'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['available_rooms'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($housing['has_wheelchair_access'])
                                        <i class="bi bi-check-lg text-green-500 text-xl"></i> Yes
                                    @else
                                        <i class="bi bi-x text-red-400 text-xl"></i> No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($housing['medical_support'])
                                        <i class="bi bi-check-lg text-green-500 text-xl"></i> Yes
                                    @else
                                        <i class="bi bi-x text-red-400 text-xl"></i> No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">${{ number_format($housing['price_per_night($)'], 2) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['contact_number'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <a href="{{ $housing['housing_link'] }}" class="text-slate-300 underline"
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