<?php

namespace App\Http\Controllers;

use App\Models\hospitals;
use Illuminate\Http\Request;
use App\Models\diagnosis_available;
use App\Http\Controllers\Controller;

class diagnosis_availablecontroller extends Controller
{
    public function show_adddiagnosis()
    {
        $availablehospitals = hospitals::all();
        return view('admin.adminadddiagnosis', compact('availablehospitals'));
    }


    public function adddiagnosis(request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:diagnosis,name|max:255',
            'description' => 'nullable|string',
            'hospitalid' => 'required|string',
            'icd_code' => 'nullable|string|unique:diagnosis,icd_code|max:50',
            'treatment_guidelines' => 'nullable|string',
        ]);

        $diagnosis = new diagnosis_available();

        $diagnosis->name = $request->name;
        $diagnosis->description = $request->description;
        $diagnosis->hospitalid = $request->hospitalid;
        $diagnosis->icd_code = $request->icd_code;
        $diagnosis->treatment_guidelines = $request->treatment_guidelines;
        $diagnosis->save();

        return redirect()->back()->with('success', 'Diagnosis added successfully!');
    }

    public function availablediagnosis()
    {
        $availablediagnosis = diagnosis_available::with('hospital')->get();
        return view('admin.availablediagnosis', compact('availablediagnosis'));
    }
}