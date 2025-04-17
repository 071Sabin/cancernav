@extends('admin.adminwelcome')
@section('title', '| Individual Navigator')
@section('admincontent')
    <div class="bg-gray-800 my-10 p-6 rounded-xl">

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
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

        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Left: Navigator Details --}}
                <div class="bg-teal-700 rounded-2xl shadow-lg p-6 md:flex md:space-x-8">
                    <!-- Profile Picture -->
                    <div class="flex-shrink-0 flex justify-center md:justify-start">
                        @if($individualnavdetails->profile_pic)
                            <img src="{{ route('image.show', $individualnavdetails->profile_pic) }}" alt="Navigator Profile"
                                class="w-32 h-32 object-cover rounded-full border-4 border-teal-500 shadow">
                        @else
                            <div
                                class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                                No Image
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->

                    <div class="overflow-x-auto mt-6 md:mt-0 text-teal-300 w-full">
                        <h2 class="text-2xl font-bold mb-4 border-b pb-2">Navigator Details</h2>
                        <table class="min-w-full border border-teal-600 border-collapse text-sm">
                            <tbody>
                                <tr class="border border-teal-600">
                                    <th class="text-left font-semibold px-3 py-1">Navigator ID</th>
                                    <td class="text-white px-3 py-1">{{ $individualnavdetails->navigatorId }}
                                        ({{ $individualnavdetails->id }})</td>
                                </tr>
                                <tr class="border border-teal-600">
                                    <th class="text-left font-semibold px-3 py-1">Hospital</th>
                                    <td class="text-white px-3 py-1">
                                        {{ $individualnavdetails->hospital->name }}
                                        ({{ $individualnavdetails->hospital->hospitalId }})
                                    </td>
                                </tr>
                                <tr class="border border-teal-600">
                                    <th class="text-left font-semibold px-3 py-1">Name</th>
                                    <td class="text-white px-3 py-1">{{ $individualnavdetails->name }}</td>
                                </tr>
                                <tr class="border border-teal-600">
                                    <th class="text-left font-semibold px-3 py-1">Email</th>
                                    <td class="text-white px-3 py-1">{{ $individualnavdetails->email }}</td>
                                </tr>
                                <tr class="border border-teal-600">
                                    <th class="text-left font-semibold px-3 py-1">Phone</th>
                                    <td class="text-white px-3 py-1">{{ $individualnavdetails->phone }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


                {{-- Right: Update Form --}}
                <div class="bg-teal-700 text-teal-300 rounded-xl shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-4 border-b pb-2">Update Navigator Details</h2>
                    <form action="{{ route('navigator.update', $individualnavdetails->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-teal-300">Name</label>
                            <input type="text" name="name" value="{{ old('name', $individualnavdetails->name) }}"
                                class="w-full p-2 border text-black border-teal-300 rounded-md focus:outline-none focus:ring focus:ring-teal-300">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-teal-300">Email</label>
                            <input type="email" name="email" value="{{ old('email', $individualnavdetails->email) }}"
                                class="w-full p-2 border text-black border-teal-300 rounded-md focus:outline-none focus:ring focus:ring-teal-300">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-teal-300">Password</label>
                            <input type="password" name="password" value=""
                                class="w-full p-2 border text-black border-teal-300 rounded-md focus:outline-none focus:ring focus:ring-teal-300">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-teal-300">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $individualnavdetails->phone) }}"
                                class="w-full p-2 border text-black border-teal-300 rounded-md focus:outline-none focus:ring focus:ring-teal-300">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-teal-300">Profile Picture</label>
                            <input type="file" name="profile_pic"
                                class="w-full p-2 border border-teal-300 rounded-md text-teal-800 bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-100 file:text-teal-700 hover:file:bg-teal-200">
                        </div>

                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                            Update
                        </button>
                    </form>
                </div>
            </div>
            <hr class="my-10">
            <div class="text-teal-300">
                <h2 class="text-center font-bold text-xl">Patients under this navigator</h2>

                <div class="text-gray-300 text-center text-sm italic">
                    <p>Click on blue colored patient ID to view their full details</p>
                    <p>
                        Total Patients for this Navigator: {{ count($individualnavdetails->patients) }}
                    </p>
                </div>
                <div class="overflow-x-auto mt-10">
                    <table class="min-w-full bg-white border rounded-lg shadow text-xs">
                        <thead class="bg-teal-600 text-white uppercase">
                            <tr>
                                <th class="text-left py-2 px-4">Name</th>
                                <th class="text-left py-2 px-4">Patient ID</th>
                                <th class="text-left py-2 px-4">Gender</th>
                                <th class="text-left py-2 px-4">Cancer Type</th>
                                <th class="text-left py-2 px-4">Email</th>
                                <th class="text-left py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach($individualnavdetails->patients as $patient)
                                <tr class="border-b">
                                    <td class="py-2 px-4">{{ $patient->name }}</td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('individualpatientdetails', $patient->id) }}" target="_blank"
                                            class="text-blue-600 underline font-bold">
                                            {{ $patient->patientId }}
                                        </a>
                                    </td>
                                    <td class="py-2 px-4">{{ ucfirst($patient->gender) }}</td>
                                    <td class="py-2 px-4">{{ $patient->cancer_type }}</td>
                                    <td class="py-2 px-4">{{ $patient->email }}</td>
                                    <td class="py-2 px-4">
                                        <button type="button"
                                            class="toggle-details text-white p-1 rounded bg-teal-700 hover:underline"
                                            data-target="#details-{{ $patient->id }}">
                                            See Details
                                        </button>
                                    </td>
                                </tr>

                                <!-- Collapsible Row -->
                                <tr id="details-{{ $patient->id }}" class="hidden bg-gray-50">
                                    <td colspan="6" class="py-4 px-6 border-b">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                            <div><strong>Phone:</strong> {{ $patient->phone }}</div>
                                            <div><strong>Date of Birth:</strong> {{ $patient->dateofbirth }}</div>
                                            <div><strong>Address:</strong> {{ $patient->address }}, {{ $patient->city }},
                                                {{ $patient->state }} - {{ $patient->zipcode }}
                                            </div>
                                            <div><strong>Doctor Name:</strong> {{ $patient->doctorname }}</div>
                                            <div><strong>Employment Status:</strong> {{ $patient->employment_status }}</div>
                                            <div><strong>Insurance:</strong> {{ $patient->insurance_status }}
                                                ({{ $patient->insuranceProvider }})</div>
                                            <div><strong>Treatment Stage:</strong>
                                                {{ is_array($patient->treatment_stage) ? implode(', ', $patient->treatment_stage) : 'N/A' }}
                                            </div>
                                            <div><strong>Treatment Closed:</strong>
                                                {{ $patient->treatment_closed ? 'Yes' : 'No' }}</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script>
                    document.querySelectorAll('.toggle-details').forEach(button => {
                        button.addEventListener('click', () => {
                            const targetId = button.getAttribute('data-target');
                            const target = document.querySelector(targetId);
                            if (target) target.classList.toggle('hidden');
                        });
                    });
                </script>

            </div>
        </div>



@endsection