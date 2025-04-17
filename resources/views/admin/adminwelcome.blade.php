<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin @yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.0"></script>


</head>

<body class="bg-teal-900">
    @if (Auth::guard('admin')->check())


        {{-- new navigation --}}
        <nav class="fixed top-0 z-50 py-2 w-full bg-teal-800 text-teal-300 ">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start rtl:justify-end">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm  rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a href="{{ route('admindashboard') }}" class="flex ms-2 md:me-24">
                            <img src="{{ asset('src_images/logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
                            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                                abcHeal-Admin</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ms-3">
                            <div>
                                <button type="button"
                                    class="flex text-sm bg-gray-800 text-black rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                        alt="admin photo">
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                        {{ Auth::guard('admin')->user()->name }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                        {{ Auth::guard('admin')->user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1 text-black" role="none">
                                    <li>
                                        <a href="{{ route('admindashboard') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('adminprofile') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('adminlogout') }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
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
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-teal-800 sm:translate-x-0"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-teal-800 text-teal-300">
                <ul class="space-y-2 font-medium">

                    {{-- 1. dashboard of admin --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 hover:text-teal-900 text-base transition duration-75 rounded-lg group hover:bg-gray-100"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="w-5 h-5  transition duration-75 dark:text-gray-400 group-hover:text-teal-900 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 22 21">
                                <path
                                    d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                                <path
                                    d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                            </svg>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap ">Dashboard</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('adminbroadcast') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 hover:text-teal-900 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-broadcast"></i> &nbsp;Broadcast Message
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admindashboard') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  hover:text-teal-900 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-pie-chart-fill"></i>&nbsp;Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100  hover:text-teal-900 dark:text-white dark:hover:bg-gray-700">Other
                                    Menu</a>
                            </li>
                        </ul>
                    </li>

                    {{-- 2.  patient details add/view records --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                            <svg class="shrink-0 w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-teal-900 dark:group-hover:text-white"
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
                        <ul id="dropdown-example2" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('patientaccounts') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75  hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp;View Patient Records
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('show_addpatient') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75  hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-person-add text-xl"></i>&nbsp;Add Patients
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- 3.  navigator details add/view records --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example3" data-collapse-toggle="dropdown-example3">
                            <i class="bi bi-radar text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Navigators</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example3" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('navigatoraccounts') }}"
                                    class="flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp;View Navigator Records
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('show_addnavigator') }}"
                                    class="flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-node-plus text-lg"></i>&nbsp;Add Navigators
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- 4.  transport details add/view transports --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example4" data-collapse-toggle="dropdown-example4">
                            <i class="bi bi-car-front text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transports</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example4" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('showtransport') }}"
                                    class="flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp;View Transports
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('addtransport') }}"
                                    class="flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-plus-circle text-lg"></i>&nbsp;Add Transports
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- 5.  hospital details add/view hospitals --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example5" data-collapse-toggle="dropdown-example5">
                            <i class="bi bi-hospital text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Hospitals</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example5" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('showhospitals') }}"
                                    class="flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp;View Hospitals
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('addhospital') }}"
                                    class="flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-building-add text-lg"></i>&nbsp;Add Hospitals
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- 6.  financial aids details add/view financial aid provider --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 hover:text-teal-900 text-base text-teal-300 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example6" data-collapse-toggle="dropdown-example6">
                            <i class="bi bi-cash-coin text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Financial Aids</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example6" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('showfinancialaid') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp; Financial Aids Providers
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('addfinancialaid') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-plus-circle text-lg"></i>&nbsp;Add Financial Aids
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- 7.  Diagnosis details add/view Diagnosis --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base hover:text-teal-900 text-teal-300 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example7" data-collapse-toggle="dropdown-example7">
                            <i class="bi bi-capsule text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Diagnosis</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example7" class="hidden py-2 space-y-2 text-sm bg-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('showdiagnosis') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp;View Diagnosis
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('adddiagnosis') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-plus-circle text-lg"></i>&nbsp;Add Diagnosis</a>
                            </li>
                        </ul>
                    </li>



                    {{-- 8.  Housing details add/view Housing Providers --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example8" data-collapse-toggle="dropdown-example8">
                            <i class="bi bi-house-door text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Housings</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <ul id="dropdown-example8"
                            class="hidden py-2 space-y-2 text-sm bg-teal-900 hover:text-teal-900 rounded-lg">
                            <li>
                                <a href="{{ route('showhousing') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-eye-fill"></i>&nbsp;View Housings
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('addhousing') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition duration-75 hover:text-teal-900 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-house-add text-lg"></i>&nbsp;Add Housings
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-teal-300 transition duration-75 rounded-lg group hover:bg-white hover:text-teal-900 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-example9" data-collapse-toggle="dropdown-example9">
                            <i class="bi bi-chat-square-text-fill text-xl"></i>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap ">Requests</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <ul id="dropdown-example9" class="hidden py-2 space-y-2 bg-teal-900 hover:text-teal-900 rounded-lg">
                            <li class="text-sm">
                                <a href=" {{ route('showpatientrequests') }}"
                                    class="flex items-center w-full p-2 text-teal-300 transition hover:text-teal-900 duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-chat-left-heart-fill"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Patient Requests
                                    </span>
                                </a>
                            </li>

                            <li class="text-sm">
                                <a href=" {{ route('shownavrequests') }}"
                                    class=" flex items-center w-full p-2 text-teal-300 hover:text-teal-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                    <i class="bi bi-chat-right-quote-fill"></i>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"> Navigator Requests
                                    </span> </a>
                            </li>

                        </ul>
                    </li>

                    <li class="">
                        <a href="{{route('nav.logout')}}"
                            class="flex items-center p-2 mt-5 border-t border-white rounded-lg dark:text-white hover:bg-white hover:text-teal-900 dark:hover:bg-gray-700 group">
                            <svg class="shrink-0 w-5 h-5 text-teal-300 transition duration-75 hover:text-teal-900  dark:text-gray-400 group-hover: dark:group-hover:text-white"
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
            <div class="mt-10">
                <main class="max-w-screen-xl flex flex-wrap justify-between mx-auto w-full overflow-x-auto p-1 lg:p-4
                                        flex-col">
                    @yield('admincontent')
                </main>

                {{-- FOOTER --}}
                <footer class="bottom-0 bg-slate-900 py-8 px-4 sm:px-8 lg:px-16 text-white" id="contact">
                    <div class="w-full flex flex-col items-center justify-center">
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
                            <a href="#" class="bg-blue-400 rounded-sm p-1"> <img
                                    src="{{ asset('bootstrap-icons/twitter.svg') }}" alt="" class="h-6 w-6">
                            </a>
                        </div>
                        <div class="text-sm">
                            <p>Terms and Conditions | Privacy Policy | &copy; abcHeal Since 2025</p>
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