<?php

namespace App\Http\Controllers\navigator;

use App\Models\housing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class navhousingcontroller extends Controller
{
    public function availablehousing()
    {
        $availablehousing = housing::all();
        return view('navigator.navavailablehousing', compact('availablehousing'));
    }


    public function showEachHousingDetails(request $request, $housingid)
    {

        // we are just mocking the data here as supposing the api response and just display the available resources only through api.
        // this mock json is stored in storage/app/data so it's secure and can't be accessed with just external link

        $housingdetails = housing::findOrFail($housingid);
        $apipath = $housingdetails->url;
        // dd($apipath);
        // this path is just tempoorary showing mock realtime database from api
        $path = storage_path($apipath);

        // Check if the file exists
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read and decode JSON file
        $json = file_get_contents($path);
        $housingdata = json_decode($json, true);
        return view('navigator.navindividualhousingdetails', compact('housingdetails', 'housingdata'));
    }
}