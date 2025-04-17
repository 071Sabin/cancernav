<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abcHeal @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrapIcons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="h-screen ">
    {{-- NAV BAR --}}

    <nav class="bg-white border-gray-200 text-pink-500
    dark:bg-gray-900 w-full z-20 shadow-2xl">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap flex items-center">abcHeal <img
                        src="{{ asset('src_images/logo.png') }}" alt="cancer Logo" class="h-7"></span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href=""
                            class="block py-2 px-3  bg-blue-700 rounded md:bg-transparent md:p-0 md:hover:text-pink-700"
                            aria-current="page">Home</a>
                    </li>

                    <li>
                        <a href="#aboutus"
                            class="block py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                    </li>
                    <li>
                        <a href="#services"
                            class="block py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                    </li>
                    {{-- <li>
                        <a href="#pricing"
                            class="block py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
                    </li> --}}
                    <li>
                        <a href="#contact"
                            class="block py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
                    </li>

                    {{-- dropdown menu --}}
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="flex items-center justify-between w-full py-2 px-3  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Login
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" style="box-shadow:0 0 6px rgb(184, 184, 184);"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg w-fit dark:divide-gray-600">
                            <ul class="py-2 text-sm text-pink-700" aria-labelledby="dropdownLargeButton">

                                <li class="w-full my-2 px-2 hover:border-2">
                                    <a href="{{ route('nav.login') }}" class="w-full h-full">Navigator Login</a>
                                </li>
                                <li class="w-full my-2 px-2 hover:border-2">
                                    <a href="{{ route('patientlogin') }}" class="w-full h-full">Patient Login</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    @yield('content')

    {{-- This line below is used to check if user is logged in or not --}}
    {{-- @if (!Route::is('login'))
    @endif --}}



    {{-- FOOTER --}}
    <footer class="bottom-0 bg-gray-800 py-12 px-4 sm:px-8 lg:px-16 text-white" id="contact">
        <div class="max-w-7xl mx-auto flex flex-col items-center justify-center text-center">

            <!-- Contact Information -->
            <h2 class="text-xl font-bold mb-4">Get in Touch with Our Cancer Navigation Team</h2>
            <p class="mb-6 max-w-2xl">
                Our dedicated patient navigators are here to help you access timely, high-quality cancer care and
                connect you with essential support services.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-left w-full max-w-4xl">

                <!-- Phone -->
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">📞</span>
                    <div>
                        <h3 class="font-semibold">Call Us</h3>
                        <p class="text-sm">+1 (123) 456-7890</p>
                        <p class="text-sm">Mon-Fri: 9 AM - 5 PM (EST)</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">📧</span>
                    <div>
                        <h3 class="font-semibold">Email Us</h3>
                        <p class="text-sm"><a href="mailto:support@cancernav.org"
                                class="underline">support@demo-abcheal.org</a></p>
                    </div>
                </div>

                <!-- Office Location -->
                <div class="flex items-center space-x-3">
                    <span class="text-2xl">📍</span>
                    <div>
                        <h3 class="font-semibold">Visit Us</h3>
                        <p class="text-sm">123 Health St, City, State, ZIP</p>
                    </div>
                </div>

            </div>

            <!-- Contact Form -->
            <div class="mt-8 w-full max-w-3xl">
                <h3 class="text-lg font-semibold mb-4">Send Us a Message</h3>
                <form action="#" method="POST" class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <input type="text" name="name" placeholder="Your Name" required
                            class="p-2 w-full bg-gray-800 text-white rounded-md border border-gray-600">
                        <input type="email" name="email" placeholder="Your Email" required
                            class="p-2 w-full bg-gray-800 text-white rounded-md border border-gray-600">
                    </div>
                    <textarea name="message" placeholder="Your Message" rows="4" required
                        class="p-2 w-full bg-gray-800 text-white rounded-md border border-gray-600 mt-4"></textarea>
                    <button type="submit" class="mt-4 bg-blue-500 px-6 py-2 rounded-md font-bold text-white">Send
                        Message</button>
                </form>
            </div>

            <!-- Social Media Links -->
            <div class="flex space-x-4 mt-6">
                <a href="#" class="inline-block bg-blue-500 rounded-sm p-1">
                    <img src="{{ asset('bootstrap-icons/facebook.svg') }}" alt="facebook" class="h-6 w-6">
                </a>
                <a href="#" class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 rounded-sm p-1">
                    <img src="{{ asset('bootstrap-icons/instagram.svg') }}" alt="instagram" class="h-6 w-6">
                </a>
                <a href="#" class="inline-block bg-blue-400 rounded-sm p-1">
                    <img src="{{ asset('bootstrap-icons/twitter.svg') }}" alt="twitter" class="h-6 w-6">
                </a>
            </div>

            <div class="text-sm mt-4">
                <p>Terms and Conditions | Privacy Policy | &copy; abcHeal Since 2025</p>
            </div>
        </div>
    </footer>



</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</html>