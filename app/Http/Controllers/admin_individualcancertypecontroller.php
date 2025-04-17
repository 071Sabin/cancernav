<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\diagnosis_available;
use Illuminate\Http\Request;

class admin_individualcancertypecontroller extends Controller
{

    public function showEachCancerTypeDetails($id)
    {
        $cancertypedetail = diagnosis_available::with('hospital')->find($id);
        return view('admin.individualcancertype', compact('cancertypedetail'));
    }


    // public function edit($id)
    // {
    //     $cancerType = diagnosis_available::findOrFail($id);
    //     return view('cancer_types.edit', compact('cancerType'));
    // }

    public function update(Request $request, $id)
    {
        $cancerType = diagnosis_available::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'icd_code' => 'nullable|string',
            'description' => 'nullable|string',
            'treatment_guidelines' => 'nullable|string',
        ]);

        $cancerType->name = $request->name;
        $cancerType->icd_code = $request->icd_code;
        $cancerType->description = $request->description;
        $cancerType->treatment_guidelines = $request->treatment_guidelines;
        $cancerType->save();

        return redirect()->route('cancer-types.edit', $id)->with('success', 'Details Updated updated successfully!');
    }

}