@extends('admin.adminwelcome')
@php
    use Carbon\Carbon;
@endphp

@section('title', '| Broadcast')

@section('admincontent')

    <style>
        input {
            color: black;
        }
    </style>

    <div class=" p-6 rounded-xl bg-teal-700 my-10">
        <h1 class=" font-bold text-3xl text-teal-300">Admin Broadcast(ID: {{ Auth::guard('admin')->user()->id }})</h1>

        <em class="text-gray-300 text-sm">(Admins can broadcast messages to Navigators and Patients from here.)</em>

        @if (session('nav_broadcast_success'))
            <p class="bg-green-50 text-green-900 border-2 border-green-800 py-2 px-3 rounded mt-10">
                {{ session('nav_broadcast_success') }}
            </p>
        @endif

        {{-- this session is from adminbroadcastcontroller.php --}}
        @if (session('patient_broadcast_success'))
            <p class="bg-green-50 text-green-900 border-2 border-green-800 py-2 px-3 rounded mt-10">
                {{ session('patient_broadcast_success') }}
            </p>
        @endif

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        {{-- NAVIGATOR BROADCAST --}}
        <div class="mt-10 lg:flex lg:flex-row text-teal-300">
            <form action="{{ route('adminnavbroadcast') }}" method="POST" enctype="multipart/form-data"
                class="custBroadcast lg:w-1/2 w-full p-3 mt-2 flex flex-col gap-5 lg:border-r lg:border-gray-300 lg:pr-10 border-b lg:border-b-0 pb-10 lg:pb-3">
                @csrf
                <h1 class="font-bold text-xl text-blue-400 text-center mb-3">NAVIGATOR BROADCAST</h1>

                <div class="items-center gap-2">
                    <p>Title</p> <input type="text" name="navBroadcastTitle" class="rounded w-full"
                        placeholder="Title of Broadcast...">
                </div>
                <div class="items-center gap-2">
                    <p>Message</p> <input type="text" name="navBroadcastmesg" class="rounded w-full"
                        placeholder="Type Mesg to broadcast...">
                </div>
                <div class="items-center gap-2">
                    <p>Link</p> <input type="text" name="navBroadcastlink" class="rounded w-full"
                        placeholder="Put the link if any...">
                </div>
                {{-- the name for the link will appear as a tag with href to above link entered --}}
                <div class=" gap-2">
                    <p>Link Name</p> <input type="text" name="navBroadcastlinkname" class="rounded w-full"
                        placeholder="name for the link ...">
                </div>
                <div class="lg:flex items-center gap-3 justify-between p-3 rounded bg-teal-800">
                    <p class="font-bold">Importance: </p>
                    <p>
                        <label for="nav-primary">Primary: </label><input type="radio" name="navmessageUrgency"
                            value="primary" id="nav-primary">
                    </p>
                    <p>
                        <label for="nav-urgent">Urgent: </label><input type="radio" name="navmessageUrgency" value="urgent"
                            id="nav-urgent">
                    </p>
                </div>
                <button type="submit"
                    class="bg-blue-600 text-white hover:bg-blue-700 px-3 py-2 rounded mt-5">Broadcast</button>
            </form>

            {{-- patient broadcast --}}
            <form action="{{ route('adminpatientbroadcast') }}" method="POST" enctype="multipart/form-data"
                class="custBroadcast lg:w-1/2 w-full p-3 mt-2 flex flex-col gap-5 lg:pl-10
                                                                                                                        pl-0">
                @csrf
                <h1 class="font-bold text-xl text-pink-400 text-center mb-3">PATIENT BROADCAST</h1>

                <div class=" gap-2">
                    <p>Title:</p> <input type="text" name="patientBroadcastTitle" class="rounded  w-full"
                        placeholder="Title of Broadcast...">
                </div>
                <div class="gap-2">
                    <p>Message:</p> <input type="text" name="patientBroadcastmesg" class="rounded  w-full"
                        placeholder="Type Mesg to broadcast...">
                </div>
                <div class="gap-2">
                    <p>Link:</p> <input type="text" name="patientBroadcastlink" class="rounded  w-full"
                        placeholder="link to broadcast...">
                </div>
                {{-- the name for the link will appear as a tag with href to above link entered --}}
                <div class="gap-2">
                    <p>Link Name:</p> <input type="text" name="patientBroadcastlinkname" class="rounded  w-full"
                        placeholder="name for the link ...">
                </div>
                <div class="lg:flex items-center justify-between  p-3 rounded bg-teal-800">
                    <p class="font-bold">Importance: </p>
                    <p class="">
                        <label for="patientprimary">Primary:</label> <input type="radio" name="patientmessageUrgency"
                            value="primary" id="patientprimary">
                    </p>
                    {{-- <p>
                                                                                                                                    Secondary: <input type="radio" name="custmessage"value="secondary">
                                                                                                                                </p> --}}
                    <p>
                        <label for="patient-urgent">Urgent: </label><input type="radio" name="patientmessageUrgency"
                            value="urgent" id="patient-urgent">
                    </p>

                </div>
                <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-2 rounded mt-5">Broadcast</button>
            </form>
        </div>

        <hr class="my-10">


        {{-- BROADCAST DETAILS AND DELETE OPTIONS --}}
        <div class="p-3 rounded">
            <h1 class="text-center text-teal-300 underline font-bold text-3xl">Broadcast Details</h1>
            @if (session('broadcast_deleted'))
                <p class="text-green-900 bg-green-50 border-2 border-green-800 p-2 rounded mt-5">Broadcast with id <span
                        class="font-semibold">{{ session('broadcast_deleted') }}</span> is deleted
                    successfully.</p>
            @endif

            @if (count($allbroadcasts) > 0)
                <table class="w-full text-center table-auto text-sm md:text-md mt-5">
                    <thead>
                        <tr class="text-sm bg-slate-600 text-gray-100 border-b border-gray-400">
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
                        @foreach ($allbroadcasts as $broadcast)
                            <tr class="border-b border-gray-700 bg-teal-600 text-teal-300 text-sm">
                                <td class="py-2">{{ $broadcast->id }}</td>

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
                                    <a href="{{ route('deletebroadcast', $broadcast->id) }}">
                                        <i
                                            class="bi bi-trash3-fill text-xl text-red-600 px-1 rounded-full bg-white hover:bg-red-500 hover:text-white"></i>
                                    </a>
                                </td>
                                <td>
                                    <button type="button"
                                        class="text-sm text-white bg-slate-700 px-2 py-1 rounded hover:bg-slate-600"
                                        onclick="document.getElementById('details-{{ $broadcast->id }}').classList.toggle('hidden')">
                                        See Details
                                    </button>
                                </td>
                            </tr>

                            <!-- Collapsible Row -->
                            <tr id="details-{{ $broadcast->id }}" class="hidden bg-slate-800 text-slate-300">
                                <td colspan="7" class="text-left p-4">
                                    <div><span class="text-slate-400">Message:</span> <span
                                            class="text-white">{{ $broadcast->message }}</span></div>
                                    <div><span class="text-slate-400">Link:</span>
                                        <a href="{{ $broadcast->link }}" target="_blank"
                                            class="text-blue-400 underline hover:text-blue-200">
                                            {{ $broadcast->link }}
                                        </a>
                                    </div>
                                    <div><span class="text-slate-400">Link Name:</span> <span
                                            class="text-white">{{ $broadcast->linkname }}</span>
                                    </div>
                                    <div>
                                        <span class="text-slate-400">Broadcast By:</span>
                                        @if($broadcast->adminId !== 0)
                                            <span class="text-white"> Admin ID: {{ $broadcast->adminId }}</span>
                                        @elseif ($broadcast->navigatorId !== 0)
                                            <span class="text-white"> Navigator ID: {{ $broadcast->navigatorId }}</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else

                <p class="bg-teal-600 text-gray-200 py-2 px-3 w-full rounded text-center mt-3 text-sm">
                    <em>Admins didn't broadcast anything yet...</em>
                </p>
            @endif
        </div>
    </div>
@endsection