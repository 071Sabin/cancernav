@extends('navigator.navwelcome')

@section('title', '| Individual Patient')

@section('navigatorcontent')
    <div class="container mx-auto mt-6 p-6 bg-slate-700 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-slate-300 mb-4">Patient Details</h2>

        <div class="flex flex-col md:flex-row items-center md:items-start space-x-6">
            <!-- Profile Picture -->
            <div
                class="w-40 h-40 flex items-center text-white justify-center rounded-full overflow-hidden border-4 dark:border-black dark:border-4 border-slate-500">

                <img src="{{ route('image.show', $individualpatientdetails->profile_pic) }}" alt="Profile Picture"
                    class="w-32 h-32 object-cover rounded-full">
            </div>



            <div class="overflow-x-auto">
                <table class="min-w-full border border-slate-600 border-collapse text-sm">
                    <tbody class="text-slate-300">
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Patient ID</th>
                            <td class="px-3 py-1 text-white">{{ $individualpatientdetails->patientId }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Case ID</th>
                            <td class="px-3 py-1 text-white">{{ $individualpatientdetails->caseId }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold underline">Patient Name</th>
                            <td class="px-3 py-1 text-white">{{ Str::title($individualpatientdetails->name) }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Doctor Name</th>
                            <td class="px-3 py-1 text-white">{{ Str::title($individualpatientdetails->doctorname) }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Gender</th>
                            <td class="px-3 py-1 text-white">{{ Str::upper($individualpatientdetails->gender) }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Date of Birth</th>
                            <td class="px-3 py-1 text-white">{{ $individualpatientdetails->dateofbirth }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">SSN</th>
                            <td class="px-3 py-1 text-white">{{ $individualpatientdetails->ssn }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Email</th>
                            <td class="px-3 py-1 text-white">{{ $individualpatientdetails->email }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Phone</th>
                            <td class="px-3 py-1 text-white">{{ $individualpatientdetails->phone }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="px-3 py-1 text-left font-semibold">Address</th>
                            <td class="px-3 py-1 text-white">
                                {{ $individualpatientdetails->address }},
                                {{ $individualpatientdetails->city }},
                                {{ $individualpatientdetails->state }} -
                                {{ $individualpatientdetails->zipcode }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>





        </div>

        <!-- Medical & Insurance Info -->
        <div class="mt-6 p-4 bg-slate-800 rounded-lg">
            <h3 class="text-2xl font-semibold text-slate-300 mb-3">Medical Information</h3>
            <table class="w-full lg:w-fit table-auto border border-slate-600 text-slate-300 text-xs lg:text-sm">
                <tbody>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Cancer Type</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->cancer_type }}</td>
                    </tr>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Treatment Stage</td>
                        <td class="py-2 px-3">
                            {{ implode(', ', json_decode($individualpatientdetails->treatment_stage, true)) }}
                        </td>
                    </tr>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Insurance Status</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->insurance_status }}</td>
                    </tr>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Insurance Provider</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->insuranceProvider }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Policy Number</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->insurance_policy_number }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Employment & Financial Info -->
        <div class="mt-6 p-4 bg-slate-800 rounded-lg">
            <h3 class="text-2xl font-semibold text-slate-300 mb-3">Financial & Employment</h3>
            <table class="w-full lg:w-fit table-auto border border-slate-600 text-slate-300 text-xs lg:text-sm">
                <tbody>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Employment Status</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->employment_status }}</td>
                    </tr>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Yearly Income</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->yearly_income }}</td>
                    </tr>
                    <tr class="border-b border-slate-600">
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Income Source</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->income_source }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3 font-semibold border-r border-slate-600">Emergency Contact</td>
                        <td class="py-2 px-3">{{ $individualpatientdetails->emergency_contact }}</td>
                    </tr>
                </tbody>
            </table>

        </div>

        <!-- Secure Documents -->
        <div class="mt-6 p-4 bg-slate-800 rounded-lg">
            <h3 class="text-2xl font-semibold text-slate-300 mb-3">Secure Documents</h3>

            <div class="flex lg:flex-row flex-col justify-around">

                <!-- Bank Statement -->
                <div class="mb-4">
                    <p class="text-slate-300 font-semibold">Bank Statement:</p>
                    <div class="w-full md:w-96 border-2 border-slate-500 text-white rounded-lg overflow-hidden">
                        <img src="{{ route('image.show', $individualpatientdetails->bank_statements) }}"
                            alt="Profile Picture">
                    </div>
                </div>

                <!-- Government ID -->
                <div>
                    <p class="text-slate-300 font-semibold">Government ID:</p>
                    <div class="w-full md:w-96 border-2 border-slate-500 rounded-lg text-white overflow-hidden">
                        <img src="{{ route('image.show', $individualpatientdetails->government_id) }}"
                            alt="Profile Picture">
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- form to update patient details --}}

    <div class="w-full lg:w-2/4 mx-auto bg-slate-700 text-slate-300 my-6 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit Patient Details</h2>

        @if(session('updatesuccess'))
            <div class="p-4 mb-4 text-green-900 bg-green-100 rounded">
                {{ session('updatesuccess') }}
            </div>
        @endif

        <form action="{{ route('nav.patients.update', $individualpatientdetails->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $individualpatientdetails->name) }}"
                    class="w-full border rounded p-2 text-black">
            </div>

            <!-- Email -->
            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $individualpatientdetails->email) }}"
                    class="w-full border rounded p-2 text-black">
            </div>

            <!-- Password -->
            <div>
                <label class="block font-medium">Password</label>
                <input type="password" name="password" value="" class="w-full border rounded p-2 text-black">
            </div>

            <!-- Doctor Name -->
            <div>
                <label class="block font-medium">Doctor Name</label>
                <input type="text" name="doctorname" value="{{ old('name', $individualpatientdetails->doctorname) }}"
                    class="w-full border rounded p-2 text-black">
            </div>

            <!-- Gender -->
            <div>
                <label class="block font-medium">Gender</label>
                <select name="gender" class="w-full border rounded p-2 text-black">
                    <option value="M" {{ $individualpatientdetails->gender == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ $individualpatientdetails->gender == 'F' ? 'selected' : '' }}>Female
                    </option>
                    <option value="O" {{ $individualpatientdetails->gender == 'O' ? 'selected' : '' }}>Other
                    </option>
                </select>
            </div>

            <!-- Date of Birth -->
            <div>
                <label class="block font-medium">Date of Birth</label>
                <input type="date" name="dateofbirth"
                    value="{{ old('dateofbirth', $individualpatientdetails->dateofbirth) }}"
                    class="w-full border rounded p-2 text-black">
            </div>

            <!-- Phone -->
            <div>
                <label class="block font-medium">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $individualpatientdetails->phone) }}"
                    class="w-full border rounded p-2 text-black">
            </div>

            <!-- Address -->
            <div>
                <label class="block font-medium">Address</label>
                <input type="text" name="address" value="{{ old('address', $individualpatientdetails->address) }}"
                    class="w-full border rounded p-2 text-black">
            </div>

            <!-- Profile Picture -->
            <div>
                <label class="block font-medium">Profile Picture</label>
                <input type="file" name="profile_pic" class="w-full border rounded p-2">
                @if($individualpatientdetails->profile_pic)
                    <img src="{{ route('image.show', $individualpatientdetails->profile_pic) }}"
                        class="mt-2 w-24 h-24 object-cover rounded-full">
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
@endsection