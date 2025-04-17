@extends('navigator.navwelcome')
@section('title', '| Add Patient')

@section('navigatorcontent')

    <div class="max-w-4xl mx-auto bg-slate-700 p-8 rounded-lg my-10">
        <h2 class="text-2xl text-center font-bold underline text-slate-300">Patient Information Form</h2>
        <p><em class=" text-gray-200 text-sm"><strong>NOTE: </strong>While adding patient's/doctor's name you can add all in
                lower case Eg:
                david miller will be displayed as David Miller...</em></p>


        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        @if(session('p_success'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('p_success') }}
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

        @if($cancertypes->isEmpty())
            <div class="bg-red-100 text-red-800 p-3 rounded-md mb-4 border-2 border-red-800">
                No cancertypes are available! Admin Needs to Add these to add patient!
            </div>
            {{-- <p><a href="{{ route('addhospital') }}" class="bg-blue-600 px-3 py-2 rounded text-white w-fit">Add
            Hospitals</a></p> --}}

        @else

            <form action="{{ route('nav.show_addpatient') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                @csrf

                <div>
                    <label class="block text-slate-300 font-semibold">Hospital</label>
                    <select name="hospitalId" id="hospitalId" class="w-full p-2 border rounded-md"
                        onchange="updateHospitalName()">
                        <option value="" disabled selected>-- Select Hospital --</option>
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

                <div>
                    <label class="block text-slate-300 font-semibold">Patient Name</label>
                    <input type="text" name="name" class="w-full p-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold">Doctor Name</label>
                    <input type="text" name="doctorname" class="w-full p-2 border rounded-md">
                </div>


                <div class="bg-slate-800 rounded-md">
                    <!-- Gender Label -->
                    <p class="text-slate-300 font-semibold mb-2 text-center">Gender</p>

                    <!-- Radio Buttons -->
                    <div class="flex items-center justify-center space-x-4">
                        <label class="flex items-center space-x-2 text-slate-300">
                            <input type="radio" name="gender" value="m" {{ old('gender') == 'm' ? 'checked' : '' }}
                                class="w-4 h-4 text-slate-300 border-slate-300 focus:ring-slate-300">
                            <span>Male</span>
                        </label>

                        <label class="flex items-center space-x-2 text-slate-300">
                            <input type="radio" name="gender" value="f" {{ old('gender') == 'f' ? 'checked' : '' }}
                                class="w-4 h-4 text-slate-300 border-slate-300 focus:ring-slate-300">
                            <span>Female</span>
                        </label>

                        <label class="flex items-center space-x-2 text-slate-300">
                            <input type="radio" name="gender" value="o" {{ old('gender') == 'o' ? 'checked' : '' }}
                                class="w-4 h-4 text-slate-300 border-slate-300 focus:ring-slate-300">
                            <span>Other</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Date of Birth</label>
                    <input type="date" name="dateofbirth" class="w-full p-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold">SSN</label>
                    <input type="text" name="ssn" class="w-full p-2 border rounded-md placeholder:text-sm"
                        placeholder="Social-Security-Number">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded-md" required>
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Password</label>

                    <input type="password" name="password" id="password" class="w-full p-2 border rounded-md pr-10"
                        placeholder="Enter password">

                    <button type="button" onclick="togglePassword()" class=" flex items-center px-2 text-gray-200">
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
                <div>
                    <label class="block text-slate-300 font-semibold">Phone</label>
                    <input type="text" name="phone" class="w-full p-2 border rounded-md">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-slate-300 font-semibold">Address</label>
                    <input type="text" name="address" class="w-full p-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-slate-300 font-semibold">City</label>
                    <input type="text" name="city" class="w-full p-2 border rounded-md">
                </div>
                <!-- State -->
                <div class="mb-4">
                    <label for="state" class="block text-sm font-medium text-slate-300">State</label>
                    <select id="state" name="state" required
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-slate-800">
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
                <div>
                    <label class="block text-slate-300 font-semibold">Zip Code</label>
                    <input type="text" name="zipcode" class="w-full p-2 border rounded-md">
                </div>


                <div>
                    <label class="block text-slate-300 font-semibold">Cancer Type</label>
                    <select name="cancertype" id="cancertype" class="w-full p-2 border rounded-md">
                        <option disabled selected>-- Select Cancer Type --</option>
                        @foreach($cancertypes as $cancer)
                            <option value="{{ $cancer->name }}" {{ old('cancertype') == $cancer->name ? 'selected' : '' }}>
                                {{ $cancer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-4 md:col-span-2">
                    <label for="treatment_stage" class="block text-md font-semibold text-slate-300">Treatment Stage</label>
                    <select id="treatment_stage" name="treatment_stage[]" multiple required
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-slate-800">
                        <option value="diagnosis">Diagnosis & Staging</option>
                        <option value="pre-treatment">Pre-Treatment</option>
                        <option value="active-treatment">Active Treatment</option>
                        <option value="post-treatment">Post-Treatment & Surveillance</option>
                        <option value="palliative-care">Palliative/Supportive Care</option>
                    </select>
                </div>


                <div class="">
                    <label for="treatment_closed" class="block text-slate-300 font-semibold">Treatment Closed</label>
                    <select id="treatment_closed" name="treatment_closed" required
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 bg-white text-slate-800">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="insurance_status" class="block text-md font-semibold text-slate-300">Insurance Status</label>
                    <select id="insurance_status" name="insurance_status" required
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-slate-800 ">
                        <option value="Insured">Insured</option>
                        <option value="Uninsured">Uninsured</option>
                        <option value="Medicaid">Medicaid</option>
                        <option value="Medicare">Medicare</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="employment_status" class="block text-md text-slate-300 font-semibold">Employment Status</label>
                    <select id="employment_status" name="employment_status" required
                        class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300 text-slate-800 ">
                        <option value="Employed">Employed</option>
                        <option value="Unemployed">Unemployed</option>
                        <option value="Disabled">Disabled</option>
                        <option value="Retired">Retired</option>
                    </select>
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Insurance Provider</label>
                    <input type="text" name="insuranceProvider" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Insurance Policy Number</label>
                    <input type="text" name="insurance_policy_number" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Yearly Income (USD$)</label>
                    <input type="number" name="yearly_income" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Income Source</label>
                    <input type="text" name="income_source" class="w-full p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-slate-300 font-semibold">Emergency Contact</label>
                    <input type="text" name="emergency_contact" class="w-full p-2 border rounded-md">
                </div>

                <div class="md:col-span-2 mt-3">
                    <label class="block text-slate-300 font-semibold">Profile Picture</label>
                    <em class="text-gray-200 text-sm">Accepted: jpeg, png, jpg, gif</em>
                    <input type="file" name="profile_pic" class="w-full p-2 border rounded-md text-white">
                </div>

                <div class="md:col-span-2 mt-3">
                    <label class="block text-slate-300 font-semibold">Bank Statements</label>
                    <em class="text-gray-200 text-sm">Accepted: pdf, jpg, png</em>
                    <input type="file" name="bank_statements" class="w-full p-2 border rounded-md text-white">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-slate-300 font-semibold">Government ID (Driving License, Social Security
                        Card,
                        Passport)</label>
                    <em class="text-gray-200 text-sm">Accepted: pdf, jpg, png</em>
                    <input type="file" name="government_id" class="w-full p-2 border rounded-md text-white">
                </div>

                <div class="w-full">
                    <button type="submit"
                        class="bg-blue-500 text-white font-semibold px-6 py-2 w-full rounded-md hover:bg-blue-600">Submit</button>
                </div>
            </form>
        @endif
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";  // Show password
                eyeIcon.innerHTML = `<path fill-rule="evenodd" d="M10 3c-4.418 0-8 5.373-8 7 0 1.627 3.582 7 8 7s8-5.373 8-7c0-1.627-3.582-7-8-7zm0 12c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5zM10 7c-1.104 0-2 .897-2 2s.896 2 2 2 2-.897 2-2-.896-2-2-2z"  clip-rule="evenodd"/>`;
            } else {
                passwordField.type = "password";  // Hide password
            }
        }

    </script>
@endsection