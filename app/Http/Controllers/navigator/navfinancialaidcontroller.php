<?php

namespace App\Http\Controllers\navigator;

use App\Models\financialaid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class navfinancialaidcontroller extends Controller
{
    public function availablefinancialaid()
    {
        $financialaid_details = financialaid::all();
        return view('navigator.navfinancialaids', compact('financialaid_details'));
    }


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
        return view('navigator.navindividualfinancialaids', compact('aiddetails', 'financialaiddata'));
    }
}