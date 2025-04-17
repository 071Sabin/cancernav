<?php

namespace App\Http\Controllers;

use App\Models\financialaid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin_individualfinancialaidcontroller extends Controller
{
    public function showEachFinancialAidDetails(request $request, $financialaidId)
    {
        $aiddetails = financialaid::findOrFail($financialaidId);

        $apipath = $aiddetails->apiurl;
        // dd($apipath);
        // this path is just tempoorary showing mock realtime database from api
        $path = storage_path($apipath);

        // Check if the file exists
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read and decode JSON file
        $json = file_get_contents($path);
        $financialaiddata = json_decode($json, true);
        return view('admin.individualfinancialaid', compact('aiddetails', 'financialaiddata'));
    }

    public function update(Request $request, $id)
    {
        $aidProvider = financialaid::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'service_area' => 'nullable|string',
            'provider_type' => 'required|in:Government,Non-Profit,Private',
            'funding_source' => 'nullable|array',
            'funding_source.*' => 'string',
            'max_assistance_amount' => 'nullable|numeric',
            'eligibility_summary' => 'nullable|string',
            'application_process' => 'nullable|string',
            'support_languages' => 'nullable|array',
            'support_languages.*' => 'string',
            'hours_of_operation' => 'nullable|string|max:255',
            'social_media' => 'nullable|array',
            'social_media.*' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'apiurl' => 'nullable|string',
        ]);

        // Process optional arrays/JSON
        $aidProvider->funding_source = $request->has('funding_source')
            ? json_encode($request->funding_source)
            : null;

        $aidProvider->support_languages = $request->has('support_languages')
            ? json_encode($request->support_languages)
            : null;

        $aidProvider->service_area = $request->filled('service_area')
            ? json_encode(explode(',', $request->service_area))
            : null;

        $aidProvider->social_media_links = $request->has('social_media')
            ? json_encode($request->social_media)
            : null;

        // Handle file upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos');
            $aidProvider->logo = str_replace('public/', '', $logoPath);
        }

        // Update the rest of the fields
        $aidProvider->name = $validated['name'];
        $aidProvider->description = $validated['description'] ?? null;
        $aidProvider->contact = $validated['contact'] ?? null;
        $aidProvider->email = $validated['email'] ?? null;
        $aidProvider->provider_type = $validated['provider_type'];
        $aidProvider->max_assistance_amount = $validated['max_assistance_amount'] ?? null;
        $aidProvider->eligibility_summary = $validated['eligibility_summary'] ?? null;
        $aidProvider->application_process = $validated['application_process'] ?? null;
        $aidProvider->hours_of_operation = $validated['hours_of_operation'] ?? null;
        $aidProvider->apiurl = $validated['apiurl'] ?? null;

        $aidProvider->save();

        return redirect()->back()->with('success', 'Financial aid provider updated successfully.');
    }

}