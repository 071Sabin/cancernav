@extends('admin.adminwelcome')

@section('title', '| Individual Nav Requests')


@section('admincontent')
    <div class="max-w-3xl mx-auto mt-10 bg-teal-800 p-6 rounded-lg shadow text-teal-100 text-sm">
        <h2 class="text-xl font-bold mb-4 border-b border-teal-700 pb-2">Update Navigator Request</h2>

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

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <tbody class="text-teal-300 border border-teal-700 dark:border dark:border-teal-300">
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold w-1/4">Navigator Name</th>
                        <td class="px-4 py-3">{{ $request->navigator->name }}</td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Navigator ID</th>
                        <td class="px-4 py-3">{{ $request->navigator->navigatorId }} ({{ $request->navigator->id }})</td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Hospital</th>
                        <td class="px-4 py-3">
                            {{ $request->navigator->hospital->name ?? 'N/A' }}
                            ({{ $request->navigator->hospital->hospitalId ?? 'N/A' }})
                        </td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Subject</th>
                        <td class="px-4 py-3">{{ $request->subject }}</td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Category</th>
                        <td class="px-4 py-3">{{ $request->category }}</td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Message</th>
                        <td class="px-4 py-3">{{ $request->message }}</td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Priority</th>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-sm font-semibold {{ $request->priority === 'high' ? 'bg-red-100 text-red-900' :
        ($request->priority === 'medium' ? 'bg-yellow-100 text-yellow-900' : 'bg-green-100 text-green-900') }}">
                                {{ ucfirst($request->priority) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b border-teal-700 dark:border dark:border-teal-300">
                        <th class="px-4 py-3  text-teal-300 font-semibold">Status</th>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-sm font-semibold  {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-900' :
        ($request->status === 'in_progress' ? 'bg-blue-100 text-blue-900' : 'bg-green-200 text-green-900') }}">
                                {{ ucfirst(str_replace('_', ' ', $request->status)) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        <form action="{{ route('admin.navigator.requests.update', $request->id) }}" method="POST" class="space-y-4">
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