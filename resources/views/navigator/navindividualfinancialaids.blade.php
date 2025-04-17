@extends('navigator.navwelcome')
@section('title', '| Individual Financial Aid')

@section('navigatorcontent')

    <div class="mt-6 p-6 bg-slate-800 shadow-lg rounded-lg">
        {{-- HEADING --}}
        <h2 class="text-2xl font-bold border-b border-white text-slate-300 pb-2 mb-4">Aid Provider Details</h2>

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
                <div class="text-gray-500 text-center">No Logo</div>
            @endif
        </div>
        <p class="text-gray-200"><span class="font-semibold text-slate-300">Description:
            </span>{{ $aiddetails["description"] }}</p>


        {{-- DETAILS PART --}}

        <div class="container mx-auto p-6 bg-slate-800 rounded-lg grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-slate-700 text-slate-300 p-6 rounded-lg shadow-lg">

                <h2 class="text-2xl font-bold mb-4 border-b pb-2">{{ $aiddetails["name"] }} </h2>
                <table class="min-w-full border border-slate-600 border-collapse">

                    <tbody>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Contact</th>
                            <td class="text-white px-3 py-1">{{ $aiddetails["contact"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Email</th>
                            <td class="px-3 py-1">
                                <a href="mailto:{{ $aiddetails["email"] }}" class="underline text-white">
                                    {{ $aiddetails["email"] }}
                                </a>
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Service Areas</th>
                            <td class="text-gray-200 px-3 py-1">
                                {{ implode(', ', json_decode(Str::title($aiddetails["service_area"]))) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Provider Type</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["provider_type"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Funding Sources</th>
                            <td class="text-gray-200 px-3 py-1">
                                {{ implode(', ', json_decode($aiddetails["funding_source"])) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Max Assistance</th>
                            <td class="text-gray-200 px-3 py-1">
                                ${{ number_format($aiddetails["max_assistance_amount"], 2) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Eligibility</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["eligibility_summary"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Application Process</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["application_process"] }}</td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Support Languages</th>
                            <td class="text-gray-200 px-3 py-1">
                                {{ implode(', ', json_decode($aiddetails["support_languages"])) }}
                            </td>
                        </tr>
                        <tr class="border border-slate-600">
                            <th class="text-left font-semibold px-3 py-1">Hours</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["hours_of_operation"] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="container mx-auto p-6 focus:text-slate-300">
        <h2 class="text-3xl font-bold text-slate-300 mb-6 text-center">Available Aids</h2>

        @if(empty($financialaiddata))
            <p class="text-red-800 text-center bg-red-100 rounded p-3">No Financial Aids available from this provider!.</p>
        @else
            <p class="text-slate-300 text-center mb-4">Click on the program name to view details.</p>

            {{-- Accordion for financial aid data --}}
            <div id="accordion-collapse" data-accordion="collapse" class="space-y-4">
                @foreach ($financialaiddata as $index => $program)
                    <h2 id="accordion-heading-{{ $index }}" class="bg-slate-700 hover:text-slate-700 text-slate-300 rounded-xl">
                        <button type="button"
                            class="flex items-center rounded-md border focus:bg-gray-800 border-gray-200 justify-between w-full p-5 font-medium bg-gray-700 focus:ring-4 focus:ring-gray-200 focus:rounded-xl hover:rounded-xl dark:focus:ring-gray-800 dark:border-gray-700 hover:text-slate-800 hover:bg-gray-800 gap-3"
                            data-accordion-target="#accordion-body-{{ $index }}" aria-expanded="false"
                            aria-controls="accordion-body-{{ $index }}">
                            <span class="text-slate-300 hover:text-slate-700">{{ $program['program_name'] }}</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>

                    <div id="accordion-body-{{ $index }}" class="hidden text-slate-300 bg-slate-700 focus:text-slate-300 rounded-md"
                        aria-labelledby="accordion-heading-{{ $index }}">
                        <div class="p-5 border rounded-md border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <p><strong>Aid Type:</strong> <em>{{ $program['aid_type'] }}</em></p>
                            <p><strong>Max Assistance:</strong> <em>${{ number_format($program['max_assistance_amount'], 2) }}</em>
                            </p>
                            <p><strong>Eligibility:</strong></p>
                            <ul class="list-disc pl-5 text-slate-400 dark:text-slate-400">
                                <em>
                                    <li>Income below: ${{ number_format($program['eligibility_criteria']['income_below']) }}</li>
                                    <li>Cancer Types: {{ implode(', ', $program['eligibility_criteria']['cancer_type']) }}</li>
                                    <li>Age Limit: <em>{{ $program['eligibility_criteria']['age_limit'] }}</em></li>
                                    <li>Insurance Status: {{ implode(', ', $program['eligibility_criteria']['insurance_status']) }}
                                    <li>Treatment Stage: {{ $program['eligibility_criteria']['treatment_stage'] }}
                                    </li>
                                </em>
                            </ul>
                            <p><strong>Covered Expenses:</strong> <em>{{ implode(', ', $program['covered_expenses']) }}</em></p>
                            <p><strong>Deadline:</strong> <em>{{ $program['application_deadline'] }}</em></p>
                            <p><strong>Contact:</strong> <em>{{ $program['contact_number'] }}</em> | <a
                                    href="mailto:{{ $program['email_support'] }}"
                                    class="text-blue-500 hover:underline"><em>{{ $program['email_support'] }}</em></a></p>
                            <p><strong>Apply:</strong> <a href="{{ $program['application_link'] }}"
                                    class="text-blue-500 hover:underline"><em>Application Link</em></a></p>
                            <p><strong>Funding Source:</strong> <em>{{ $program['funding_source'] }}</em></p>
                            <p><strong>Website:</strong> <a href="{{ $program['website'] }}" class="text-blue-500 hover:underline"
                                    target="_blank"><em>{{ $program['website'] }}</em></a></p>
                            <p><strong>Processing Time (Days):</strong> <em>{{ $program['processing_time_days'] }}</em></p>
                            <p><strong>Application Status Tracking:</strong>
                                <em>{{ $program['application_status_tracking'] ? 'Yes' : 'No' }}</em>
                            </p>
                            <p><strong>Documents Required:</strong>
                                <em>{{ implode(', ', $program['documents_required']) }}</em>
                            </p>
                            <p><strong>Success Rate (%):</strong> <em>{{ $program['success_rate_percentage'] }}</em></p>
                            <p><strong>Renewal Available:</strong> <em>{{ $program['renewal_available'] ? 'Yes' : 'No' }}</em></p>
                            <p><strong>State Specific:</strong> <em>{{ $program['state_specific'] ? 'Yes' : 'No' }}</em></p>
                            <p><strong>Restrictions:</strong> <em>{{ $program['restrictions'] }}</em></p>
                            <p><strong>Priority Groups:</strong> <em>{{ implode(', ', $program['priority_groups']) }}</em></p>
                            <p><strong>Available Funds Remaining:</strong>
                                <em>${{ number_format($program['available_funds_remaining'], 2) }}</em>
                            </p>
                            <p><strong>Historical Approval Rate:</strong></p>
                            <ul class="list-disc pl-5 text-slate-400 dark:text-slate-400">
                                <em>
                                    @foreach ($program['historical_approval_rate'] as $year => $rate)
                                        <li><em>{{ $year }}: {{ $rate }}%</em></li>
                                    @endforeach
                                </em>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>


        @endif
    </div>


@endsection