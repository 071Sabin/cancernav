@extends('navigator.navwelcome')

@section('title', '| Broadcast')
@php
    use Carbon\Carbon;
@endphp
@section('navigatorcontent')
    {{-- patient broadcast --}}



    <div class="flex justify-center items-center flex-col bg-slate-800 rounded p-3">
        <h1 class="font-bold text-xl text-pink-400 text-center mb-3">PATIENT BROADCAST</h1>

        @if(session('patient_broadcast_success'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('patient_broadcast_success') }}
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

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('nav.broadcast') }}" method="POST" enctype="multipart/form-data"
            class="custBroadcast lg:w-1/2 w-full mt-2 flex flex-col gap-5 lg:pl-10 pl-0">
            @csrf

            <div class=" gap-2">
                <p class="text-white">Title:</p> <input type="text" name="patientBroadcastTitle" class="rounded  w-full"
                    placeholder="Title of Broadcast...">
            </div>
            <div class="gap-2">
                <p class="text-white">Message:</p> <input type="text" name="patientBroadcastmesg" class="rounded  w-full"
                    placeholder="Type Mesg to broadcast...">
            </div>
            <div class="gap-2">
                <p class="text-white">Link:</p> <input type="text" name="patientBroadcastlink" class="rounded  w-full"
                    placeholder="link to broadcast...">
            </div>
            {{-- the name for the link will appear as a tag with href to above link entered --}}
            <div class="gap-2">
                <p class="text-white">Link Name:</p> <input type="text" name="patientBroadcastlinkname"
                    class="rounded  w-full" placeholder="name for the link ...">
            </div>
            <div class="lg:flex items-center justify-between p-3 rounded text-white bg-slate-900">
                <p class="font-bold text-white">Importance: </p>
                <p class="">
                    <label for="patientprimary text-white">Primary:</label> <input type="radio" name="patientmessageUrgency"
                        value="primary" id="patientprimary">
                </p>

                <p>
                    <label for="patient-urgent">Urgent: </label><input type="radio" name="patientmessageUrgency"
                        value="urgent" id="patient-urgent">
                </p>
            </div>
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-2 rounded mt-5">Broadcast</button>
        </form>
    </div>
    <hr class="my-6">
    {{-- BROADCAST DETAILS AND DELETE OPTIONS --}}
    <div class="p-3 rounded bg-slate-800">
        <h1 class="text-center text-slate-400 underline font-bold text-3xl">Broadcast Details</h1>
        @if (session('broadcast_deleted'))
            <p class="text-green-900 bg-green-50 border-2 border-green-800 p-2 rounded mt-5">Broadcast with id <span
                    class="font-semibold">{{ session('broadcast_deleted') }}</span> is deleted
                successfully.</p>
        @endif

        @if (count($navbroadcasts) > 0)
            <table class="w-full text-center table-auto text-sm md:text-md mt-5">
                <thead>
                    <tr class="text-sm bg-slate-700 text-gray-100 border-b border-gray-400">
                        <th class="py-2">S.No.</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>For</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($navbroadcasts as $broadcast)
                        <tr class="border-b border-gray-700 bg-slate-600 text-slate-300 text-sm">
                            <td class="py-2">{{ $broadcast->id }}</td>
                            {{-- <td class="py-2">{{ $index + 1 }}</td> --}}

                            <td
                                class="{{ $broadcast->broadcast_type == 'urgent' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $broadcast->broadcast_type }}
                            </td>
                            <td class="truncate max-w-xs" style="max-width: 10ch;">
                                {{ $broadcast->broadcast_title }}
                            </td>
                            <td
                                class="{{ $broadcast->for == 'navigator' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $broadcast->for }}
                            </td>
                            <td>
                                {{ Carbon::parse($broadcast->updated_at)->format('F j, Y') }}
                            </td>
                            <td>
                                <a href="{{ route('nav.deletebroadcast', $broadcast->id) }}">
                                    <i
                                        class="bi bi-trash3-fill text-xl text-red-600 px-1 rounded-full bg-white hover:bg-red-500 hover:text-white"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button"
                                    class="text-sm text-white bg-slate-900 px-2 py-1 rounded hover:bg-slate-800 hover:border hover:border-white"
                                    onclick="document.getElementById('details-{{ $broadcast->id }}').classList.toggle('hidden')">
                                    See Details
                                </button>
                            </td>
                        </tr>

                        <!-- Collapsible Row -->
                        <tr id="details-{{ $broadcast->id }}" class="hidden bg-slate-700 text-slate-300">
                            <td colspan="7" class="text-left p-4">
                                <div><span class="text-slate-400">Message:</span> <span
                                        class="text-white">{{ $broadcast->message }}</span></div>
                                <div><span class="text-slate-400">Link:</span>
                                    <a href=" {{ $broadcast->link }}" target="_blank"
                                        class="text-blue-400 underline hover:text-blue-200">
                                        {{ $broadcast->link }}
                                    </a>
                                </div>
                                <div><span class="text-slate-400">Link Name:</span> <span
                                        class="text-white">{{ $broadcast->linkname }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        @else
            <p class="bg-slate-600 text-slate-200 py-2 px-3 w-full rounded text-center mt-3 text-sm">
                <em>You didn't broadcast anything yet...</em>
            </p>
        @endif
    </div>
@endsection