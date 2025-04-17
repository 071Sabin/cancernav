@extends('admin.adminwelcome')
@section('title', '| Add Diagnosis')

@section('admincontent')
    <div class="w-full lg:w-1/3 mx-auto bg-teal-700 shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-bold text-teal-300 mb-10 text-center">Add Diagnosis</h2>

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

        <form action="{{ route('adddiagnosis') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Diagnosis Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-teal-300">Diagnosis Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
            </div>

            <div class="mb-4">
                <label for="hospitalid" class="block text-sm font-medium text-teal-300">Hospital Name/ID</label>
                <select id="hospitalid" name="hospitalid" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
                    <option value="">-- Select Hospital --</option>
                    @foreach ($availablehospitals as $hospital)
                        <option value="{{ $hospital->id }}">{{ $hospital->name }} ({{ $hospital->hospitalId }})</option>
                    @endforeach
                </select>
            </div>


            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-teal-300">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800"></textarea>
            </div>



            <!-- ICD Code -->
            <div class="mb-4">
                <label for="icd_code" class="block text-sm font-medium text-teal-300">ICD Code</label>
                <input type="text" id="icd_code" name="icd_code"
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
            </div>



            <!-- Treatment Guidelines -->
            <div class="mb-4">
                <label for="treatment_guidelines" class="block text-sm font-medium text-teal-300">Treatment
                    Guidelines</label>
                <textarea id="treatment_guidelines" name="treatment_guidelines" rows="4"
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
                    Add Diagnosis
                </button>
            </div>
        </form>
    </div>

@endsection