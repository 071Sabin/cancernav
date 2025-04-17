<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigator @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('bootstrapIcons/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
</head>

<body class="h-screen bg-slate-900">
    {{-- NAV BAR --}}
    @if (Auth::guard('navigator')->check())
        <nav class="fixed top-0 z-50 w-full bg-slate-800 shadow-md shadow-slate-600 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-5 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">

                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-300 border-gray-300 border rounded-lg sm:hidden hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="#" class="flex ms-2 md:me-24">
                            <img src="{{ asset('src_images/logo.png') }}" class="h-8 me-3" alt="Cancer Bridge Logo" />
                            <span
                                class="self-center text-xl font-semibold text-white sm:text-2xl whitespace-nowrap dark:text-white">abcHeal-Navigator</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ms-3">
                            <div>
                                <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    @if (Auth::user()->profile_pic)
                                        <img class="w-8 h-8 rounded-full border-2 border-white"
                                            src="{{ route('image.show', Auth::user()->profile_pic) }}" alt="user photo">
                                    @else
                                        <i class="bi bi-person-circle text-3xl text-white"></i>
                                    @endif
                                </button>
                            </div>

                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-user">

                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm  dark:text-white" role="none">
                                        {{ Auth::user()->name }}
                                    </p>
                                    <p class="text-sm font-medium truncate dark:text-gray-300" role="none">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('nav.dashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-500 dark:text-gray-300 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white"
                                            role="menuitem">Nav-Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('nav.profile') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-500 dark:text-gray-300 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white"
                                            role="menuitem">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('nav.logout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-slate-500 dark:text-gray-300 dark:hover:bg-gray-600 hover:text-white dark:hover:text-white"
                                            role="menuitem">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-slate-800 text-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto">
                <ul class="space-y-2 font-medium">

                    {{-- DASHBOARD MENU --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-100 transition duration-75 rounded-lg group hover:bg-slate-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="w-5 h-5 text-gray-100 transition duration-75 dark:text-gray-400 group-hover: dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Nav Dashboard</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2 bg-slate-700">
                            <li class="text-sm">
                                <a href="{{ route('nav.dashboard') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-pie-chart-fill"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Dashboard</span>
                                </a>
                            </li>

                            <li class="text-sm">
                                <a href="{{ route('nav.broadcast') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-megaphone-fill"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Patient
                                        Broadcast</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- PATIENT MENU VIEW/ADD --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-100 transition duration-75 rounded-lg group hover:bg-slate-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                            <svg class="shrink-0 w-5 h-5 text-gray-100 transition duration-75 dark:text-gray-400 group-hover: dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Patients</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example2" class="hidden py-2 space-y-2 bg-slate-700">
                            <li class="text-sm">
                                <a href="{{ route('nav.show_addpatient') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-person-plus-fill"></i><span
                                        class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Add Patients</span>
                                </a>
                            </li>

                            <li class="text-sm">
                                <a href="{{ route('nav.patientaccounts') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-eye"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">View
                                        Patients</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- TRANSPORTS MENU VIEW AVAILABLE ONLY BY NAVIGATORS --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-100 transition duration-75 rounded-lg group hover:bg-slate-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example3" data-collapse-toggle="dropdown-example3">
                            <i class="bi bi-taxi-front-fill text-xl text-white"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transports</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example3" class="hidden py-2 space-y-2 bg-slate-700">
                            <li class="text-sm">
                                <a href="#"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-person-plus-fill"></i><span
                                        class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">any menu</span>
                                </a>
                            </li>

                            <li class="text-sm">
                                <a href="{{route('nav.showtransport')}}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-eye"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">View
                                        Transports</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- FINANCIAL AID MENU VIEW AVAILABLE ONLY BY NAVIGATORS --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-100 transition duration-75 rounded-lg group hover:bg-slate-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example4" data-collapse-toggle="dropdown-example4">
                            <i class="bi bi-cash-coin text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Financial Aid</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example4" class="hidden py-2 space-y-2 bg-slate-700">

                            <li class="text-sm">
                                <a href="{{ route('nav.showfinancialaid') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-eye"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">View
                                        Financial Aids</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                    {{-- HOUSING DETAILS VIEW ONLY FOR NAVIGATORS --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-100 transition duration-75 rounded-lg group hover:bg-slate-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example5" data-collapse-toggle="dropdown-example5">
                            <i class="bi bi-house-add-fill text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap ">Housing</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <ul id="dropdown-example5" class="hidden py-2 space-y-2 bg-slate-700 rounded-lg">
                            <li class="text-sm">
                                <a href="{{ route('nav.showhousing') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-eye"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">View Housings
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    {{-- VIEW PATIENT REQUEST/SEND REQUEST TO ADMIN --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-100 transition duration-75 rounded-lg group hover:bg-slate-500 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example6" data-collapse-toggle="dropdown-example6">
                            <i class="bi bi-chat-square-text-fill text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap ">Requests</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <ul id="dropdown-example6" class="hidden py-2 space-y-2 bg-slate-700 rounded-lg">
                            <li class="text-sm">
                                <a href="{{ route('nav.patient_requests') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-chat-left-heart-fill"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Patient Requests
                                    </span>
                                </a>
                            </li>
                            <li class="text-sm">
                                <a href="{{ route('nav.nav2adminrequest') }}"
                                    class="flex items-center w-full p-2 text-gray-100 transition duration-75 rounded-lg pl-11 group hover:bg-slate-500 dark:text-white dark:hover:bg-slate-800">
                                    <i class="bi bi-chat-right-quote-fill"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Request Admin
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="">
                        <a href="{{route('nav.logout')}}"
                            class="flex items-center p-2 mt-5 border-t border-white rounded-lg dark:text-white hover:bg-slate-500 dark:hover:bg-gray-700 group">
                            <svg class="shrink-0 w-5 h-5 text-gray-100 transition duration-75 dark:text-gray-400 group-hover: dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Sign Out</span>
                        </a>
                    </li>

                </ul>
            </div>
        </aside>

        <div class="sm:ml-64">
            <div class="rounded-lg mt-14">
                <main class="max-w-screen-xl flex flex-wrap justify-between mx-auto w-full p-4 pt-8 flex-col">
                    @yield('navigatorcontent')
                </main>

                {{-- FOOTER --}}
                <footer class="bottom-0 bg-gray-800 py-8 sm:px-8 lg:px-16 text-white " id="contact">
                    <div class="max-w-7xl mx-auto flex flex-col items-center justify-center">
                        <div class="flex space-x-4 mb-4">
                            <!-- Facebook Icon -->
                            <a href="#" class="inline-block bg-blue-500 rounded-sm p-1">
                                <img src="{{ asset('bootstrap-icons/facebook.svg') }}" alt="" class="h-6 w-6">
                            </a>
                            <!-- Instagram Icon -->
                            <a href="#" class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 rounded-sm p-1">
                                <img src="{{ asset('bootstrap-icons/instagram.svg') }}" alt="" class="h-6 w-6">
                            </a>
                            <!-- Twitter Icon -->
                            <a href="#" class="bg-blue-400 rounded-sm p-1">
                                <img src="{{ asset('bootstrap-icons/twitter.svg') }}" alt="" class="h-6 w-6">
                            </a>

                        </div>
                        <div class="text-sm">
                            <p><a href="#" class="hover:underline">Terms and Conditions</a> | <a href="#"
                                    class="hover:underline">Privacy Policy</a> | &copy; abcHeal
                                Since 2025</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    @endif




</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</html>