@extends('admin.adminwelcome')
@section('title', '| Transports')
@section('admincontent')
    <style>
        td,
        th {
            padding: 0 10px;
        }
    </style>
    <div class="bg-teal-700 my-10 p-6 rounded-xl">
        <h1 class="text-teal-300 font-bold text-2xl">Available Transports</h1>
        <p class="text-gray-200 text-sm"><em>Total Transports Available: {{ count($transports) }}</em></p>
        <p class="text-gray-200">
            <em>The API will return only available transports here and if they are booked it will not
                display in this system. <br> This is the optimized solution to keep everything centralized.
            </em>
        </p>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <br>
                @endforeach
            </div>
        @endif

        @if (count($transports) > 0)
            <table class="w-full text-center text-teal-700 table-auto text-sm mt-10">
                <tr class=" bg-slate-700 text-white border-b border-gray-100">
                    <th class=" py-2">#</th>
                    <th class="border-l border-teal-600">Admin ID</th>
                    <th class="border-l border-teal-600">Name</th>
                    <th class="border-l border-teal-600">City</th>
                    <th class="border-l border-teal-600">URL</th>
                    <th class="border-l border-teal-600">Availability</th>
                    <th class="border-l border-teal-600">Caregivers</th>
                    <th class="border-l border-teal-600">Wheelchairs</th>
                </tr>
                @foreach ($transports as $index => $transport)
                    <tr class="border-b border-teal-600 bg-white hover:bg-gray-100">
                        <td class=" py-2">{{ $index + 1 }}</td>
                        <td class="border-l border-teal-600">{{ $transport->admin_id }}</td>
                        <td class="border-l border-teal-600 font-semibold underline text-blue-600 hover:text-blue-500"><a
                                href="{{ route('individualtransportdetails', $transport->id) }}">{{ $transport->name }}</a>
                        </td>
                        <td class="border-l border-teal-600">{{ $transport->city }}</td>
                        <td class="border-l border-teal-600"><a href="{{ $transport->url }}"
                                class="text-blue-600 hover:underline font-semibold" target="_blank">Visit Site</a></td>
                        <td class="border-l border-teal-600">
                            <span
                                class="px-2 py-1 rounded-md text-white {{ $transport->availability ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $transport->availability ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="border-l border-teal-600">{{ $transport->num_wheelchairs }}</td>
                        <td class="border-l border-teal-600">{{ $transport->num_caregivers }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class=" mt-10 text-center">

                <p class="text-center rounded-md py-2 mt-2 text-sm bg-teal-600 text-white">
                    <em>There are no transports available! <a href="{{ route('addtransport') }}"
                            class="underline font-semibold hover:text-teal-200">Add New Transport Here</a></em>
                </p>
            </div>
        @endif
    </div>

@endsection