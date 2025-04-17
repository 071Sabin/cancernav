{{-- EXISTING navigator ACCOUNTS --}}

@extends('admin.adminwelcome')

@section('title', '| Navigators')


@section('admincontent')
    <style>
        td,
        th {
            padding: 0 10px;
        }
    </style>
    <div class="bg-teal-700 my-10 p-6 rounded-xl">
        <h2 class="text-2xl font-bold text-teal-300">Navigator Records</h2>
        <p class="text-sm text-gray-200"><em>Total Navigators: {{ count($navigators) }}</em></p>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        @if (count($navigators) > 0)

            <div class="rounded-lg mt-10 overflow-x-auto">
                <table class="w-full text-center table-auto rounded-md text-xs min-w-full">

                    <tr class="text-white bg-slate-700 border-b border-gray-100 uppercase">
                        {{-- <th class="py-3">Select</th> --}}
                        <th class="py-2">S.No.</th>
                        <th class="border-l border-teal-600">Navigator ID</th>
                        <th class="border-l border-teal-600">Hospital ID</th>
                        {{-- <th class="border-l border-teal-600">HospitalName</th> --}}
                        <th class="border-l border-teal-600">Name</th>
                        <th class="border-l border-teal-600">Email</th>
                        <th class="border-l border-teal-600">Phone</th>
                    </tr>

                    @foreach ($navigators as $navigator)
                        <tr class="border-b border-teal-600 bg-teal-50 hover:bg-slate-200 text-teal-800">

                            {{-- 1st td --}}
                            <td class="py-2">
                                {{ $navigator->id }}
                            </td>
                            {{-- 2nd td --}}
                            <td class="border-l border-teal-600 font-semibold">
                                <a class="text-blue-700 underline hover:text-blue-500"
                                    href="{{ route('showEachNavigatorDetails', $navigator->id) }}">{{ $navigator->navigatorId }}
                                    ({{ $navigator->id }})
                                </a>
                            </td>
                            {{-- {{ route('showIndividualnavigatorDetails', $navigator->navigatorId) }} --}}
                            {{-- 3rd td --}}
                            <td class="border-l border-teal-600">{{ $navigator->hospital->hospitalId }}</td>

                            <td class="border-l border-teal-600">{{ $navigator->name }}</td>
                            <td class="border-l border-teal-600">{{ $navigator->email }}</td>
                            <td class="border-l border-teal-600">{{ $navigator->phone }}</td>
                        </tr>
                    @endforeach

                </table>
            </div>


        @else
            <p class="text-center text-sm text-slate-200 rounded-md py-2 mt-10 text-md bg-teal-600"><em>No navigators are
                    created!</em></p>
        @endif
    </div>
@endsection