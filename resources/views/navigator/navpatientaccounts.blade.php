@extends('navigator.navwelcome')

@section('title', '| Patient Records')

@section('navigatorcontent')
    <style>
        td,
        th {
            padding: 0 10px;
        }
    </style>
    <div class="bg-slate-700 my-10 p-6 rounded-xl">
        <h2 class="text-2xl font-bold text-slate-300">Patient Records</h2>
        <em class="text-slate-400">Patients you added or are assigned to you by admin appears here</em>
        <p class="text-gray-200 text-sm"><em>Total Cancer Patients: {{ count($patients) }}</em></p>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        @if (count($patients) > 0)
            <div class="container mx-auto mt-5 p-4">

                <div class="overflow-x-auto w-full bg-white shadow-md text-sm">
                    <table class="w-full border-collapse border border-slate-300 text-xs">
                        <thead class="bg-slate-800 text-white uppercase">
                            <tr>
                                <th class="border border-slate-600 px-4 py-2">Patient ID</th>
                                <th class="border border-slate-600 px-4 py-2">Name</th>
                                <th class="border border-slate-600 px-4 py-2">Cancer Type</th>
                                <th class="border border-slate-600 px-4 py-2">Phone</th>
                                <th class="border border-slate-600 px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr class="bg-slate-50 text-slate-800 text-center">
                                    <td class="border border-slate-600 px-4 py-2"><a
                                            href="{{ route('nav.individualpatientdetails', $patient->id) }}"
                                            class="text-blue-600 underline hover:blue-700 font-semibold">{{ $patient->patientId }}</a>
                                    </td>
                                    <td class="border border-slate-600 px-4 py-2">{{ Str::title($patient->name) }}</td>
                                    <td class="border border-slate-600 px-4 py-2">{{ $patient->cancer_type }}</td>
                                    <td class="border border-slate-600 px-4 py-2">
                                        {{ $patient->phone }}
                                    </td>
                                    <td class="border border-slate-600 px-4 py-2 text-center">
                                        <button onclick="toggleRow('details-{{ $patient->patientId }}')"
                                            class="px-3 py-1 bg-slate-800 text-white rounded hover:bg-slate-700">
                                            View Details
                                        </button>
                                    </td>
                                </tr>

                                <!-- Collapsible Row -->
                                <tr id="details-{{ $patient->patientId }}" class="hidden bg-white">
                                    <td colspan="5" class="border border-slate-600 px-4 py-2 text-slate-700">
                                        <p><strong>Doctor Name:</strong> {{ Str::title($patient->doctorname) }}</p>
                                        <p><strong>Email:</strong> {{ $patient->email }}</p>
                                        <p><strong>Treatment Stage:</strong>
                                            {{ implode(', ', json_decode($patient->treatment_stage, true)) }}</p>
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

                <p class="text-center rounded-md py-2 mt-2 text-sm bg-slate-600 text-white"><em>There are no any cancer
                        patients!<a href="{{ route('nav.show_addpatient') }}"
                            class="font-semobold text-slate-300 underline font-semibold"> Add
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