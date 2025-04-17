@extends('admin.adminwelcome')
@section('title', '| Individual Hospital')

@section('admincontent')
    <div class="container mx-auto mt-6 p-6 bg-slate-800 shadow-lg rounded-lg">
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
        <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-8">
            {{-- Hospital Details --}}

            <div class="overflow-x-auto bg-teal-800 p-6 rounded-lg shadow-md">
                <h3 class="text-3xl font-semibold text-teal-300 border-b border-teal-600 pb-2 mb-4">Hospital Details</h3>

                <table class="min-w-full border border-teal-600 text-left text-sm">
                    <tbody class="text-white">
                        <tr class="border-b border-teal-600">
                            <th class="text-teal-300 px-4 py-2 w-1/3">Hospital ID</th>
                            <td class="px-4 py-2">{{ $hospitaldetails->id }}</td>
                        </tr>
                        <tr class="border-b border-teal-600">
                            <th class="text-teal-300 px-4 py-2">Hospital Name</th>
                            <td class="px-4 py-2">{{ Str::title($hospitaldetails->name) }}
                                ({{ $hospitaldetails->hospitalId }})
                            </td>
                        </tr>
                        <tr class="border-b border-teal-600">
                            <th class="text-teal-300 px-4 py-2">Email</th>
                            <td class="px-4 py-2">{{ $hospitaldetails->email }}</td>
                        </tr>
                        <tr class="border-b border-teal-600">
                            <th class="text-teal-300 px-4 py-2">Phone</th>
                            <td class="px-4 py-2">{{ $hospitaldetails->contact_no }}</td>
                        </tr>
                        <tr class="border-b border-teal-600">
                            <th class="text-teal-300 px-4 py-2">Address</th>
                            <td class="px-4 py-2">{{ $hospitaldetails->address }}</td>
                        </tr>
                        <tr class="">
                            <th class="text-teal-300 px-4 py-2 align-top">Diagnosis Available</th>

                            @if($hospitaldetails->diagnosis->isNotEmpty())
                                <td class="px-4 py-2"> {{ $hospitaldetails->diagnosis->pluck('name')->implode(', ') }}</td>
                            @else
                                <td class="px-4 py-2 text-red-900 bg-red-100">
                                    No diagnosis information available for this hospital.

                                </td>
                            @endif

                        </tr>
                    </tbody>
                </table>
            </div>



            <!-- Update Form -->
            <div class="bg-teal-800 p-6 rounded-lg flex-1">
                <h3 class="text-2xl font-semibold text-teal-300 border-b pb-2 mb-4">Update Hospital</h3>
                <form action="{{ route('hospital.update', $hospitaldetails->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-teal-300 font-semibold">Hospital Name</label>
                        <input type="text" name="name" value="{{ old('name', $hospitaldetails->name) }}"
                            class="w-full p-2 border rounded-md text-gray-800">
                    </div>

                    <div class="mb-4">
                        <label class="block text-teal-300 font-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email', $hospitaldetails->email) }}"
                            class="w-full p-2 border rounded-md text-gray-800">
                    </div>

                    <div class="mb-4">
                        <label class="block text-teal-300 font-semibold">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $hospitaldetails->contact_no) }}"
                            class="w-full p-2 border rounded-md text-gray-800">
                    </div>

                    <div class="mb-4">
                        <label class="block text-teal-300 font-semibold">Address</label>
                        <input type="text" name="address" value="{{ old('address', $hospitaldetails->address) }}"
                            class="w-full p-2 border rounded-md text-gray-800">
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Update Details
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>




@endsection