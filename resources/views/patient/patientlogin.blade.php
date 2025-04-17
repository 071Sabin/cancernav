@extends('welcome')
@section('title', '| Patient Login')
@section('content')
    <div class=" flex bg-pink-900 items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="bg-pink-800 p-10 rounded-3xl text-pink-300">
                <h2 class="text-center text-3xl font-extrabold mb-12">
                    <i class="bi bi-person-fill-add"></i>
                    Patient Login
                </h2>


                <form class="space-y-6" action="{{ Route('patientlogin') }}" method="POST" enctype="multipart/form-data">
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
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-pink -400 hover:text-indigo-400">
                                Forgot your password?
                            </a>
                        </div>
                    </div>
                    {{-- <p>New to our site? <a class="text-indigo-300" href="{{ Route('driversignup') }}">SignUp Here</a>
                    </p> --}}
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection