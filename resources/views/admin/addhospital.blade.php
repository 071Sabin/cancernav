@extends('admin.adminwelcome')
@section('title', '| Add Hospital')

@section('admincontent')
    <div class="lg:w-1/2 w-full mx-auto bg-teal-700 text-teal-300 shadow-lg rounded-lg p-6 my-10">
        <h2 class="text-2xl font-bold text-center text-teal-300 mb-6">Add Hospital</h2>


        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        @if(session('h_success'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('h_success') }}
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

        <form method="POST" action="{{ route('addhospital') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium">Hospital Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full p-2 border border-gray-300 rounded-md text-teal-800 focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- email -->
            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full p-2 border border-gray-300 rounded-md text-teal-800 focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block font-medium">Address</label>
                <input type="text" id="address" name="address" required
                    class="w-full p-2 border border-gray-300 rounded-md text-teal-800 focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block font-medium">City</label>
                <input type="text" id="city" name="city" required
                    class="w-full p-2 border border-gray-300 text-teal-800 rounded-md focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block font-medium">State</label>
                <select id="state" name="state" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
                    <option value="AL">Alabama (AL)</option>
                    <option value="AK">Alaska (AK)</option>
                    <option value="AZ">Arizona (AZ)</option>
                    <option value="AR">Arkansas (AR)</option>
                    <option value="CA">California (CA)</option>
                    <option value="CO">Colorado (CO)</option>
                    <option value="CT">Connecticut (CT)</option>
                    <option value="DE">Delaware (DE)</option>
                    <option value="DC">District Of Columbia (DC)</option>
                    <option value="FL">Florida (FL)</option>
                    <option value="GA">Georgia (GA)</option>
                    <option value="HI">Hawaii (HI)</option>
                    <option value="ID">Idaho (ID)</option>
                    <option value="IL">Illinois (IL)</option>
                    <option value="IN">Indiana (IN)</option>
                    <option value="IA">Iowa (IA)</option>
                    <option value="KS">Kansas (KS)</option>
                    <option value="KY">Kentucky (KY)</option>
                    <option value="LA">Louisiana (LA)</option>
                    <option value="ME">Maine (ME)</option>
                    <option value="MD">Maryland (MD)</option>
                    <option value="MA">Massachusetts (MA)</option>
                    <option value="MI">Michigan (MI)</option>
                    <option value="MN">Minnesota (MN)</option>
                    <option value="MS">Mississippi (MS)</option>
                    <option value="MO">Missouri (MO)</option>
                    <option value="MT">Montana (MT)</option>
                    <option value="NE">Nebraska (NE)</option>
                    <option value="NV">Nevada (NV)</option>
                    <option value="NH">New Hampshire (NH)</option>
                    <option value="NJ">New Jersey (NJ)</option>
                    <option value="NM">New Mexico (NM)</option>
                    <option value="NY">New York (NY)</option>
                    <option value="NC">North Carolina (NC)</option>
                    <option value="ND">North Dakota (ND)</option>
                    <option value="OH">Ohio (OH)</option>
                    <option value="OK">Oklahoma (OK)</option>
                    <option value="OR">Oregon (OR)</option>
                    <option value="PA">Pennsylvania (PA)</option>
                    <option value="RI">Rhode Island (RI)</option>
                    <option value="SC">South Carolina (SC)</option>
                    <option value="SD">South Dakota (SD)</option>
                    <option value="TN">Tennessee (TN)</option>
                    <option value="TX">Texas (TX)</option>
                    <option value="UT">Utah (UT)</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>

            <!-- Contact Number -->
            <div class="mb-4">
                <label for="contact_no" class="block font-medium">Contact Number</label>
                <input type="tel" id="contact_no" name="contact_no" required
                    class="w-full p-2 border border-gray-300 rounded-md text-teal-800 focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Established Date (Optional) -->
            <div class="mb-4">
                <label for="established" class="block  font-medium">Established (Optional)</label>
                <input type="date" id="established" name="established"
                    class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 text-teal-800 focus:ring-blue-400">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-all">
                    Add Hospital
                </button>
            </div>
        </form>
    </div>


@endsection