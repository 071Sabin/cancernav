<?php

namespace App\Http\Controllers\patient;

use Illuminate\Http\Request;
use App\Models\transportservices;
use App\Http\Controllers\Controller;

class patienttransportcontroller extends Controller
{
    //

    public function p_availabletransport()
    {
        $transports = transportservices::all();
        return view('patient.p_availabletransports', compact('transports'));
    }


    public function showEachTransportDetails(request $request, $transportId)
    {
        // getting the details of the clicked transport name and showing their each detail individually
        $transportdetails = transportservices::findOrFail($transportId);
        $apipath = $transportdetails->apiurl;
        // dd($apipath);
        // this path is just tempoorary showing mock realtime database from api
        $path = storage_path($apipath);

        // Check if the file exists
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read and decode JSON file
        $json = file_get_contents($path);
        $transportdata = json_decode($json, true);
        return view('patient.p_individualtransports', compact('transportdetails', 'transportdata'));
    }
}