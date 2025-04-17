@extends('admin.adminwelcome')
@section('title', '| Add Financial Aids')
@section('admincontent')
    <div class="lg:w-1/2 w-full mx-auto bg-teal-700 text-teal-300 shadow-lg rounded-lg p-6 my-10">
        <h2 class="text-2xl font-bold text-teal-300 mb-4">Add Financial Aid Provider</h2>


        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif


        @if(session('faid_success'))
            <div id="successToast"
                class="fixed top-4 right-4 bg-green-100 text-green-900 border border-green-800 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-500 translate-x-0 opacity-100">
                {{ session('faid_success') }}
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

        <form action="{{ route('addfinancialaid') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <label class="block mb-2 font-semibold text-teal-300">Provider Name</label>
            <input type="text" name="name" required class="w-full p-2 border rounded text-teal-700">

            <!-- Description -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Description</label>
            <textarea name="description" class="w-full p-2 border rounded text-teal-700"></textarea>

            <!-- Contact -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Contact Number</label>
            <input type="text" name="contact" class="w-full p-2 border rounded  text-teal-700">

            <!-- Email -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded text-teal-700">

            <!-- Service Area -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Service Area (Cities-Comma-Separated)</label>
            <input type="text" name="service_area" class="w-full p-2 border rounded text-teal-700"
                placeholder="e.g., California, Texas, Florida">

            <!-- Provider Type -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Provider Type</label>
            <select name="provider_type" class="w-full p-2 border rounded text-teal-700">
                <option value="Government">Government</option>
                <option value="Non-Profit" selected>Non-Profit</option>
                <option value="Private">Private</option>
            </select>

            <!-- Funding Source -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Funding Source</label>
            <div class="flex flex-wrap gap-2 text-teal-300">
                @php
                    $fundingOptions = ['Government', 'Non-Profit', 'Private', 'Crowdfunding', 'Insurance', 'Philanthropy'];
                    $selectedFunding = json_decode(old('funding_source', $aidProvider->funding_source ?? '[]'), true);
                @endphp

                @foreach($fundingOptions as $option)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="funding_source[]" value="{{ $option }}"
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                            {{ in_array($option, $selectedFunding) ? 'checked' : '' }}>
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>


            <!-- Max Assistance Amount -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Max Assistance Amount ($)</label>
            <input type="number" name="max_assistance_amount" step="0.01" class="w-full p-2 border rounded  text-teal-700"
                placeholder="USD">

            <!-- Eligibility Summary -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Eligibility Summary</label>
            <textarea name="eligibility_summary" class="w-full p-2 border rounded  text-teal-700"></textarea>

            <!-- Application Process -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Application Process</label>
            <textarea name="application_process" class="w-full p-2 border rounded  text-teal-700"></textarea>

            <!-- Supported Languages -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Supported Languages</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-teal-300">
                @foreach(['English', 'Spanish', 'French', 'German', 'Chinese', 'Arabic', 'Hindi', 'Portuguese', 'Bengali'] as $language)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="support_languages[]" value="{{ $language }}" class="rounded">
                        <span>{{ $language }}</span>
                    </label>
                @endforeach
            </div>

            <!-- Hours of Operation -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Hours of Operation</label>
            <select name="hours_of_operation" class="w-full p-2 border rounded text-teal-700">
                <option value="24/7">24/7</option>
                <option value="Mon-Fri, 9AM-5PM">Mon-Fri, 9AM-5PM</option>
                <option value="Mon-Sat, 10AM-6PM">Mon-Sat, 10AM-6PM</option>
                <option value="Weekends Only">Weekends Only</option>
            </select>

            <!-- Social Media Links -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Social Media Links</label>

            <div class="space-y-2 text-teal-700">
                <input type="text" name="social_media[Facebook]" class="w-full p-2 border rounded"
                    placeholder="Facebook URL">
                <input type="text" name="social_media[Twitter]" class="w-full p-2 border rounded" placeholder="Twitter URL">
                <input type="text" name="social_media[LinkedIn]" class="w-full p-2 border rounded"
                    placeholder="LinkedIn URL">
                <input type="text" name="social_media[Instagram]" class="w-full p-2 border rounded"
                    placeholder="Instagram URL">
            </div>

            <!-- Logo Upload -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">Upload Logo</label>
            <input type="file" name="logo" accept="image/*" class="w-full p-2 border rounded bg-gray-100 text-gray-700">


            <!-- API URL -->
            <label class="block mt-4 mb-2 font-semibold text-teal-300">API URL (Optional)</label>
            <input type="text" name="apiurl" class="w-full p-2 border rounded text-teal-700" placeholder="Https://">

            <!-- Submit Button -->
            <button type="submit" class="w-full mt-6 bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">Save
                Provider</button>
        </form>
    </div>
@endsection