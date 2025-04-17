@extends('admin.adminwelcome')
@section('title', '| Hospitals')

@section('admincontent')
    <style>
        td,
        th {
            padding: 0 10px;
        }
    </style>
    <div class="bg-teal-700 my-10 p-6 rounded-xl">
        <h1 class="text-teal-300 font-bold text-2xl">Existing Hospitals</h1>
        <p class="text-gray-300 text-sm"><em>Total Hospitals Available: {{ count($hospitals) }}</em></p>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <br>
                @endforeach
            </div>
        @endif

        @if (count($hospitals) > 0)
            <table class="w-full text-center text-teal-800 table-auto mt-10 text-sm">
                <tr class=" bg-slate-700 text-white border-b border-gray-100">
                    <th class="py-2">S.No.</th>
                    <th class="border-l border-teal-600">Hospital ID</th>
                    <th class="border-l border-teal-600">Name</th>
                    <th class="border-l border-teal-600">City</th>
                    <th class="border-l border-teal-600">State</th>
                    <th class="border-l border-teal-600">Contact No</th>
                    <th class="border-l border-teal-600">Established</th>
                </tr>

                @foreach ($hospitals as $index => $hospital)
                    <tr class="border-b border-gray-500 bg-white hover:bg-gray-100">
                        <td class="py-2">{{ $index + 1 }}</td>
                        <td class="border-l border-teal-600 font-semibold"><a
                                href="{{ route('showEachHospitalDetails', $hospital->id) }}"
                                class="underline hover:text-blue-600 text-blue-500">{{ $hospital->hospitalId }}</a></td>
                        <td class="border-l border-teal-600"> {{ Str::title($hospital->name) }} </td>
                        <td class="border-l border-teal-600">{{ Str::title($hospital->city) }}</td>
                        <td class="border-l border-teal-600">{{ $hospital->state }}</td>
                        <td class="border-l border-teal-600">{{ $hospital->contact_no }}</td>
                        <td class="border-l border-teal-600">{{ $hospital->established ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="mt-10 text-center">

                <p class="text-center rounded-md py-2 mt-2 text-sm bg-teal-600 text-white">
                    <em>There are no hospitals available! <a href="{{ route('addhospital') }}"
                            class="text-teal-300 underline font-semibold">Add New Hospital</a></em>
                </p>
            </div>
        @endif
    </div>

@endsection