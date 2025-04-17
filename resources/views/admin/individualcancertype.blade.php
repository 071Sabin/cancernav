@extends('admin.adminwelcome')
@section('title', '| Individual Cancer Type')

@section('admincontent')
    <div class="p-6 bg-slate-800 rounded-lg">


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

        <div class="flex flex-col lg:flex-row gap-6 mt-5">

            {{-- Left Side: Table --}}
            <div class="w-full lg:w-1/2 bg-teal-700 p-4 rounded-lg overflow-auto">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-teal-300">Cancer Type Details</h2>
                <table class="w-full text-sm text-left text-teal-300 border border-teal-600">
                    <tbody class="divide-y divide-teal-600">
                        <tr>
                            <th class="px-3 py-2 text-teal-100 w-1/3">Name</th>
                            <td class="px-3 py-2 text-white">{{ $cancertypedetail->name }}</td>
                        </tr>
                        <tr>
                            <th class="px-3 py-2 text-teal-100 w-1/3">Hospital Name</th>
                            <td class="px-3 py-2 text-white">{{ $cancertypedetail->hospital->name }}
                                ({{ $cancertypedetail->hospital->hospitalId }})</td>
                        </tr>
                        <tr>
                            <th class="px-3 py-2 text-teal-100">ICD Code</th>
                            <td class="px-3 py-2 text-white">{{ $cancertypedetail->icd_code }}</td>
                        </tr>
                        <tr>
                            <th class="px-3 py-2 text-teal-100">Description</th>
                            <td class="px-3 py-2 text-white">{{ Str::limit($cancertypedetail->description) }}</td>
                        </tr>
                        <tr>
                            <th class="px-3 py-2 text-teal-100">Treatment Guidelines</th>
                            {{-- the last 50 is the limit how much character to show, we are showing 50 characters and after that it will show dots.... --}}
                            <td class="px-3 py-2 text-white">{{ Str::limit($cancertypedetail->treatment_guidelines, 50) }}
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            {{-- Right Side: Update Form --}}
            <div class="w-full lg:w-1/2 bg-teal-700 p-4 rounded-lg">
                <h2 class="text-2xl font-bold mb-4 border-b pb-2 text-teal-300">Update Cancer Details</h2>

                <form method="POST" action="{{ route('cancer-types.update', $cancertypedetail->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-teal-300 mb-1">Cancer Type Name</label>
                        <input type="text" name="name" value="{{ $cancertypedetail->name }}"
                            class="w-full p-2 rounded text-black">
                    </div>

                    <div class="mb-4">
                        <label class="block text-teal-300 mb-1">ICD Code</label>
                        <input type="text" name="icd_code" value="{{ $cancertypedetail->icd_code }}"
                            class="w-full p-2 rounded text-black">
                    </div>

                    <div class="mb-4">
                        <label class="block text-teal-300 mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full p-2 rounded text-black">{{ $cancertypedetail->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-teal-300 mb-1">Treatment Guidelines</label>
                        <textarea name="treatment_guidelines" rows="3"
                            class="w-full p-2 rounded text-black">{{ $cancertypedetail->treatment_guidelines }}</textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </form>
            </div>
        </div>
    </div>



@endsection