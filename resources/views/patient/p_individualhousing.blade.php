@extends('patient.patientwelcome')

@section('title', '| Individual Housings')
@section('patientcontent')

    <div class="flex flex-col gap-8 mx-auto mt-3 bg-gray-100 my-10 p-6 rounded-xl w-full">
        {{-- Flash Messages --}}

        <!-- Details Box (left side) -->
        <div class=" rounded-2xl shadow-xl p-8 bg-white md:w-1/2 mx-auto">
            <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-gray-900">Housing Provider Details</h2>

            <table class="w-full table-auto border-collapse text-left text-sm">
                <tbody>
                    <tr class="border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold w-1/3 text-gray-900">Housing ID</th>
                        <td class="py-2 px-4">{{ $housingdetails->id }}</td>
                    </tr>
                    <tr class=" border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold text-gray-900">Name</th>
                        <td class="py-2 px-4">{{ $housingdetails->name }}</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold text-gray-900">State</th>
                        <td class="py-2 px-4">{{ $housingdetails->state }}</td>
                    </tr>
                    <tr class=" border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold text-gray-900">City</th>
                        <td class="py-2 px-4">{{ $housingdetails->city }}</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold text-gray-900">Availability</th>
                        <td class="py-2 px-4">
                            <span
                                class="inline-block px-3 py-1 rounded text-xs font-medium {{ $housingdetails->availability ? 'bg-green-100 text-green-800 border border-green-800' : 'bg-red-100 text-red-800 border border-red-800' }}">
                                {{ $housingdetails->availability ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                    </tr>
                    <tr class=" border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold text-gray-900">Wheelchairs</th>
                        <td class="py-2 px-4">
                            <span
                                class="inline-block px-3 py-1 rounded  text-xs font-medium {{ $housingdetails->has_wheelchair_access ? 'bg-green-100 text-green-800 border border-green-800' : 'bg-red-100 text-red-800 border border-red-800' }}">
                                {{ $housingdetails->has_wheelchair_access ? 'YES' : 'NO' }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <th class="py-2 px-4 font-semibold text-gray-900">Caregivers</th>
                        <td class="py-2 px-4">
                            <span
                                class="inline-block px-3 py-1 rounded  text-xs font-medium {{ $housingdetails->has_caregiver_support ? 'bg-green-100 text-green-800 border border-green-800' : 'bg-red-100 text-red-800 border border-red-800' }}">
                                {{ $housingdetails->has_caregiver_support ? 'YES' : 'NO' }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr class="bg-gray-800">

        {{-- DISPLAY HOUSING AVAILABLE FROM A PARTICULAR PROVIDER IN DETAIL WITH BOOKING LINK --}}
        <div class="container mx-auto p-6">
            <h2 class="text-3xl font-bold text-gray-900  text-center">Available Housing</h2>
            <p class="mb-10 text-center"><em class="text-gray-500 text-center">Click "Book" to book your preferable
                    housing!</em></p>
            @if(empty($housingdata))
                <p class="text-red-400 text-center">No housing data available.</p>
            @else
                <div class="grid md:hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($housingdata as $housing)
                        <div class="bg-slate-700 text-gray-200 shadow-md rounded-lg p-6">
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
                                    class="block bg-blue-500  text-center py-2 rounded-md hover:bg-blue-600">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <table class="w-full hidden lg:block border-collapse text-xs">
                    <thead>
                        <tr class="bg-slate-700 text-gray-200 uppercase">
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
                            <tr class="bg-white text-gray-900 text-center">
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
                                    <a href="{{ $housing['housing_link'] }}" class="text-gray-900 underline"
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