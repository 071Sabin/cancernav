@extends('patient.patientwelcome')
@section('title', '| Profile')

@section('patientcontent')
    {{-- instead of writing $currentdriverDetails->columnName, to access the current authenticated user details, pass the same thing from controller too the blade file using compact. --}}
    {{-- for this file, find the same thing in driverprofilecontroller.php --}}
    <div class="bg-gray-100 p-6 rounded-xl  my-10">
        <h1 class=" font-bold text-3xl">Patient Profile</h1>
        <p class="bg-orange-100 text-orange-800 border-orange-800 px-3 py-2 text-sm rounded border-2 mt-2">
            Please contact your Navigator to edit your email and other personal details.
        </p>

        {{-- show the current patient treatmend closed or still it's going on, if it's closed then when... --}}
        @if ($currentPatientDetails->treatment_closed === 1)
            <p class="bg-green-100 text-green-900 border-2 mt-2 border-green-900 rounded p-2">Your Treatment has been closed on
                {{ \Carbon\Carbon::parse($currentPatientDetails->treatment_closed_at)->format('F j, Y \a\t g:i A') }}
            </p>
        @endif

        {{-- if there are any error from withErrors() fn or validate() fn. --}}
        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-3 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif


        {{-- showing user details, user can edit their username --}}
        <div class="flex flex-col lg:w-2/3 shadow-xl bg-white rounded-xl w-full mx-auto p-6 mt-10">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Patient Details</h1>

            <!-- Profile Picture -->
            <div class="flex flex-col items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Profile Picture</h2>
                @if ($currentPatientDetails->profile_pic)
                    <img src="{{ route('image.show', $currentPatientDetails->profile_pic) }}" alt="Profile Picture"
                        class="rounded-full border-2 border-green-500 h-24 w-24 object-cover">
                @else
                    <i class="bi bi-person-circle text-5xl text-gray-400"></i>
                @endif
            </div>



            <!-- Details Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <tbody class="divide-y divide-gray-200">

                        <!-- Basic Information -->
                        <tr class="bg-gray-200 text-black font-semibold">
                            <td colspan="2" class="py-2">Basic Information</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Patient ID</td>
                            <td>{{ $currentPatientDetails->patientId }} ({{ $currentPatientDetails->id }})</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Case ID</td>
                            <td>{{ $currentPatientDetails->caseId }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Name</td>
                            <td>{{ $currentPatientDetails->name }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Gender</td>
                            <td>{{ ucfirst($currentPatientDetails->gender) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Date of Birth</td>
                            <td>{{ $currentPatientDetails->dateofbirth }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">SSN</td>
                            <td>{{ $currentPatientDetails->ssn }}</td>
                        </tr>

                        <!-- Medical Details -->
                        <tr class="bg-gray-200 text-black font-semibold">
                            <td colspan="2" class="py-2">Medical Details</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Doctor</td>
                            <td>{{ $currentPatientDetails->doctorname }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Hospital</td>
                            <td>{{ $currentPatientDetails->hospital->name }}
                                ({{ $currentPatientDetails->hospital->hospitalId }})</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Cancer Type</td>
                            <td>{{ $currentPatientDetails->cancer_type }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Treatment Stage</td>
                            <td>
                                {{  implode(', ', json_decode($currentPatientDetails->treatment_stage, true)) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Treatment Closed</td>
                            <td>
                                {{ $currentPatientDetails->treatment_closed
        ? 'Yes on ' . \Carbon\Carbon::parse($currentPatientDetails->treatment_closed_at)->format('F j, Y \a\t g:i A')
        : 'No'
                                                                    }}
                            </td>
                        </tr>

                        <!-- Contact Information -->
                        <tr class="bg-gray-200 text-black font-semibold">
                            <td colspan="2" class="py-2">Contact Information</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Email</td>
                            <td>{{ $currentPatientDetails->email }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Phone</td>
                            <td>{{ $currentPatientDetails->phone }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Address</td>
                            <td>{{ $currentPatientDetails->address }}, {{ $currentPatientDetails->city }},
                                {{ $currentPatientDetails->state }} - {{ $currentPatientDetails->zipcode }}
                            </td>
                        </tr>

                        <!-- Insurance Details -->
                        <tr class="bg-gray-200 text-black font-semibold">
                            <td colspan="2" class="py-2">Insurance Details</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Insurance Status</td>
                            <td>{{ $currentPatientDetails->insurance_status }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Insurance Provider</td>
                            <td>{{ $currentPatientDetails->insuranceProvider }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Insurance Policy Number</td>
                            <td>{{ $currentPatientDetails->insurance_policy_number }}</td>
                        </tr>

                        <!-- Financial Information -->
                        <tr class="bg-gray-200 text-black font-semibold">
                            <td colspan="2" class="py-2">Financial Information</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Employment Status</td>
                            <td>{{ $currentPatientDetails->employment_status }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Yearly Income</td>
                            <td>{{ $currentPatientDetails->yearly_income }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Income Source</td>
                            <td>{{ $currentPatientDetails->income_source }}</td>
                        </tr>

                        <!-- Emergency Contact -->
                        <tr class="bg-gray-200 text-black font-semibold">
                            <td colspan="2" class="py-2">Emergency Contact</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-medium">Emergency Contact</td>
                            <td>{{ $currentPatientDetails->emergency_contact }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <!-- Documents -->
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Uploaded Documents</h2>
                <div class="flex gap-8 flex-wrap">
                    <div class="text-center">
                        <h3 class="font-medium text-sm mb-1">Bank Statement</h3>
                        <img src="{{ route('image.show', $currentPatientDetails->bank_statements) }}" alt="Bank Statement"
                            class="h-24 w-24 object-cover border rounded">
                    </div>
                    <div class="text-center">
                        <h3 class="font-medium text-sm mb-1">Government ID</h3>
                        <img src="{{ route('image.show', $currentPatientDetails->government_id) }}" alt="Govt ID"
                            class="h-24 w-24 object-cover border rounded">
                    </div>
                </div>
            </div>
        </div>

        @if($currentPatientDetails?->navigator)

            <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10 overflow-x-auto">
                <h2 class="lg:text-2xl text-lg font-bold text-gray-800 mb-6 text-center">Your Navigator Profile</h2>

                <div class="flex justify-center mb-6">
                    @if($currentPatientDetails->navigator->profile_pic)
                        <img src="{{ route('image.show', $currentPatientDetails->navigator->profile_pic) }}" alt="Navigator Picture"
                            class="w-24 h-24 rounded-full border-2 border-teal-500 object-cover shadow">
                    @else
                        <i class="bi bi-person-circle text-6xl text-teal-500"></i>
                    @endif
                </div>

                <table class="min-w-full border border-gray-200 text-sm text-left text-gray-700">
                    <tbody>
                        <tr class="border-b">
                            <th class="bg-gray-100 px-4 py-3 font-medium w-1/3">Name</th>
                            <td class="px-4 py-3">{{ $currentPatientDetails->navigator->name }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="bg-gray-100 px-4 py-3 font-medium">Navigator ID</th>
                            <td class="px-4 py-3">
                                {{ $currentPatientDetails->navigator->id }}
                                ({{ $currentPatientDetails->navigator->navigatorId }})
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th class="bg-gray-100 px-4 py-3 font-medium">Email</th>
                            <td class="px-4 py-3">{{ $currentPatientDetails->navigator->email }}</td>
                        </tr>

                        <tr class="border-b">
                            <th class="bg-gray-100 px-4 py-3 font-medium">Phone</th>
                            <td class="px-4 py-3">{{ $currentPatientDetails->navigator->phone }}</td>
                        </tr>

                        <tr>
                            <th class="bg-gray-100 px-4 py-3 font-medium">Hospital</th>
                            <td class="px-4 py-3">
                                {{ $currentPatientDetails->navigator->hospital->name ?? 'N/A' }}
                                ({{ $currentPatientDetails->navigator->hospital->hospitalId ?? 'N/A' }})
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        @endif


    </div>
@endsection