@extends('admin.adminwelcome')
@section('title', '| Add Transports')
@section('admincontent')
    <div class="lg:w-1/3 w-full mx-auto bg-teal-700 shadow-lg rounded-lg p-6 my-10 text-teal-300">
        <h2 class="text-2xl font-bold text-teal-300 mb-4 text-center">Add Transport Details</h2>

        @if(session('transport_success'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('transport_success') }}
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
        <form action="{{ route('addtransport') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="mb-4">
                <label class="block  dark:text-white">Transport Name</label>
                <input type="text" name="name"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 text-teal-800 focus:ring-blue-300"
                    required>
            </div>

            <div class="mb-4">
                <label class="block ">City</label>
                <input type="text" name="city"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 text-teal-800 focus:ring-blue-300"
                    required>
            </div>
            <div class="mb-4">
                <label class="block ">Provider URL(website)</label>
                <input type="url" name="providerurl" id='url' placeholder="Https://"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 text-teal-800 focus:ring-blue-300"
                    required>
            </div>

            <div class="mb-4">
                <label class="block ">API URL(website)</label>
                <input type="text" name="apiurl" id='url' placeholder="Https://"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 text-teal-800 focus:ring-blue-300"
                    required>
            </div>

            <div class="mb-4">
                <label class="block ">Availability</label>
                <select name="availability"
                    class="w-full p-2 border rounded-md focus:outline-none text-teal-800 focus:ring-2 focus:ring-blue-300">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block ">Number of Wheelchairs</label>
                <input type="number" name="num_wheelchairs" min="0"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 text-teal-800 focus:ring-blue-300"
                    required>
            </div>

            <div class="mb-4">
                <label class="block ">Number of Caregivers</label>
                <input type="number" name="num_caregivers" min="0"
                    class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 text-teal-800 focus:ring-blue-300"
                    required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md  hover:bg-blue-700 transition">
                Save Transport Details
            </button>
        </form>
    </div>
@endsection