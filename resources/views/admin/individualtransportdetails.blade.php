@extends('admin.adminwelcome')
@section('title', '| Individual Transport Details')
@section('admincontent')
    <div class="container mx-auto mt-6 p-6 bg-slate-800 shadow-lg rounded-lg">


        @if(session('success'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const toast = document.getElementById('successToast');
                    if (toast) {
                        toast.classList.add('translate-x-full', 'opacity-0');
                        setTimeout(() => toast.remove(), 500); // remove after animation
                    }
                }, 3000);
            </script>
        @endif


        <div class="flex flex-col lg:flex-row gap-6">

            <div class=" bg-teal-800 p-6 rounded-lg shadow-md w-full lg:w-1/2">

                {{-- Transport Details --}}

                <h2 class="text-3xl font-semibold text-teal-300 border-b border-teal-600 pb-2 mb-4">Transport Provider
                    Details</h2>

                <table class="min-w-full border border-teal-600 text-left text-sm">
                    <tbody>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">Transport ID:</td>
                            <td class="text-white px-4">{{ $transportdetails->id }}</td>
                        </tr>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">Name:</td>
                            <td class="text-white px-4">{{ $transportdetails->name }}</td>
                        </tr>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">Entered by (Admin ID):</td>
                            <td class="text-white px-4">{{ $transportdetails->admin_id }}</td>
                        </tr>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">City:</td>
                            <td class="text-white px-4">{{ $transportdetails->city }}</td>
                        </tr>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">Availability:</td>
                            <td class="px-4">
                                <span
                                    class="px-2 py-1 rounded-md text-xs font-semibold {{ $transportdetails->availability ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-700' }}">
                                    {{ $transportdetails->availability ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                        </tr>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">Wheelchairs:</td>
                            <td class="text-white px-4">{{ $transportdetails->num_wheelchairs }}</td>
                        </tr>
                        <tr class="border-b border-teal-400">
                            <td class="font-medium py-2 px-4 text-teal-300">Caregivers:</td>
                            <td class="text-white px-4">{{ $transportdetails->num_caregivers }}</td>
                        </tr>
                        @if ($transportdetails->apiurl)
                            <tr>
                                <td class="font-medium py-2 px-4 text-teal-300">API URL:</td>
                                <td class="px-4">
                                    <a href="{{ $transportdetails->apiurl }}" target="_blank" class="text-blue-400 underline">
                                        {{ $transportdetails->apiurl }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>

            {{-- Edit Form --}}
            <div class="bg-teal-800 p-6 rounded-lg flex-1 w-full lg:w-1/2">
                <h3 class="text-2xl font-semibold text-teal-300 border-b pb-2 mb-4">Update Transport Provider</h3>
                <form action="{{ route('transport.update', $transportdetails->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-teal-300">Name</label>
                        <input type="text" name="name" value="{{ old('name', $transportdetails->name) }}" required
                            class="w-full  mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-teal-300">City</label>
                        <input type="text" name="city" value="{{ old('city', $transportdetails->city) }}" required
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-teal-300">Availability</label>
                        <select name="availability"
                            class="w-full mt-1 p-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="1" {{ $transportdetails->availability ? 'selected' : '' }}>Available
                            </option>
                            <option value="0" {{ !$transportdetails->availability ? 'selected' : '' }}>Unavailable
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-teal-300">Number of Wheelchairs</label>
                        <input type="number" name="num_wheelchairs"
                            value="{{ old('num_wheelchairs', $transportdetails->num_wheelchairs) }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-teal-300">Number of Caregivers</label>
                        <input type="number" name="num_caregivers"
                            value="{{ old('num_caregivers', $transportdetails->num_caregivers) }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-teal-300">API URL</label>
                        <input type="text" name="apiurl" value="{{ old('apiurl', $transportdetails->apiurl) }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-teal-300">Provider URL</label>
                        <input type="text" name="providerurl"
                            value="{{ old('providerurl', $transportdetails->providerurl) }}"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="text-right">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            Update Transport
                        </button>
                    </div>
                </form>
            </div>
        </div>




        {{-- showing the data from json response --}}
        <div class="container mx-auto p-6">
            <h2 class="text-3xl font-bold text-teal-300 mb-6 text-center">Available Transports</h2>

            @if(empty($transportdata))
                <p class="text-red-400 text-center bg-red-100 rounded p-3">No transport data available.</p>
            @else
                <div class="grid md:hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($transportdata as $transport)
                        <div class="bg-teal-700 text-teal-300 shadow-md rounded-lg p-6">
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
                        <tr class="bg-teal-700 text-teal-300">
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
                            <tr class="bg-teal-800 text-teal-300">
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['city'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['state'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['vehicle_type'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($transport['available'])
                                        ✅ Yes
                                    @else
                                        ❌ No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['num_seats'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($transport['has_wheelchair_access'])
                                        ✅ Yes
                                    @else
                                        ❌ No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">${{ number_format($transport['estimated_fare'], 2) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['eta_minutes'] }} mins</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $transport['contact_number'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <a href="{{ $transport['ride_link'] }}" class="text-teal-300 underline" target="_blank">Book</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>



@endsection