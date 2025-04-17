@extends('admin.adminwelcome')
@section('title', '| Individual Housing')
{{-- @include('components.info-row') --}}


@section('admincontent')
    <div class="bg-slate-800 p-6 rounded-md">
        @if(session('error'))
            <p class="text-red-200 border-2 border-red-400 p-2 rounded-md mb-4 text-center bg-red-900/20">
                {{ session('error') }}
            </p>
        @endif

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

        <div class="flex flex-col md:flex-row gap-8 mx-auto mt-3 bg-gray-800 my-10 p-6 rounded-xl w-full">
            {{-- Flash Messages --}}

            <!-- Details Box (left side) -->
            <div class="bg-teal-700 rounded-2xl shadow-xl p-8 border border-teal-100 md:w-1/2 mx-auto">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-teal-300">Housing Provider Details</h2>

                <table class="w-full table-auto border-collapse text-left text-white text-sm">
                    <tbody>
                        <tr class="border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold w-1/3 text-teal-100">Housing ID</th>
                            <td class="py-2 px-4">{{ $housingdetails->id }}</td>
                        </tr>
                        <tr class="bg-teal-800/50 border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold text-teal-100">Name</th>
                            <td class="py-2 px-4">{{ $housingdetails->name }}</td>
                        </tr>
                        <tr class="border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold text-teal-100">State</th>
                            <td class="py-2 px-4">{{ $housingdetails->state }}</td>
                        </tr>
                        <tr class="bg-teal-800/50 border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold text-teal-100">City</th>
                            <td class="py-2 px-4">{{ $housingdetails->city }}</td>
                        </tr>
                        <tr class="border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold text-teal-100">Availability</th>
                            <td class="py-2 px-4">
                                <span
                                    class="inline-block px-3 py-1 rounded text-white text-xs font-medium {{ $housingdetails->availability ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $housingdetails->availability ? 'Available' : 'Unavailable' }}
                                </span>
                            </td>
                        </tr>
                        <tr class="bg-teal-800/50 border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold text-teal-100">Wheelchairs</th>
                            <td class="py-2 px-4">
                                <span
                                    class="inline-block px-3 py-1 rounded text-white text-xs font-medium {{ $housingdetails->has_wheelchair_access ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $housingdetails->has_wheelchair_access ? 'YES' : 'NO' }}
                                </span>
                            </td>
                        </tr>
                        <tr class="border-b border-teal-500">
                            <th class="py-2 px-4 font-semibold text-teal-100">Caregivers</th>
                            <td class="py-2 px-4">
                                <span
                                    class="inline-block px-3 py-1 rounded text-white text-xs font-medium {{ $housingdetails->has_caregiver_support ? 'bg-green-600' : 'bg-red-600' }}">
                                    {{ $housingdetails->has_caregiver_support ? 'YES' : 'NO' }}
                                </span>
                            </td>
                        </tr>
                        @if ($housingdetails->url)
                            <tr class="bg-teal-800/50">
                                <th class="py-2 px-4 font-semibold text-teal-100">API URL</th>
                                <td class="py-2 px-4 break-words">
                                    <a href="{{ $housingdetails->url }}" class="text-teal-200 hover:underline" target="_blank">
                                        {{ $housingdetails->url }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>




            <!-- Update Form (right side) -->
            <div class="bg-teal-700 rounded-2xl shadow-xl p-8 border border-gray-200 md:w-1/2">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-teal-300">Update Housing Details</h2>
                <form action="{{ route('updatehousing', $housingdetails->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-teal-300">Name</label>
                        <input type="text" id="name" name="name" required value="{{ $housingdetails->name }}"
                            class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 ">
                    </div>

                    <!-- City -->
                    <div class="mb-4">
                        <label for="city" class="block text-sm font-medium text-teal-300">City</label>
                        <input type="text" id="city" name="city" required value="{{ $housingdetails->city }}"
                            class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 ">
                    </div>

                    <!-- State -->
                    <div class="mb-4">
                        <label for="state" class="block text-sm font-medium text-teal-300">State</label>
                        <select id="state" name="state" required
                            class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 ">
                            <option value="AL">Alabama (AL)</option>
                            <option value="AK">Alaska (AK)</option>
                            <option value="AZ">Arizona (AZ)</option>
                            <option value="AR">Arkansas (AR)</option>
                            <option value="CA">California (CA)</option>
                            <option value="CO">Colorado (CO)</option>
                            <option value="CT">Connecticut (CT)</option>
                            <option value="DE">Delaware (DE)</option>
                            <option value="DC">District Of Columbia (DC)</option>
                            <option value="FL">Florida (FL)</option>
                            <option value="GA">Georgia (GA)</option>
                            <option value="HI">Hawaii (HI)</option>
                            <option value="ID">Idaho (ID)</option>
                            <option value="IL">Illinois (IL)</option>
                            <option value="IN">Indiana (IN)</option>
                            <option value="IA">Iowa (IA)</option>
                            <option value="KS">Kansas (KS)</option>
                            <option value="KY">Kentucky (KY)</option>
                            <option value="LA">Louisiana (LA)</option>
                            <option value="ME">Maine (ME)</option>
                            <option value="MD">Maryland (MD)</option>
                            <option value="MA">Massachusetts (MA)</option>
                            <option value="MI">Michigan (MI)</option>
                            <option value="MN">Minnesota (MN)</option>
                            <option value="MS">Mississippi (MS)</option>
                            <option value="MO">Missouri (MO)</option>
                            <option value="MT">Montana (MT)</option>
                            <option value="NE">Nebraska (NE)</option>
                            <option value="NV">Nevada (NV)</option>
                            <option value="NH">New Hampshire (NH)</option>
                            <option value="NJ">New Jersey (NJ)</option>
                            <option value="NM">New Mexico (NM)</option>
                            <option value="NY">New York (NY)</option>
                            <option value="NC">North Carolina (NC)</option>
                            <option value="ND">North Dakota (ND)</option>
                            <option value="OH">Ohio (OH)</option>
                            <option value="OK">Oklahoma (OK)</option>
                            <option value="OR">Oregon (OR)</option>
                            <option value="PA">Pennsylvania (PA)</option>
                            <option value="RI">Rhode Island (RI)</option>
                            <option value="SC">South Carolina (SC)</option>
                            <option value="SD">South Dakota (SD)</option>
                            <option value="TN">Tennessee (TN)</option>
                            <option value="TX">Texas (TX)</option>
                            <option value="UT">Utah (UT)</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select>
                    </div>

                    <!-- Availability -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-teal-300">Availability</label>
                        <select name="availability" class="w-full p-2 border rounded-md ">
                            <option value="1" {{ $housingdetails->availability ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ !$housingdetails->availability ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </div>

                    <!-- Wheelchair -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-teal-300">Wheelchair Access</label>
                        <select name="has_wheelchair_access" class="w-full p-2 border rounded-md">
                            <option value="1" {{ $housingdetails->has_wheelchair_access ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$housingdetails->has_wheelchair_access ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- Caregiver -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-teal-300">Caregiver Support</label>
                        <select name="has_caregiver_support" class="w-full p-2 border rounded-md ">
                            <option value="1" {{ $housingdetails->has_caregiver_support ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$housingdetails->has_caregiver_support ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <!-- URL -->
                    <div class="mb-4">
                        <label for="url" class="block text-sm font-medium text-teal-300">API URL</label>
                        <input type="text" id="url" name="url" value="{{ $housingdetails->url }}"
                            class="w-full p-2 border rounded-md">
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-800 hover:border-white hover:border text-white font-bold py-2 px-6 rounded-md shadow-md">
                            Update
                        </button>
                    </div>
                </form>
            </div>

        </div>



        {{-- DISPLAY HOUSING AVAILABLE FROM A PARTICULAR PROVIDER IN DETAIL WITH BOOKING LINK --}}
        <div class="container mx-auto p-6">
            <h2 class="text-3xl font-bold text-teal-300 mb-6 text-center">Available Housing</h2>

            @if(empty($housingdata))
                <p class="text-red-400 text-center">No housing data available.</p>
            @else
                <div class="grid md:hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($housingdata as $housing)
                        <div class="bg-teal-700 text-teal-300 shadow-md rounded-lg p-6">
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
                        <tr class="bg-teal-700 text-teal-300">
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
                            <tr class="bg-teal-800 text-teal-300">
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['city'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['state'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['available_rooms'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($housing['has_wheelchair_access'])
                                        ✅ Yes
                                    @else
                                        ❌ No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">
                                    @if ($housing['medical_support'])
                                        ✅ Yes
                                    @else
                                        ❌ No
                                    @endif
                                </td>
                                <td class="border border-gray-400 px-4 py-2">${{ number_format($housing['price_per_night($)'], 2) }}
                                </td>
                                <td class="border border-gray-400 px-4 py-2">{{ $housing['contact_number'] }}</td>
                                <td class="border border-gray-400 px-4 py-2">
                                    <a href="{{ $housing['housing_link'] }}" class="text-teal-300 underline"
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