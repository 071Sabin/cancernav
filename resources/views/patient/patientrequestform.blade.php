@extends('patient.patientwelcome')
@section('title', '| Request Form')

@section('patientcontent')

    <div class="flex flex-col gap-8 mx-auto mt-3 bg-gray-100 my-10 p-6 rounded-xl w-full">
        <div class="lg:w-1/3 w-full mx-auto bg-white text-gray-700 p-6 rounded-lg shadow-md mt-10">
            <h2 class="text-2xl font-bold text-center mb-6 border-b border-gray-500 pb-2">Submit a Social Needs Request</h2>

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

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Subject -->
                <label class="block mb-2 font-semibold">Subject</label>
                <input type="text" name="subject" required
                    class="w-full p-2 mb-4 border border-slate-600 rounded placeholder-slate-400"
                    placeholder="e.g., Request additional transport support">

                <!-- Request Type -->
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium">Category</label>
                    <select id="category" name="category" required
                        class="w-full p-2 border rounded-md text-gray-800 bg-white">
                        <option value="">Select a need</option>
                        <option value="transport">Transportation Assistance</option>
                        <option value="housing">Housing Support</option>
                        <option value="financial_aid">Financial Assistance</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-2">
                    <label for="message" class="block text-sm font-medium">Description</label>
                    <textarea id="message" name="message" rows="4" required
                        class="w-full p-2 border rounded-md text-gray-800 bg-white"
                        placeholder="write short and straight message for faster assistance..."></textarea>
                </div>

                <!-- Priority -->
                <label class="block mb-2 font-semibold">Priority</label>
                <select name="priority" class="w-full p-2 mb-6 rounded">
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit"
                        class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 transition">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>

        <hr>
        {{-- show the respective Patient requests to Navigator --}}
        <div class="bg-gray-200 p-6 rounded-lg shadow-lg text-gray-800 w-full mt-10 mx-auto">
            <h2 class="text-2xl font-bold border-b border-slate-600 pb-2 mb-4">Your Requests to Navigtor</h2>
            <p class="text-xs mb-5"><em>the index green colored background indicates that navigator read your request!</em>
            </p>
            @if($requests->isEmpty())
                <p class="text-slate-200 text-center bg-gray-700 p-2 text-sm rounded">You haven't submitted any requests yet.
                </p>
            @else

                <div class="overflow-x-auto">
                    <div class="flex flex-col lg:flex-row gap-2 lg:gap-4 w-fit">
                        <div
                            class="bg-yellow-100 text-yellow-800 border border-yellow-800 rounded-md px-3 py-2 shadow-sm text-xs font-medium">
                            Pending: {{ $requests->where('status', 'pending')->count() }}
                        </div>
                        <div
                            class="bg-blue-100 text-blue-800 border border-blue-800 rounded-md px-3 py-2 shadow-sm text-xs font-medium">
                            In Progress: {{ $requests->where('status', 'in_progress')->count() }}
                        </div>
                        <div
                            class="bg-green-100 text-green-800 border border-green-800 rounded-md px-3 py-2 shadow-sm text-xs font-medium">
                            Completed: {{ $requests->where('status', 'completed')->count() }}
                        </div>
                    </div>

                    <table class="w-full text-sm text-left border border-slate-600 mt-5">
                        <thead class="bg-slate-700 text-slate-300 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Subject</th>
                                <th class="px-4 py-2">Category</th>
                                <th class="px-4 py-2">Priority</th>
                                <th class="px-4 py-2">Status</th>

                                <th class="px-4 py-2">Reply</th>
                                <th class="px-4 py-2">Date</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach($requests as $index => $req)
                                <tr class="border-t border-slate-600 hover:bg-gray-100 bg-white">
                                    <td class="px-4 py-2 {{ $req->seen_by_recipient ? 'bg-green-100 text-green-900' : '' }}">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-4 py-2">{{ $req->subject }}</td>
                                    <td class="px-4 py-2 capitalize">{{ $req->category }}</td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="px-2 py-1 rounded text-white {{ $req->priority === 'high' ? 'bg-red-600' : ($req->priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600') }}">
                                            {{ ucfirst($req->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <span
                                            class="px-2 py-1 rounded {{ $req->status === 'pending' ? 'bg-yellow-600 text-white' : ($req->status === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white') }}">
                                            {{ ucfirst(str_replace('_', ' ', $req->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 capitalize">{{ $req->response_message }}</td>
                                    <td class="px-4 py-2 text-slate-700">
                                        {{ $req->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection