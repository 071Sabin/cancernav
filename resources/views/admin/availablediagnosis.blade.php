@extends('admin.adminwelcome')

@section('title', '| Diagnosis')


@section('admincontent')

    <div class="bg-teal-700 my-10 p-6 rounded-xl border-white">
        <h1 class="text-teal-300 font-bold text-2xl">Cancer Type List</h1>
        <p class="text-gray-200 text-sm"><em>Total Diagnoses: {{ count($availablediagnosis) }}</em></p>

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <br>
                @endforeach
            </div>
        @endif

        @if (count($availablediagnosis) > 0)
            <table class="w-full text-center text-teal-800 table-auto text-sm md:text-md mt-10">
                <tr class="text-sm lg:text-md bg-slate-700 text-white border-b border-gray-100">
                    <th class="py-2">S.No.</th>
                    <th class="border-l border-teal-600">Cancer Name</th>
                    <th class="border-l border-teal-600">Hospital Name</th>
                    <th class="border-l border-teal-600">ICD Code</th>
                    <th class="border-l border-teal-600">Description</th>
                    <th class="border-l border-teal-600">Treatment Guidelines</th>
                </tr>

                @foreach ($availablediagnosis as $index => $diagnosis)
                    <tr class="border-b border-gray-500 bg-white hover:bg-gray-100">
                        <td class="py-2">{{ $index + 1 }}</td>
                        <td class="border-l border-gray-400 font-semibold"><a
                                href="{{ route('individualcancertypedetails', $diagnosis->id) }}"
                                class="text-blue-600 hover:text-blue-500 py-1 border-b-2 border-blue-600 font-semibold">{{ $diagnosis->name }}</a>
                        </td>
                        <td class="border-l border-gray-400 font-semibold">
                            {{ $diagnosis->hospital->name }} ({{ $diagnosis->hospital->hospitalId }})
                        </td>
                        <td class="border-l border-gray-400">
                            <a href="" class="">
                                {{ $diagnosis->icd_code ?? 'N/A' }}
                            </a>
                        </td>
                        <td class="border-l border-gray-400">
                            {{ $diagnosis->description ? Str::limit($diagnosis->description, 50) : 'N/A' }}
                        </td>
                        <td class="border-l border-gray-400">
                            {{ $diagnosis->treatment_guidelines ? Str::limit($diagnosis->treatment_guidelines, 50) : 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="mt-10 text-center">

                <p class="text-center rounded-md py-2 mt-2 text-sm bg-teal-600 text-gray-200">
                    <em>No diagnosis records available! <a href="{{ route('adddiagnosis') }}" class="underline">Add New
                            Diagnosis</a></em>
                </p>
            </div>
        @endif
    </div>


@endsection