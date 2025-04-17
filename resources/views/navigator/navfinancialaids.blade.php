@extends('navigator.navwelcome')
@section('title', '| Financial Aids')

@section('navigatorcontent')

    <div class="container bg-slate-700 my-10 p-6 rounded-xl mx-auto border-slate-400">
        <h1 class="text-slate-300 font-bold text-2xl">Available Financial Aid Providers</h1>
        <p class="text-gray-200 text-sm"><em>Total Financial Aid Providers: {{ count($financialaid_details) }}</em></p>


        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <br>
                @endforeach
            </div>
        @endif

        @if (count($financialaid_details) > 0)

            <div class="overflow-x-auto rounded">
                <table class="w-full text-center text-gray-900 rounded bg-gray-200 table-auto text-xs md:text-md mt-10">
                    <thead>
                        <tr class=" bg-slate-800 text-white border-b uppercase border-slate-400">
                            <th class="border border-slate-400 p-2">ID</th>
                            <th class="border border-slate-400 p-2">Name</th>
                            <th class="border border-slate-400 p-2">Contact</th>
                            <th class="border border-slate-400 p-2">Email</th>
                            <th class="border border-slate-400 p-2">Show Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($financialaid_details as $financialaid)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-slate-400 p-2">{{ $financialaid->id }}</td>
                                <td class="border border-slate-400 p-2 font-semibold text-slate-600 hover:underline">
                                    <a class="text-blue-600 underline"
                                        href="{{ route('nav.individualfinancialaiddetails', $financialaid->id) }}">{{ $financialaid->name }}</a>
                                </td>
                                <td class="border border-slate-400 p-2">{{ $financialaid->contact }}</td>
                                <td class="border border-slate-400 p-2">{{ $financialaid->email }}</td>
                                <td class="border border-slate-400 p-2">
                                    <button type="button"
                                        class="toggle-details bg-slate-600 hover:bg-slate-700 text-white py-1 px-3 rounded text-xs"
                                        data-id="{{ $financialaid->id }}">
                                        Show Details
                                    </button>
                                </td>
                            </tr>
                            <tr class="detail-row hidden" id="details-{{ $financialaid->id }}">
                                <td colspan="100%" class="bg-white border border-t-0 border-slate-600 p-4 text-left">
                                    <div class="flex flex-col md:flex-row items-start gap-4 text-sm text-gray-700">
                                        <!-- Logo -->
                                        <div class="w-full md:w-32 flex-shrink-0 flex justify-center md:justify-start">
                                            @if ($financialaid->logo)
                                                <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-slate-500">
                                                    <img src="{{ route('image.show', $financialaid->logo) }}" alt="Logo"
                                                        class="w-full h-full object-cover">
                                                </div>
                                            @else
                                                <div class="text-gray-500 text-center">No Logo</div>
                                            @endif
                                        </div>

                                        <!-- Details -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-1">
                                            <div><strong>Description:</strong><br>{{ $financialaid->description }}</div>
                                            <div><strong>Service
                                                    Area:</strong><br>{{ $financialaid->service_area ? implode(', ', json_decode($financialaid->service_area)) : 'N/A' }}
                                            </div>
                                            <div><strong>Provider Type:</strong><br>{{ $financialaid->provider_type }}</div>
                                            <div><strong>Funding
                                                    Source:</strong><br>{{ $financialaid->funding_source ? implode(', ', json_decode($financialaid->funding_source)) : 'N/A' }}
                                            </div>
                                            <div><strong>Max Assistance Amount
                                                    ($):</strong><br>${{ number_format($financialaid->max_assistance_amount, 2) }}
                                            </div>
                                            <div><strong>Eligibility Summary:</strong><br>{{ $financialaid->eligibility_summary }}
                                            </div>
                                            <div><strong>Application Process:</strong><br>{{ $financialaid->application_process }}
                                            </div>
                                            <div><strong>Support
                                                    Languages:</strong><br>{{ $financialaid->support_languages ? implode(', ', json_decode($financialaid->support_languages)) : 'N/A' }}
                                            </div>
                                            <div><strong>Hours of Operation:</strong><br>{{ $financialaid->hours_of_operation }}
                                            </div>

                                            <div><strong>Social Media Links:</strong><br>
                                                @if ($financialaid->social_media_links)
                                                    @foreach (json_decode($financialaid->social_media_links) as $platform => $link)
                                                        <a href="{{ $link }}" target="_blank"
                                                            class="text-blue-500 hover:underline">{{ ucfirst($platform) }}</a><br>
                                                    @endforeach
                                                @else
                                                    N/A
                                                @endif
                                            </div>

                                            <div><strong>Ratings &
                                                    Reviews:</strong><br>{{ $financialaid->ratings_reviews ? json_encode($financialaid->ratings_reviews) : 'N/A' }}
                                            </div>


                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>



        @else
            <div class="mt-10 text-center">
                <p class="text-center rounded-md py-2 mt-2 text-sm bg-slate-600 text-gray-200">
                    <em>No Financial Aid Providers available! Request Admin to add Financial Aid Provider...</em>
                </p>
            </div>
        @endif
    </div>


    <script>
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const detailRow = document.getElementById(`details-${id}`);

                if (detailRow.classList.contains('hidden')) {
                    detailRow.classList.remove('hidden');
                    button.textContent = 'Hide Details';
                } else {
                    detailRow.classList.add('hidden');
                    button.textContent = 'Show Details';
                }
            });
        });
    </script>


@endsection