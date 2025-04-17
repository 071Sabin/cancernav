@extends('admin.adminwelcome')

@section('admincontent')
    <div class="bg-teal-800 my-10 p-6 rounded-xl text-white">
        <h1 class=" font-bold text-2xl">Admin Profile</h1>
        <span>Name:</span> <span>{{ $admindetails->name }}</span>
        <br>
        <span>Email:</span>
        <span>{{ $admindetails->email }}</span>
    </div>
@endsection