@extends('welcome')
@section('title', '| Admin Login')
@section('content')
    <div class=" flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-teal-800">
        <div class="max-w-md w-full space-y-8 shadow-xl rounded-lg">
            <div class="p-10 rounded-3xl border-2 border-white">
                <h2 class="text-center text-3xl font-extrabold text-teal-300">
                    <i class="bi bi-person-fill-gear"></i>
                    &nbsp;Admin Login
                </h2>

                {{-- this shows any error that is passed from controller using withErrors() while returning from any function --}}
                @if ($errors->any())
                    <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                        @foreach ($errors->all() as $e)
                            {{ $e }} <Br>
                        @endforeach
                    </div>
                @endif

                {{-- form to take email/passwords --}}
                <form class="mt-8 space-y-6 text-teal-300" action="{{ Route('adminlogin') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <p class="mt-3">Email</p>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Email address">
                        </div>
                        <div>
                            <p class="mt-3">Password</p>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                placeholder="Password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-indigo-300 focus:ring-indigo-400 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-teal-200 hover:text-teal-400">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-lg text-sm font-medium text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection