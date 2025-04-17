@extends('patient.patientwelcome')

@section('title', '| Dashboard')
@section('patientcontent')
    @if (count($patientbroadcastMesg) > 0)
        <div class="text-sm">
            @foreach ($patientbroadcastMesg as $dbm)
                @if ($dbm->broadcast_type == 'primary')
                    <div
                        class="bg-blue-100 mt-1 py-3 text-blue-800 rounded-md max-w-screen-xl flex flex-wrap justify-between mx-auto w-full p-4 flex-col">
                        <h1 class="font-bold"><i class="bi bi-info-circle-fill"></i>{{ $dbm->broadcast_title }}</h1>
                        <p class="ml-0 lg:ml-5">
                            {{ $dbm->message }}
                            <br>
                        </p>
                        @if ($dbm->linkname)
                            <p class=" rounded-lg px-2 py-1 text-blue-800 bg-blue-200 font-bold text-sm w-fit mt-1"><a target="_blank"
                                    href="{{ $dbm->link }}">{{ $dbm->linkname }}</a>
                            </p>
                        @endif
                    </div>
                @else
                    <div
                        class="bg-red-100 mt-1 py-3 text-red-800 rounded-md border-2 border-red-900 max-w-screen-xl flex flex-wrap justify-between mx-auto w-full p-4 flex-col">
                        <h1 class="font-bold"><i class="bi bi-info-circle-fill"></i> {{ $dbm->broadcast_title }}</h1>
                        <p class="ml-0 lg:ml-5">
                            {{ $dbm->message }}
                            <br>
                        </p>
                        @if ($dbm->linkname)
                            <p class="bg-red-200 rounded-lg px-2 py-1 text-red-700 font-bold text-sm w-fit mt-1"><a target="_blank"
                                    href="{{ $dbm->link }}">{{ $dbm->linkname }}</a>
                            </p>
                        @endif

                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <div class="bg-gray-100 rounded p-3 border-white border mt-10">

        @if ($errors->any())
            <div class="text-red-800 bg-red-100 rounded-lg mt-10 text-md px-3 py-3 border-2 border-red-800">
                @foreach ($errors->all() as $e)
                    {{ $e }} <Br>
                @endforeach
            </div>
        @endif

        <div class="text-gray-900">
            <h2 class=" text-3xl font-bold mb-10">Dashboard</h2>
            <p>This is Patient Dashboard !!</p>
            {{-- @if($navigatorActiveStatus === 1)
                    <p>Navigator Active Status: <span class="text-center"><i class="bi bi-circle-fill text-green-500"></i>
                            Online</span></p>
                @else
                    <p>Navigator Active Status: <span class="text-center"><i class="bi bi-circle-fill text-gray-500"></i>
                            Offline</span></p>
                @endif --}}


        </div>
    </div>
@endsection