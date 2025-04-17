{{-- this will show all the requests from patients to navigator --}}
@extends('navigator.navwelcome')

@section('title', '| Patient Requests')



@section('navigatorcontent')

    <div class="bg-slate-700 my-10 p-6 rounded-xl">
        <h2 class="text-2xl font-bold text-slate-300">Patient Requests</h2>
        <em><span class="text-gray-300 text-sm">Total Patient Requests: {{ count($requests) }}</span></em>

        <div class="flex flex-col lg:flex-row gap-2 lg:gap-4 w-fit">
            <div class="bg-yellow-100 text-yellow-800 rounded-md px-3 py-2 shadow-sm text-xs font-medium">
                Pending: {{ $requests->where('status', 'pending')->count() }}
            </div>
            <div class="bg-blue-100 text-blue-800 rounded-md px-3 py-2 shadow-sm text-xs font-medium">
                In Progress: {{ $requests->where('status', 'in_progress')->count() }}
            </div>
            <div class="bg-green-100 text-green-800 rounded-md px-3 py-2 shadow-sm text-xs font-medium">
                Completed: {{ $requests->where('status', 'completed')->count() }}
            </div>
        </div>


        @if(session('success'))
            <p class="text-green-900 bg-green-100 border-green-900 rounded-lg mb-3 p-2">{{ session('success') }}</p>
        @endif

        @if(count($requests) > 0)
            {{-- <div class=" p-6 mt-10 rounded-lg shadow-md max-w-6xl mx-auto text-slate-100 text-sm"> --}}
            <h2 class=" text-xl font-bold mb-4 text-slate-300 mt-10 pb-2">Patient → Navigator Requests</h2>

            <!-- Scrollable table wrapper -->
            <div class="w-full overflow-x-auto">
                <table class="min-w-max w-full text-center border border-slate-700 text-sm">
                    <thead class="bg-slate-900 text-slate-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-2 border-r border-slate-700">#</th>
                            <th class="px-4 py-2 border-r border-slate-700">Patient</th>
                            <th class="px-4 py-2 border-r border-slate-700">ID</th>
                            <th class="px-4 py-2border-r border-slate-700">Category</th>
                            <th class="px-4 py-2 border-r border-slate-700">Subject</th>
                            <th class="px-4 py-2 border-r border-slate-700">Priority</th>
                            <th class="px-4 py-2 border-r border-slate-700">Status</th>
                            <th class="px-4 py-2 border-r border-slate-700">Date</th>
                            <th class="px-4 py-2 border-r border-slate-700">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $index => $req)
                                <tr class="border-b border-slate-800 text-slate-900 bg-gray-100 hover:bg-slate-200">
                                    <td class="px-4 py-2 border-r border-slate-700">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 border-r border-slate-700">
                                        {{ $req->patient->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-4 py-2 border-r border-slate-700">{{ $req->patient->patientId }}</td>
                                    <td class="px-4 py-2 border-r border-slate-700">{{ $req->subject }}</td>
                                    <td class="px-4 py-2 capitalize border-r border-slate-700">{{ $req->category }}</td>
                                    <td class="px-4 py-2 border-r border-slate-700">
                                        <span class="px-2 py-1 rounded text-white  {{ $req->priority === 'high' ? 'bg-red-600' :
                            ($req->priority === 'medium' ? 'bg-yellow-500 text-black' : 'bg-green-500 text-black') }}">
                                            {{ ucfirst($req->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 border-r border-slate-700">
                                        <span class="px-2 py-1 rounded text-white {{ $req->status === 'pending' ? 'bg-yellow-500 text-black' :
                            ($req->status === 'in_progress' ? 'bg-blue-500' : 'bg-green-500') }}">
                                            {{ ucfirst(str_replace('_', ' ', $req->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-slate-900 border-r border-slate-700">
                                        {{ $req->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 py-2 flex items-center gap-2 border-r border-slate-700">
                                        <!-- Collapsible trigger -->
                                        <button onclick="document.getElementById('details-{{ $req->id }}').classList.toggle('hidden')"
                                            class="text-blue-300 bg-slate-900 rounded p-2 underline text-xs">Expand</button>

                                        <!-- Delete -->
                                        <form action="{{ route('nav.patient.requests.delete', $req->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this request?');"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete"
                                                class="text-red-400 bg-white rounded-md  hover:text-white hover:bg-red-500">
                                                <i class="bi bi-trash text-xl"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Collapsible Row -->
                                <tr id="details-{{ $req->id }}" class="hidden bg-slate-800/80 text-left text-white text-sm">
                                    <td colspan="9" class="px-4 py-3 border-t border-slate-600">
                                        <strong>Message:</strong> {{ $req->message }}<br>
                                        @if($req->response_message)
                                            <strong class="text-green-300">Response:</strong> {{ $req->response_message }}
                                        @endif
                                        <p class="flex flex-wrap text-sm mt-2"><a
                                                href="{{ route('nav.patient.requests.edit', $req->id) }}"
                                                class="px-2 py-1 rounded-lg bg-blue-600 hover:border hover:border-white text-white">
                                                View Details
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- </div> --}}

        @else
            <div class="text-slate-300 text-sm bg-slate-900 mt-5 p-2 text-center rounded-lg">
                <em>There is no any requests from Patients!</em>
            </div>
        @endif
    </div>

@endsection