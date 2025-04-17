@extends('navigator.navwelcome')

@section('title', '| Housing')

@section('navigatorcontent')

    <div class="bg-slate-700 my-10 p-6 rounded-xl border-white">
        <h1 class="text-slate-300 font-bold text-2xl">Housing Providers</h1>
        <p class="text-gray-200 text-sm"><em>Total Housing Providers: {{ count($availablehousing) }}</em></p>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <br>
                @endforeach
            </div>
        @endif

        @if (count($availablehousing) > 0)
            <table class="w-full text-center text-gray-900 table-auto md:text-md text-xs mt-10">
                <tr class=" bg-gray-900 text-white border-b uppercase border-gray-100">
                    <th class="py-4">#</th>
                    <th class="border-l border-gray-600">Housing Provider</th>
                    <th class="border-l border-gray-600">City</th>
                    <th class="border-l border-gray-600">State</th>
                    <th class="border-l border-gray-600">Wheelchairs</th>
                    <th class="border-l border-gray-600">CaregiverSupport</th>
                    <th class="border-l border-gray-600">Availability</th>
                </tr>

                @foreach ($availablehousing as $index => $housing)
                    <tr class="border-b border-gray-500 bg-white hover:bg-slate-50">
                        <td class="py-2">{{ $index + 1 }}</td>
                        <td class="border-l border-gray-400 font-semibold"><a
                                href="{{ route('nav.individualhousingdetails', $housing->id) }}"
                                class="text-blue-600 underline">{{ $housing->name }}</a></td>
                        <td class="border-l border-gray-400">{{ $housing->city }}</td>
                        <td class="border-l border-gray-400">{{ $housing->state }}</td>
                        <td class="border-l border-gray-400">
                            <span
                                class="px-3 py-1 rounded-md {{ $housing->has_wheelchair_access ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $housing->has_wheelchair_access ? 'Yes' : 'No' }}
                            </span>
                        </td>

                        <td class="border-l border-gray-400">
                            <span
                                class="px-3 py-1 rounded-md {{ $housing->has_caregiver_support ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $housing->has_caregiver_support ? 'Yes' : 'No' }}
                            </span>
                        </td>

                        <td class="border-l border-gray-400">
                            <span
                                class="px-3 py-1  rounded-md {{ $housing->availability ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $housing->availability ? 'Yes' : 'No' }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="mt-10 text-center">
                <p class="text-center rounded-md py-2 mt-2 text-sm bg-slate-600 text-gray-200">
                    <em>No Housing Providers available! Request Admin to add Housing Providers!</em>
                </p>
            </div>
        @endif
    </div>

@endsection