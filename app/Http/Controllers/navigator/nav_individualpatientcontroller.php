<?php

namespace App\Http\Controllers\navigator;

use App\Models\patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class nav_individualpatientcontroller extends Controller
{
    public function showEachPatientDetails(Request $request, $patientId)
    {
        $navigator = Auth::user(); // Authenticated navigator

        $individualpatientdetails = $navigator->patients()
            ->where('id', $patientId)
            ->first();

        if (!$individualpatientdetails) {
            abort(403, 'Unauthorized access to this patient.');
        }

        return view('navigator.navindividualpatientdetails', compact('individualpatientdetails'));
    }


    public function updatepatient(Request $request, $id)
    {
        $patient = Patient::where('id', $id)
            ->where('navigatorId', Auth::id())
            ->firstOrFail();


        // Validate only the fields that are present in the request
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:8',
            'doctorname' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
            'dateofbirth' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'cancer_type' => 'nullable|string|max:255',
            'treatment_stage' => 'nullable|string|max:255',
            'insurance_status' => 'nullable|string|max:255',
            'employment_status' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update only the fields that are provided
        foreach ($validatedData as $key => $value) {
            if ($value !== null) {
                // Hash the password before assigning
                if ($key === 'password') {
                    $patient->password = bcrypt($value);
                } else {
                    $patient->$key = $value;
                }
            }
        }

        // Handle Profile Picture Upload
        if ($request->hasFile('profile_pic')) {
            // Delete old profile pic if exists
            if ($patient->profile_pic) {
                Storage::delete('private/' . $patient->profile_pic);
            }

            // Store new profile picture
            $path = $request->file('profile_pic')->store('uploads');
            $patient->profile_pic = $path;
        }

        $patient->save();
        // redirecting to the patient.edit route to fetch the recently updated data that's saved so we don't get stale data using return redirect()->back();
        // because return redirect()->back() shows the stale data though the data is updated. so call a function in the same controller, fetcht he recent data then return to bladefile
        return redirect()->route('nav.individualpatientdetails', $id)->with('updatesuccess', 'Patient details updated successfully.');
    }
}