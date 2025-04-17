{{-- this will show individual patient requests to navigators --}}

@extends('admin.adminwelcome')

@section('title', '| Patient-Nav-Requests')


@section('admincontent')
    <div class="max-w-3xl mx-auto mt-10 bg-teal-800 p-6 rounded-lg shadow text-teal-100 text-sm">
        <h2 class="text-xl font-bold mb-4 border-b border-teal-500 pb-2">Update Patient Request</h2>

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


        <div class="overflow-x-auto text-sm">
            <table class="min-w-full table-auto border border-teal-600 rounded-lg shadow bg-teal-800 text-teal-200">
                <tbody class="divide-y divide-teal-600">
                    <tr>
                        <th class="text-left px-4 py-2 w-1/3 text-teal-300">Patient Name</th>
                        <td class="px-4 py-2">{{ $request->patient->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Patient ID</th>
                        <td class="px-4 py-2">{{ $request->patient->patientId }} ({{ $request->patient->id }})</td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Hospital</th>
                        <td class="px-4 py-2">
                            {{ $request->patient->hospital->name ?? 'N/A' }}
                            ({{ $request->patient->hospital->hospitalId ?? 'N/A' }})
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Navigator Name:</th>
                        <td class="px-4 py-2">
                            {{ $request->patient->navigator->name ?? 'N/A' }}
                            ({{ $request->patient->navigator->navigatorId ?? 'N/A' }})
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Subject</th>
                        <td class="px-4 py-2">{{ $request->subject }}</td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Category</th>
                        <td class="px-4 py-2">{{ $request->category }}</td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Message</th>
                        <td class="px-4 py-2">{{ $request->message }}</td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Priority</th>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded font-semibold text-xs
                                                            {{ $request->priority === 'high' ? 'bg-red-600 text-white' :
        ($request->priority === 'medium' ? 'bg-yellow-400 text-black' : 'bg-green-500 text-black') }}">
                                {{ ucfirst($request->priority) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left px-4 py-2 text-teal-300">Status</th>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded font-semibold text-xs
                                                            {{ $request->status === 'pending' ? 'bg-yellow-400 text-black' :
        ($request->status === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-green-500 text-black') }}">
                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        <form action="{{ route('admin.patient.requests.update', $request->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block font-semibold mb-1">Update Status</label>
                <select name="status" id="status" class="w-full p-2 rounded  text-black">
                    <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $request->status === 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div>
                <label for="response_message" class="block font-semibold mb-1">Response Message</label>
                <textarea name="response_message" id="response_message" rows="4"
                    class="w-full p-2 rounded text-black">{{ old('response_message', $request->response_message) }}</textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded font-semibold">
                    Submit Update
                </button>
            </div>
        </form>
    </div>
@endsection