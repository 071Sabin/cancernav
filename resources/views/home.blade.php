@extends('welcome')

@section('content')
    {{-- below nav bar, the whole section with BG --}}
    <section class="bg-white py-12 px-4 sm:px-6 lg:px-8 h-screen relative overflow-hidden">
        <!-- Blurred Background -->
        <div class="absolute inset-0 bg-gradient-to-r from-pink-300 to-blue-800 opacity-50 filter blur-3xl"></div>

        <div class="max-w-7xl mx-auto h-full flex flex-col justify-center items-center relative z-10">
            <div class="text-center items-center">
                <h2 class="text-4xl font-extrabold text-gray-900 sm:text-4xl">
                    Breaking Barriers to Cancer Care
                </h2>
                <p class="mt-4 text-lg text-slate-600">
                    No one should struggle to get the care they need because of transportation, financial worries, or lack
                    of support.<br>Here, we make it simple for cancer patients to find rides, secure financial
                    aid, access housing, and get essential support—all in one place.<br>Our platform connects you to
                    real-time
                    assistance, eliminating delays and stress so you can focus on what truly matters: your
                    health.<br>Whether
                    you're a patient, caregiver, or navigator, we're here to ensure that help is just a click away.


                </p>
                <div class="mt-6">
                    <a href="#"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded transition duration-300 hover:bg-blue-700">Get
                        Started</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ABOUT US --}}
    <section class="aboutus py-10 bg-white" id="aboutus">
        <h2 class="text-4xl text-center font-bold">About Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10">

            <div class="flex flex-col lg:shadow-2xl shadow-lg mx-10 p-5 mt-5 lg:mt-0 rounded-lg">
                <p class="font-semibold text-2xl text-center">Bridging the Gap in Cancer Care</p>
                <img src="{{ asset('src_images/bridge.png') }}" alt="About Us" class="mx-auto h-60 my-5">
                <p class="">
                    Here, we are dedicated to ensuring that no cancer patient misses care due to social barriers like
                    transportation, financial struggles, or lack of housing. Our platform streamlines social needs
                    screening, making it faster and more efficient for both patients and cancer navigators.
                </p>
            </div>

            <div class="flex flex-col lg:shadow-2xl shadow-sm mx-10 p-5 mt-5 lg:mt-0 rounded-lg">
                <p class="font-semibold text-2xl text-center">Empowering Cancer Navigators with Automation</p>
                <img src="{{ asset('src_images/automation.png') }}" alt="About Us" class="mx-auto h-60 my-5">
                <p class="">Cancer navigators play a crucial role in guiding patients through the healthcare system, but
                    manual processes slow them down. Our AI-powered platform automatically connects patients to the right
                    support services—reducing delays, eliminating unnecessary phone calls, and allowing navigators to focus
                    on the most urgent cases.

                </p>
            </div>

            <div class="flex flex-col lg:shadow-2xl shadow-sm mx-10 p-5 mt-5 lg:mt-0 rounded-lg">
                <p class="font-semibold text-2xl text-center">A Smarter Way to Access Support</p>
                <img src="{{ asset('src_images/support.png') }}" alt="About Us" class="mx-auto h-60 my-5">
                <p class="">Getting the right support during cancer treatment shouldn't be complicated. Our platform
                    makes it quick and easy to find help when you need it most. Whether you need a ride to the hospital,
                    financial assistance, a safe place to stay, or help with meals, we connect you to available services
                    instantly—without endless phone calls or paperwork. We take care of the details, so you can focus on
                    your health and well-being.

                </p>
            </div>
        </div>
    </section>



    {{-- SERVICES --}}
    <section class="bg-gray-100 py-16" id="services">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Our Services</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We provide personalized navigation services to ensure every patient gets the care and support they need
                    throughout their cancer journey.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-8 text-center">

                <!-- Service 1: Social Needs Assessment -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Social Needs Assessment</h3>
                    <p class="text-gray-600">
                        We identify barriers to care, including transportation, financial challenges, and housing needs, and
                        connect patients to relevant support services.
                    </p>
                </div>

                <!-- Service 2: Care Coordination -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Care Coordination</h3>
                    <p class="text-gray-600">
                        Our navigators help schedule medical appointments, coordinate treatments, and ensure timely access
                        to essential cancer care services.
                    </p>
                </div>

                <!-- Service 3: Financial & Insurance Assistance -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Financial & Insurance Assistance</h3>
                    <p class="text-gray-600">
                        We guide patients through financial aid programs, insurance paperwork, and available resources to
                        ease the burden of medical expenses.
                    </p>
                </div>

                <!-- Service 4: Patient Education & Advocacy -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Patient Education & Advocacy</h3>
                    <p class="text-gray-600">
                        We empower patients with knowledge about their diagnosis, treatment options, and rights to help them
                        make informed healthcare decisions.
                    </p>
                </div>

                <!-- Service 5: Emotional & Peer Support -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Emotional & Peer Support</h3>
                    <p class="text-gray-600">
                        Our team connects patients with counseling services, support groups, and community resources to
                        ensure emotional well-being.
                    </p>
                </div>

                <!-- Service 6: Survivorship & Follow-Up Care -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Survivorship & Follow-Up Care</h3>
                    <p class="text-gray-600">
                        We assist in post-treatment care, including follow-up visits, lifestyle adjustments, and long-term
                        wellness planning.
                    </p>
                </div>

            </div>
        </div>
    </section>



@endsection