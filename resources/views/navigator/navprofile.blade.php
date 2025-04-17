@extends('navigator.navwelcome')
@section('title', '| Profile')


@section('navigatorcontent')

    {{-- this will display the navigator profile details --}}
    <div class="max-w-2xl mx-auto bg-slate-800 rounded-xl shadow-lg p-6 mt-10 border border-slate-700">
        <div class="flex flex-col items-center">
            <!-- Profile Picture -->
            @if($navigator->profile_pic)
                <img src="{{ route('image.show', $navigator->profile_pic) }}" alt="Profile Picture"
                    class="w-32 h-32 rounded-full shadow mb-4 object-cover border-4 border-white">
            @else
                <div class="w-32 h-32 rounded-full bg-slate-700 flex items-center justify-center text-slate-400 mb-4">
                    <i class="bi bi-person-circle text-3xl"></i>
                </div>
            @endif

            <h2 class="text-2xl font-semibold text-white mb-2">{{ $navigator->name }}</h2>
            <p class="text-sm text-slate-400 mb-6">
                Navigator ID: <span class="text-white">{{ $navigator->id }}</span>
                ({{ $navigator->navigatorId }})
            </p>

            <!-- Info Table -->
            <table class="w-full text-left border-t border-b border-slate-700">
                <tbody class="divide-y divide-slate-700">
                    <tr>
                        <td class="py-2 font-medium text-slate-400">Email</td>
                        <td class="py-2 text-white">{{ $navigator->email }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-slate-400">Phone</td>
                        <td class="py-2 text-white">{{ $navigator->phone }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-slate-400">Hospital ID</td>
                        <td class="py-2 text-white">{{ $navigator->hospitalId }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 font-medium text-slate-400">Hospital</td>
                        <td class="py-2 text-white">
                            {{ $navigator->hospital ? $navigator->hospital->name : 'N/A' }}
                            ({{ $navigator->hospital->hospitalId ?? 'N/A' }})
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr class="mt-16 mb-10 border-slate-700">
    <form method="POST" action="{{ route('nav.profile') }}" enctype="multipart/form-data" class="">
        @csrf

        <h1 class="text-3xl font-bold text-white mb-10">Update Profile</h1>

        @if(session('password_error'))
            <div class="text-red-800 bg-red-100 p-3 border-red-800 rounded text-sm mt-4">{{ session('password_error') }}</div>
        @endif

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        @if(session('password_success'))
            <div class="text-green-800 bg-green-100 p-3 rounded border-1 border-green-900 text-sm mt-4">
                {{ session('password_success') }}
            </div>
        @endif

        <!-- Profile Picture Upload -->
        <span class="text-slate-400">Update Profile Picture</span>
        <div class="flex flex-col md:flex-row items-center md:items-center gap-4">
            <label class="block w-full md:w-1/2">

                <input type="file" name="profile_pic"
                    class="block w-full mt-1 text-sm border-2 border-white rounded text-white file:bg-slate-700 file:border-none file:px-4 file:py-2 file:rounded file:text-sm file:text-white file:cursor-pointer" />
            </label>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 hover:border hover:border-white text-white px-4 py-2 rounded-lg shadow mt-4 md:mt-0">
                Upload
            </button>
        </div>

        @error('profile_pic')
            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
        @enderror

        <!-- Password Change Section -->
        <h3 class="text-slate-400 mb-4 mt-10 text-xl font-semibold">Change Password</h3>

        <div class="grid gap-4 md:grid-cols-3">
            <div>
                <label for="old_password" class="block text-sm text-slate-400">Current Password</label>
                <input type="password" name="old_password" id="old_password"
                    class="w-full mt-1 p-2 rounded bg-slate-800 text-white border border-slate-600">
            </div>
            <div>
                <label for="new_password" class="block text-sm text-slate-400">New Password</label>
                <input type="password" name="new_password" id="new_password"
                    class="w-full mt-1 p-2 rounded bg-slate-800 text-white border border-slate-600">
            </div>
            <div>
                <label for="confirm_password" class="block text-sm text-slate-400">Confirm New Password</label>
                <input type="password" name="confirm_password" id="confirm_password"
                    class="w-full mt-1 p-2 rounded bg-slate-800 text-white border border-slate-600">
            </div>
        </div>
    </form>




@endsection