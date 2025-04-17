@extends('patient.patientwelcome')

@section('title', '| Aids Eligibility')
@section('patientcontent')

    <div class=" mx-auto p-4 w-full mt-5 rounded-lg bg-gray-300 text-gray-800">
        <h1 class="text-2xl font-bold mb-1">Your Eligible Financial Aids</h1>
        <p class="text-sm  italic mb-6">The maximum match score can reach up to <strong class="">80%</strong>, with
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

                                <p><strong>Success Rate ({{ now()->year }}):</strong> {{ $aid->success_rate_percentage ?? 'N/A' }}%
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