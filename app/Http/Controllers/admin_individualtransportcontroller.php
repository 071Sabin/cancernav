<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\transportservices;
use Illuminate\Http\Request;

class admin_individualtransportcontroller extends Controller
{
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
        return view('admin.individualtransportdetails', compact('transportdetails', 'transportdata'));
    }


    public function update(Request $request, $id)
    {
        $transport = transportservices::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'availability' => 'required|boolean',
            'num_wheelchairs' => 'nullable|integer|min:0',
            'num_caregivers' => 'nullable|integer|min:0',
            'apiurl' => 'nullable|string',
            'providerurl' => 'nullable|url',
        ]);

        $transport->name = $validated['name'];
        $transport->city = $validated['city'];
        $transport->availability = $validated['availability'];
        $transport->num_wheelchairs = $validated['num_wheelchairs'] ?? 0;
        $transport->num_caregivers = $validated['num_caregivers'] ?? 0;
        $transport->apiurl = $validated['apiurl'] ?? null;
        $transport->providerurl = $validated['providerurl'] ?? null;

        $transport->save();

        return redirect()->back()->with('success', 'Transport details updated successfully!');
    }
}