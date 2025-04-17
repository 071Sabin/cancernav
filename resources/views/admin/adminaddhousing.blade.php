@extends('admin.adminwelcome')
@section('title', '| Add Housing')
@section('admincontent')
    <div class="w-full lg:w-1/2 mx-auto bg-teal-700 shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-2xl font-bold text-teal-300 mb-6 text-center">Add Housing Provider</h2>

        @if(session('housingsuccess'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('housingsuccess') }}
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

        <form action="{{ route('addhousing') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Housing Provider Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-teal-300">Housing Provider Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-teal-300">City</label>
                <input type="text" id="city" name="city" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block text-sm font-medium text-teal-300">State</label>
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

            <!-- Availability -->
            <div class="mb-4">
                <label for="availability" class="block text-sm font-medium text-teal-300">Availability</label>
                <select id="availability" name="availability" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>

            <!-- Accessibility Features -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-teal-300">Accessibility Features</label>
                <div class="flex gap-4 text-teal-300">
                    <label><input type="checkbox" name="has_wheelchair_access" value="1" class="mr-2"> Wheelchair
                        Access</label>
                    <label><input type="checkbox" name="has_caregiver_support" value="1" class="mr-2"> Caregiver
                        Support</label>
                </div>
            </div>

            <!-- Contact Details -->
            <div class="mb-4">
                <label for="contact" class="block text-sm font-medium text-teal-300">Contact Number</label>
                <input type="text" id="contact" name="contact" required
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
            </div>

            <!-- Website URL -->
            <div class="mb-4">
                <label for="url" class="block text-sm font-medium text-teal-300">Website/api url(optional)</label>
                <input type="text" id="url" name="url"
                    class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-teal-800">
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition">
                    Add Housing Provider
                </button>
            </div>
        </form>
    </div>
@endsection