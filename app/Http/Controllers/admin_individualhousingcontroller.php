<?php

namespace App\Http\Controllers;

use App\Models\housing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin_individualhousingcontroller extends Controller
{
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
        return view('admin.individualhousingdetails', compact('housingdetails', 'housingdata'));
    }


    public function updateHousing(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'availability' => 'required|boolean',
            'has_wheelchair_access' => 'required|boolean',
            'has_caregiver_support' => 'required|boolean',
            'url' => 'nullable|string',
        ]);

        $housing = housing::find($id);

        if (!$housing) {
            return redirect()->back()->with('error', 'Housing provider not found.');
        }

        $housing->name = $request->name;
        $housing->city = $request->city;
        $housing->state = $request->state;
        $housing->availability = $request->availability;
        $housing->has_wheelchair_access = $request->has_wheelchair_access;
        $housing->has_caregiver_support = $request->has_caregiver_support;
        $housing->url = $request->url;

        $housing->save();

        return redirect()->back()->with('success', 'Housing provider updated successfully!');
    }

    public function deleteHousing($id)
    {
        $housing = Housing::find($id);

        if (!$housing) {
            return redirect()->back()->with('error', 'Housing provider not found.');
        }

        $housing->delete();

        return redirect()->back()->with('success', 'Housing provider deleted successfully!');
    }
}