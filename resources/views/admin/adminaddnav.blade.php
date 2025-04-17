@extends('admin.adminwelcome')
@section('title', '| Add Navigator')
@section('admincontent')
    <div class="lg:w-1/3 w-full mx-auto bg-teal-700 shadow-lg  rounded-lg p-6 my-10">
        <h2 class="text-2xl font-bold text-teal-300 mb-4 text-center">Add Navigator</h2>


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

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('show_addnavigator') }}" enctype="multipart/form-data">
            @csrf

            <!-- Hospital ID -->
            <div>
                <label class="block text-teal-300 font-medium">Hospital ID</label>
                <select name="hospitalId" id="hospitalId" class="w-full p-2 border rounded-md">
                    <option value="" disabled selected>Select Hospital</option>
                    <!-- Dynamically populate options from the database -->
                    @foreach($hospitals as $hospital)
                        <option value="{{ $hospital->id }}" data-name="{{ $hospital->name }}">
                            {{ $hospital->hospitalId }},
                            {{ $hospital->name }}
                        </option>
                        <hr>
                    @endforeach
                </select>
            </div>
            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-teal-300 font-medium">Full Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-teal-300 font-medium">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-teal-300 font-medium">Phone Number</label>
                <input type="tel" id="phone" name="phone" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Profile Picture Upload -->
            <div class="mb-4">
                <label for="profile_pic" class="block text-teal-300 font-medium">Profile Picture</label>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*"
                    class="w-full p-2 border border-gray-300 rounded-md text-teal-300">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-teal-300">Password</label>

                <input type="password" name="password" id="password" class="w-full p-2 border rounded-md pr-10"
                    placeholder="Enter password">

                <button type="button" onclick="togglePassword()" class=" flex items-center px-2 text-teal-300">
                    <!-- Eye Icon -->
                    <p>View Password</p>
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3c-4.418 0-8 5.373-8 7 0 1.627 3.582 7 8 7s8-5.373 8-7c0-1.627-3.582-7-8-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zM10 7c-1.104 0-2 .897-2 2s.896 2 2 2 2-.897 2-2-.896-2-2-2z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-all">
                    Add Navigator
                </button>
            </div>
        </form>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";  // Show password
                eyeIcon.innerHTML = `<path fill-rule="evenodd" d="M10 3c-4.418 0-8 5.373-8 7 0 1.627 3.582 7 8 7s8-5.373 8-7c0-1.627-3.582-7-8-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zM10 7c-1.104 0-2 .897-2 2s.896 2 2 2 2-.897 2-2-.896-2-2-2z" clip-rule="evenodd"/>`;
            } else {
                passwordField.type = "password";  // Hide password
            }
        }
    </script>

@endsection