@extends('admin.adminwelcome')

@section('title', '| Patient Records')

@section('admincontent')
    <style>
        td,
        th {
            padding: 0 10px;
        }
    </style>
    <div class="bg-teal-700 my-10 p-6 rounded-xl">
        <h2 class="text-2xl font-bold text-teal-300">Patient Records</h2>
        <p class="text-gray-200 text-sm"><em>Total Cancer Patients: {{ count($patients) }}</em></p>
        <em class="text-gray-300">Click on patient ID below to view full patient details</em>
        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        @if (count($patients) > 0)
            <div class="container mx-auto mt-5 p-4">

                <div class="overflow-x-auto bg-white shadow-md text-xs">
                    <table class="min-w-full border-collapse border border-teal-600">
                        <thead class="bg-slate-700 text-white uppercase">
                            <tr>
                                <th class="border border-teal-600 px-4 py-2">Patient ID</th>
                                <th class="border border-teal-600 px-4 py-2">Name</th>
                                <th class="border border-teal-600 px-4 py-2">Cancer Type</th>
                                <th class="border border-teal-600 px-4 py-2">Phone</th>
                                <th class="border border-teal-600 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr class="bg-teal-50 text-teal-800 text-center">
                                    <td class="border border-teal-600 px-4 py-2"><a
                                            href="{{ route('individualpatientdetails', $patient->id) }}"
                                            class="text-blue-600 underline hover:blue-700 font-semibold">{{ $patient->patientId }}</a>
                                    </td>
                                    <td class="border border-teal-600 px-4 py-2">{{ Str::title($patient->name) }}</td>
                                    <td class="border border-teal-600 px-4 py-2">{{ $patient->cancer_type }}</td>
                                    <td class="border border-teal-600 px-4 py-2">
                                        {{ $patient->phone }}
                                    </td>
                                    <td class="border border-teal-600 px-4 py-2 text-center">
                                        <button onclick="toggleRow('details-{{ $patient->patientId }}')"
                                            class="px-3 py-1 bg-teal-700 text-white rounded hover:bg-teal-800">
                                            View Details
                                        </button>
                                    </td>
                                </tr>

                                <!-- Collapsible Row -->
                                <tr id="details-{{ $patient->patientId }}" class="hidden bg-white">
                                    <td colspan="5" class="border border-teal-600 px-4 py-2 text-teal-700">
                                        <p><strong>Doctor Name:</strong> {{ Str::title($patient->doctorname) }}</p>
                                        <p><strong>Navigator Name:</strong> {{ Str::title($patient->navigator->name) }}</p>
                                        <p><strong>Navigator Contact:</strong> {{ Str::title($patient->navigator->phone) }}</p>
                                        <p><strong>Email:</strong> {{ $patient->email }}</p>
                                        <p><strong>Treatment Stage:</strong>
                                            {{ implode(', ', json_decode($patient->treatment_stage, true)) }}
                                            {{-- {{ dd($patient->treatment_stage) }} --}}
                                        </p>
                                        <p><strong>Address:</strong> {{ $patient->address }}, {{ $patient->city }},
                                            {{ $patient->state }} - {{ $patient->zipcode }}
                                        </p>
                                        <p><strong>Insurance Status:</strong> {{ $patient->insurance_status }}</p>
                                        <p><strong>Date Of Birth:</strong> {{ $patient->dateofbirth }}</p>
                                        <p><strong>Employment:</strong> {{ $patient->employment_status }} (Income:
                                            {{ $patient->yearly_income }})
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        @else
            <div class="mt-10">

                <p class="text-center rounded-md py-2 mt-2 text-sm bg-teal-600 text-white"><em>There are no any cancer
                        patients!<a href="{{ route('show_addpatient') }}"
                            class="font-semobold text-teal-800 underline font-semibold"> Add
                            New
                            Patient</a></em></p>
            </div>

        @endif
    </div>

    <script>
        function toggleRow(rowId) {
            var row = document.getElementById(rowId);
            row.classList.toggle("hidden");
        }
    </script>
@endsection