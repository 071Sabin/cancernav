@extends('patient.patientwelcome')

@section('title', '| Individual Financial Aids')
@section('patientcontent')

    <div class="mt-6 p-6 bg-gray-100 shadow-lg rounded-lg">
        {{-- HEADING --}}
        <h2 class="text-2xl font-bold border-b border-gray-400 text-gray-900 pb-2 mb-4">Aid Provider Details</h2>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif


        @if(session('success'))
            <p class="p-2 rounded border-2 border-green-900 text-green-900 bg-green-50">{{ session('success') }}</p>
        @endif


        <!-- Logo -->
        <div class="w-full md:w-32 flex-shrink-0 flex justify-center mt-6 md:justify-start">
            @if ($aiddetails->logo)
                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-slate-500">
                    <img src="{{ route('image.show', $aiddetails->logo) }}" alt="Logo"
                        class="w-full h-full p-2 bg-white object-cover">
                </div>
            @else
                <div
                    class="text-gray-500 text-center w-20 h-20 border-black border rounded-full flex justify-center items-center">
                    No Logo</div>
            @endif
        </div>
        <p class="text-gray-600"><span class="font-semibold text-gray-900">Description:
            </span>{{ $aiddetails["description"] }}</p>


        {{-- DETAILS PART --}}

        <div class="container mx-auto p-6 rounded-lg grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class=" text-gray-900 p-6 bg-white rounded-lg shadow-lg">

                <h2 class="text-2xl font-bold mb-4 border-b pb-2">{{ $aiddetails["name"] }} </h2>
                <table class="min-w-full border border-slate-600 border-collapse">

                    <tbody>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Contact</th>
                            <td class="text-gray-600 px-3 py-1">{{ $aiddetails["contact"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Email</th>
                            <td class="px-3 py-1">
                                <a href="mailto:{{ $aiddetails["email"] }}" class="underline text-gray-600">
                                    {{ $aiddetails["email"] }}
                                </a>
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Service Areas</th>
                            <td class="text-gray-600 px-3 py-1">
                                {{ implode(', ', json_decode(Str::title($aiddetails["service_area"]))) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Provider Type</th>
                            <td class="text-gray-600 px-3 py-1">{{ $aiddetails["provider_type"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Funding Sources</th>
                            <td class="text-gray-600 px-3 py-1">
                                {{ implode(', ', json_decode($aiddetails["funding_source"])) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Max Assistance</th>
                            <td class="text-gray-600 px-3 py-1">
                                ${{ number_format($aiddetails["max_assistance_amount"], 2) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Eligibility</th>
                            <td class="text-gray-600 px-3 py-1">{{ $aiddetails["eligibility_summary"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Application Process</th>
                            <td class="text-gray-600 px-3 py-1">{{ $aiddetails["application_process"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Support Languages</th>
                            <td class="text-gray-600 px-3 py-1">
                                {{ implode(', ', json_decode($aiddetails["support_languages"])) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Hours</th>
                            <td class="text-gray-600 px-3 py-1">{{ $aiddetails["hours_of_operation"] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="bg-gray-600">


        {{-- this will now show the aids type from particular aids detail and the eligibility score --}}
        <div class="container mx-auto p-6 focus:text-gray-100">
            <h2 class="text-3xl font-bold text-gray-900 text-center">Available Aids</h2>
            <p class="text-sm  italic mb-6 text-center">The maximum match score can reach up to <strong
                    class="">80%</strong>, with
                the remaining portion determined by the providers.</p>
            @if(count($eligibleAids))
                <div class="grid gap-6">
                    {{-- {{ dd($eligibleAids) }} --}}
                    <div class="grid gap-6">
                        @foreach($eligibleAids as $aid)
                            <div class="bg-white shadow rounded-xl p-6 border-l-4 border-blue-500">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h2 class="text-lg font-bold text-gray-800">{{ $aid->program_name }}</h2>
                                        <p class="text-sm text-gray-600">
                                            {{ $aid->aid_type }} | Match Score:
                                            <span class="text-blue-600 font-semibold">{{ $aid->match_score }}%</span>
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Max Assistance: ${{ number_format($aid->max_assistance_amount, 2) }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            Processing Time: {{ $aid->processing_time_days }} days
                                            @if($aid->renewal_available)
                                                | <span class="text-green-600 font-medium">Renewable</span>
                                            @else
                                                | <span class="text-red-600 font-medium">Non-renewable</span>
                                            @endif
                                        </p>
                                    </div>
                                    <a href="{{ $aid->application_link }}" target="_blank"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Apply</a>
                                </div>

                                <div class="mt-4 text-sm text-gray-700 space-y-1">
                                    <p><strong>Covered Expenses:</strong> {{ implode(', ', $aid->covered_expenses ?? []) }}</p>
                                    <p><strong>Deadline:</strong>
                                        {{ \Carbon\Carbon::hasFormat($aid->application_deadline, 'Y-m-d') ? \Carbon\Carbon::parse($aid->application_deadline)->toFormattedDateString() : e($aid->application_deadline) }}
                                    </p>
                                    <p><strong>Documents Required:</strong> {{ implode(', ', $aid->documents_required ?? []) }}</p>
                                    <p><strong>Priority Groups:</strong> {{ implode(', ', $aid->priority_groups ?? []) }}</p>
                                    <p><strong>Restrictions:</strong> {{ $aid->restrictions ?? 'None' }}</p>

                                    {{-- <p><strong>Available Funds Remaining:</strong> ${{ number_format($aid->available_funds_remaining, 2) }}
                                    </p> --}}

                                    <p><strong>Success Rate ({{ now()->year }}):</strong>
                                        {{ $aid->success_rate_percentage ?? 'N/A' }}%
                                    </p>
                                    <p><strong>Contact:</strong> {{ $aid->contact_number }} | {{ $aid->email_support }}</p>
                                    <p><strong>Website:</strong> <a href="{{ $aid->website }}" target="_blank"
                                            class="text-blue-600 underline">{{ $aid->website }}</a></p>
                                    <p><strong>Status Tracking:</strong>
                                        @if($aid->application_status_tracking)
                                            <span class="text-green-600 font-medium">Available</span>
                                        @else
                                            <span class="text-gray-500">Not Available</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @else
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow text-center">
                    No eligible financial aids found at this moment. Please check back later.
                </div>
            @endif
        </div>

@endsection