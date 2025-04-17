@extends('admin.adminwelcome')
@section('title', '| Individual Financial Aid')

@section('admincontent')



    <div class="mt-6 p-6 bg-slate-800 shadow-lg rounded-lg">
        {{-- HEADING --}}
        <h2 class="text-2xl font-bold border-b border-white text-teal-300 pb-2 mb-4">Aid Provider Details</h2>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
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


        <!-- Logo -->
        <div class="w-full md:w-32 flex-shrink-0 flex justify-center mt-6 md:justify-start">
            @if ($aiddetails->logo)
                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-teal-500">
                    <img src="{{ route('image.show', $aiddetails->logo) }}" alt="Logo"
                        class="w-full h-full p-2 bg-white object-cover">
                </div>
            @else
                <div class="text-gray-500 text-center">No Logo</div>
            @endif
        </div>
        <p class="text-gray-200"><span class="font-semibold text-teal-300">Description:
            </span>{{ $aiddetails["description"] }}</p>


        {{-- DETAILS PART --}}

        <div class="container mx-auto p-6 bg-slate-800 rounded-lg grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-teal-700 text-teal-300 p-6 rounded-lg shadow-lg">

                <h2 class="text-2xl font-bold mb-4 border-b pb-2">{{ $aiddetails["name"] }} </h2>
                <table class="min-w-full border border-teal-600 border-collapse">

                    <tbody>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Contact</th>
                            <td class="text-white px-3 py-1">{{ $aiddetails["contact"] }}</td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Email</th>
                            <td class="px-3 py-1">
                                <a href="mailto:{{ $aiddetails["email"] }}" class="underline text-white">
                                    {{ $aiddetails["email"] }}
                                </a>
                            </td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Service Areas</th>
                            <td class="text-gray-200 px-3 py-1">
                                {{ implode(', ', json_decode(Str::title($aiddetails["service_area"]))) }}
                            </td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Provider Type</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["provider_type"] }}</td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Funding Sources</th>
                            <td class="text-gray-200 px-3 py-1">
                                {{ implode(', ', json_decode($aiddetails["funding_source"])) }}
                            </td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Max Assistance</th>
                            <td class="text-gray-200 px-3 py-1">
                                ${{ number_format($aiddetails["max_assistance_amount"], 2) }}
                            </td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Eligibility</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["eligibility_summary"] }}</td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Application Process</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["application_process"] }}</td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Support Languages</th>
                            <td class="text-gray-200 px-3 py-1">
                                {{ implode(', ', json_decode($aiddetails["support_languages"])) }}
                            </td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">Hours</th>
                            <td class="text-gray-200 px-3 py-1">{{ $aiddetails["hours_of_operation"] }}</td>
                        </tr>
                        <tr class="border border-teal-600">
                            <th class="text-left font-semibold px-3 py-1">API URL</th>
                            <td class="px-3 py-1">
                                <a href="{{ $aiddetails["apiurl"] }}" class="text-blue-400 underline">
                                    <em>{{ $aiddetails["apiurl"] }}</em>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- RIGHT: Update Form -->
            <div class="bg-teal-700 text-teal-300 p-6 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold text-teal-300 border-b pb-2 mb-4">Update Financial Aid Provider</h3>
                <form action="{{ route('updatefinancialaid', $aiddetails['id']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Provider Name -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Provider Name</label>
                            <input type="text" name="name" value="{{ $aiddetails['name'] }}" required
                                class="w-full p-2 border rounded text-teal-700">
                        </div>

                        <!-- Contact -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Contact Number</label>
                            <input type="text" name="contact" value="{{ $aiddetails['contact'] }}"
                                class="w-full p-2 border rounded text-teal-700">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Email</label>
                            <input type="email" name="email" value="{{ $aiddetails['email'] }}"
                                class="w-full p-2 border rounded text-teal-700">
                        </div>

                        <!-- Service Area -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Service Area (Comma-Separated)</label>
                            <input type="text" name="service_area"
                                value="{{ implode(', ', json_decode($aiddetails['service_area'] ?? '[]')) }}"
                                class="w-full p-2 border rounded text-teal-700">
                        </div>

                        <!-- Provider Type -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Provider Type</label>
                            <select name="provider_type" class="w-full p-2 border rounded text-teal-700">
                                @foreach(['Government', 'Non-Profit', 'Private'] as $type)
                                    <option value="{{ $type }}" {{ $aiddetails['provider_type'] === $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Max Assistance Amount -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Max Assistance Amount ($)</label>
                            <input type="number" step="0.01" name="max_assistance_amount"
                                value="{{ $aiddetails['max_assistance_amount'] }}"
                                class="w-full p-2 border rounded text-teal-700">
                        </div>

                        <!-- Hours of Operation -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">Hours of Operation</label>
                            <select name="hours_of_operation" class="w-full p-2 border rounded text-teal-700">
                                @foreach(['24/7', 'Mon-Fri, 9AM-5PM', 'Mon-Sat, 10AM-6PM', 'Weekends Only'] as $hours)
                                    <option value="{{ $hours }}"
                                        {{ $aiddetails['hours_of_operation'] === $hours ? 'selected' : '' }}>{{ $hours }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- API URL -->
                        <div>
                            <label class="block mb-2 font-semibold text-teal-300">API URL</label>
                            <input type="text" name="apiurl" value="{{ $aiddetails['apiurl'] }}"
                                class="w-full p-2 border rounded text-teal-700">
                        </div>

                        <!-- Logo -->
                        <div class="col-span-full flex flex-col md:flex-row justify-between items-center gap-4">
                            <!-- Logo Upload -->
                            <div class="md:w-2/3 w-full">
                                <label class="block mb-2 font-semibold text-teal-300">Logo (Leave blank to keep
                                    existing)</label>
                                <input type="file" name="logo" class="w-full p-2 border rounded bg-gray-100 text-gray-700">
                            </div>

                            <!-- Logo Preview -->
                            @if($aiddetails['logo'])
                                <div class="md:w-1/3 w-full flex justify-end">
                                    <img src="{{ route('image.show', $aiddetails['logo']) }}"
                                        class="h-16 rounded border shadow bg-white">
                                </div>
                            @endif
                        </div>

                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold text-teal-300">Description</label>
                        <textarea name="description"
                            class="w-full p-2 border rounded text-teal-700">{{ $aiddetails['description'] }}</textarea>
                    </div>

                    <!-- Eligibility Summary -->
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold text-teal-300">Eligibility Summary</label>
                        <textarea name="eligibility_summary"
                            class="w-full p-2 border rounded text-teal-700">{{ $aiddetails['eligibility_summary'] }}</textarea>
                    </div>

                    <!-- Application Process -->
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold text-teal-300">Application Process</label>
                        <textarea name="application_process"
                            class="w-full p-2 border rounded text-teal-700">{{ $aiddetails['application_process'] }}</textarea>
                    </div>

                    <!-- Funding Sources -->
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold text-teal-300">Funding Sources</label>
                        @php
                            $fundingOptions = ['Government', 'Non-Profit', 'Private', 'Crowdfunding', 'Insurance', 'Philanthropy'];
                            $selectedFunding = json_decode($aiddetails['funding_source'] ?? '[]');
                        @endphp
                        <div class="flex flex-wrap gap-3 text-teal-300">
                            @foreach($fundingOptions as $option)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="funding_source[]" value="{{ $option }}" class="rounded"
                                        {{ in_array($option, $selectedFunding) ? 'checked' : '' }}>
                                    <span>{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Supported Languages -->
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold text-teal-300">Supported Languages</label>
                        @php
                            $languages = ['English', 'Spanish', 'French', 'German', 'Chinese', 'Arabic', 'Hindi', 'Portuguese', 'Bengali'];
                            $selectedLanguages = json_decode($aiddetails['support_languages'] ?? '[]');
                        @endphp
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-teal-300">
                            @foreach($languages as $lang)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="support_languages[]" value="{{ $lang }}" class="rounded"
                                        {{ in_array($lang, $selectedLanguages) ? 'checked' : '' }}>
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="mt-6">
                        <label class="block mb-2 font-semibold text-teal-300">Social Media Links</label>
                        @php
                            $socials = json_decode($aiddetails['social_media_links'] ?? '{}', true);
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-teal-700">
                            @foreach(['Facebook', 'Twitter', 'LinkedIn', 'Instagram'] as $platform)
                                <input type="text" name="social_media[{{ $platform }}]" placeholder="{{ $platform }} URL"
                                    value="{{ $socials[$platform] ?? '' }}" class="p-2 border rounded w-full">
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full mt-8 bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">
                        Update Provider
                    </button>
                </form>

            </div>
        </div>


        {{-- showing the data from json response --}}

        <div class="container mx-auto p-6 focus:text-teal-300">
            <h2 class="text-3xl font-bold text-teal-300 mb-6 text-center">Available Aids</h2>

            @if(empty($financialaiddata))
                <p class="text-red-800 text-center bg-red-100 rounded p-3">No Financial Aids available from this provider!.</p>
            @else
                <p class="text-teal-300 text-center mb-4">Click on the program name to view details.</p>

                {{-- Accordion for financial aid data --}}
                <div id="accordion-collapse" data-accordion="collapse" class="space-y-4">
                    @foreach ($financialaiddata as $index => $program)
                        <h2 id="accordion-heading-{{ $index }}" class="bg-teal-700 hover:text-teal-700 text-teal-300 rounded-xl">
                            <button type="button"
                                class="flex items-center rounded-md border focus:bg-gray-800 border-gray-200 justify-between w-full p-5 font-medium bg-gray-700 focus:ring-4 focus:ring-gray-200 focus:rounded-xl hover:rounded-xl dark:focus:ring-gray-800 dark:border-gray-700 hover:text-teal-800 hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-body-{{ $index }}" aria-expanded="false"
                                aria-controls="accordion-body-{{ $index }}">
                                <span class="text-teal-300 hover:text-teal-700">{{ $program['program_name'] }}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>

                        <div id="accordion-body-{{ $index }}"
                            class="hidden text-teal-300 bg-slate-700 focus:text-teal-300 rounded-md"
                            aria-labelledby="accordion-heading-{{ $index }}">
                            <div class="p-5 border rounded-md border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <p><strong>Aid Type:</strong> <em>{{ $program['aid_type'] }}</em></p>
                                <p><strong>Max Assistance:</strong>
                                    <em>${{ number_format($program['max_assistance_amount'], 2) }}</em>
                                </p>
                                <p><strong>Eligibility:</strong></p>
                                <ul class="list-disc pl-5 text-teal-500 dark:text-teal-400">
                                    <em>
                                        <li>Income below: ${{ number_format($program['eligibility_criteria']['income_below']) }}
                                        </li>
                                        <li>Cancer Types: {{ implode(', ', $program['eligibility_criteria']['cancer_type']) }}</li>
                                        <li>Age Limit: <em>{{ $program['eligibility_criteria']['age_limit'] }}</em></li>
                                        <li>Insurance Status:
                                            {{ implode(', ', $program['eligibility_criteria']['insurance_status']) }}
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
                                <p><strong>Website:</strong> <a href="{{ $program['website'] }}"
                                        class="text-blue-500 hover:underline" target="_blank"><em>{{ $program['website'] }}</em></a>
                                </p>
                                <p><strong>Processing Time (Days):</strong> <em>{{ $program['processing_time_days'] }}</em></p>
                                <p><strong>Application Status Tracking:</strong>
                                    <em>{{ $program['application_status_tracking'] ? 'Yes' : 'No' }}</em>
                                </p>
                                <p><strong>Documents Required:</strong>
                                    <em>{{ implode(', ', $program['documents_required']) }}</em>
                                </p>
                                <p><strong>Success Rate (%):</strong> <em>{{ $program['success_rate_percentage'] }}</em></p>
                                <p><strong>Renewal Available:</strong> <em>{{ $program['renewal_available'] ? 'Yes' : 'No' }}</em>
                                </p>
                                <p><strong>State Specific:</strong> <em>{{ $program['state_specific'] ? 'Yes' : 'No' }}</em></p>
                                <p><strong>Restrictions:</strong> <em>{{ $program['restrictions'] }}</em></p>
                                <p><strong>Priority Groups:</strong> <em>{{ implode(', ', $program['priority_groups']) }}</em></p>
                                <p><strong>Available Funds Remaining:</strong>
                                    <em>${{ number_format($program['available_funds_remaining'], 2) }}</em>
                                </p>
                                <p><strong>Historical Approval Rate:</strong></p>
                                <ul class="list-disc pl-5 text-teal-500 dark:text-teal-400">
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
    </div>






@endsection