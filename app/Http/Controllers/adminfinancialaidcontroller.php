<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\financialaid;
use Illuminate\Http\Request;

class adminfinancialaidcontroller extends Controller
{

    public function availablefinancialaid()
    {
        $financialaid_details = financialaid::all();
        return view('admin.availablefinancialaid', compact('financialaid_details'));
    }

    // this will show the form to add new financial aid provider
    public function show_addfinancialaid()
    {
        return view('admin.addfinancialaid');
    }

    public function addfinancialaid(request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'service_area' => 'nullable|string', // Will be converted to JSON
            'provider_type' => 'required|in:Government,Non-Profit,Private',
            'funding_source' => 'nullable|array', // Multiple funding sources
            'max_assistance_amount' => 'nullable|numeric|min:0',
            'eligibility_summary' => 'nullable|string',
            'application_process' => 'nullable|string',
            'support_languages' => 'nullable|array', // Multiple languages
            'hours_of_operation' => 'nullable|string',
            'apiurl' => 'nullable|string',
            'social_media' => 'nullable|array', // Will be stored as JSON
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Image file
        ]);


        // Create a new FinancialAid instance
        $financialAid = new financialaid();

        $financialAid->name = $request->name;
        $financialAid->description = $request->description;
        $financialAid->contact = $request->contact;
        $financialAid->email = $request->email;

        // Convert service area from comma-separated string to JSON array
        $financialAid->service_area = $request->service_area ? json_encode(explode(',', $request->service_area)) : null;

        $financialAid->provider_type = $request->provider_type;

        // Store funding sources as JSON
        $financialAid->funding_source = $request->funding_source ? json_encode($request->funding_source) : null;

        $financialAid->max_assistance_amount = $request->max_assistance_amount;
        $financialAid->eligibility_summary = $request->eligibility_summary;
        $financialAid->application_process = $request->application_process;

        // Store supported languages as JSON
        $financialAid->support_languages = $request->support_languages ? json_encode($request->support_languages) : null;

        $financialAid->hours_of_operation = $request->hours_of_operation;

        $financialAid->apiurl = $request->apiurl;

        // Store social media links as JSON
        $financialAid->social_media_links = $request->social_media ? json_encode($request->social_media) : null;

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            $financialAid->logo = $request->file('logo')->store('logos', 'public');
        }

        // Save to database
        $financialAid->save();

        return redirect()->back()->with('faid_success', 'Financial aid provider added successfully!');
    }
}