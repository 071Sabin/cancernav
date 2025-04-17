{{-- this will show all the requests from patients to navigator --}}
@extends('navigator.navwelcome')

@section('title', '| Nav Requests')



@section('navigatorcontent')

    <div class="bg-slate-800 p-6 rounded-lg shadow-md w-full lg:w-3/4 mx-auto text-slate-300">
        <h2 class="text-2xl font-bold mb-4 border-b border-slate-600 pb-2">Send Request to Admin</h2>


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

        <form action="{{ route('nav.nav2adminrequest') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Subject -->
            <label class="block mb-2 font-semibold">Subject</label>
            <input type="text" name="subject" required
                class="w-full p-2 mb-4 border border-slate-600 rounded bg-slate-700 text-white placeholder-slate-400"
                placeholder="e.g., Request additional transport support">

            <!-- Category -->
            <label class="block mb-2 font-semibold">Category</label>
            <select name="category" class="w-full p-2 mb-4 border border-slate-600 rounded bg-slate-700 text-white">
                <option value="" selected disabled>-- Select option --</option>
                <option value="transport">Transport</option>
                <option value="housing">Housing</option>
                <option value="financial_aid">Financial Aid</option>
                <option value="diagnosis">Diagnosis</option>
                <option value="technical">Technical</option>
                <option value="other">Other</option>
            </select>

            <!-- Message -->
            <label class="block mb-2 font-semibold">Message</label>
            <textarea name="message" required rows="4"
                class="w-full p-2 mb-4 border border-slate-600 rounded bg-slate-700 text-white placeholder-slate-400"
                placeholder="Describe your issue or request in detail..."></textarea>

            <!-- Priority -->
            <label class="block mb-2 font-semibold">Priority</label>
            <select name="priority" class="w-full p-2 mb-6 border border-slate-600 rounded bg-slate-700 text-white">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
            </select>


            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow">
                    Submit Request
                </button>
            </div>
        </form>
    </div>


    {{-- display all the requests from navigator to admin --}}
    <div class="bg-slate-800 p-6 rounded-lg shadow-lg text-slate-300 w-full mt-10 mx-auto">
        <h2 class="text-2xl font-bold border-b border-slate-600 pb-2 mb-4">Your Requests to Admin</h2>

        @if($requests->isEmpty())
            <p class="text-slate-400 text-center bg-slate-900 p-2 text-sm rounded">You haven't submitted any requests yet.</p>
        @else
            <div class="overflow-x-auto">
                <p class="text-slate-300 mb-3"><em>The green bg on index shows Admin read and responsed to your request!</em>
                </p>
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
                <table class="w-full text-xs text-left border border-slate-600 mt-5">
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
                    <tbody class="text-white">
                        @foreach($requests as $index => $req)
                            <tr class="border-t border-slate-600 hover:bg-slate-700">
                                <td class="px-4 py-2 {{ $req->seen_by_recipient ? 'bg-green-100 text-green-900' : '' }}">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-4 py-2">{{ $req->subject }}</td>
                                <td class="px-4 py-2 capitalize">{{ $req->category }}</td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-1 rounded {{ $req->priority === 'high' ? 'bg-red-600' : ($req->priority === 'medium' ? 'bg-yellow-600' : 'bg-green-600') }}">
                                        {{ ucfirst($req->priority) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 text-center py-1 rounded {{ $req->status === 'pending' ? 'bg-yellow-600' : ($req->status === 'in_progress' ? 'bg-blue-600' : 'bg-green-600') }}">
                                        {{ ucfirst(str_replace('_', ' ', $req->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 capitalize">{{ $req->response_message }}</td>
                                <td class="px-4 py-2 text-slate-300">
                                    {{ $req->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>



@endsection