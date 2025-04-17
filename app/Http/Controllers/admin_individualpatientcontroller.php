<?php

namespace App\Http\Controllers;

use App\Models\navigator;
use App\Models\patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class admin_individualpatientcontroller extends Controller
{
    public function showEachPatientDetails(request $request, $patientId)
    {
        // getting the details of the clicked patient name and showing their each detail individually
        $individualpatientdetails = patient::with('navigator')->findOrFail($patientId);
        // dd($individualpatientdetails->profile_pic);
        // if (Storage::exists($individualpatientdetails->profile_pic)) {
        //     // return storage_path('app/private/' . $individualpatientdetails->profile_pic);
        //     $path = storage_path("app/private/" . $individualpatientdetails->profile_pic);
        //     // return response(Storage::get($path), 200)->header("Content-Type", Storage::mimeType($path));
        //     return $path;
        // } else {
        //     return 222;
        // }
        $navigators = navigator::where('hospitalId', $individualpatientdetails->hospitalId)->get();

        return view('admin.individualpatientdetail', compact('individualpatientdetails', 'navigators'));
    }


    public function updatepatient(Request $request, $id)
    {
        // dd($request->navigatorId);
        $patient = Patient::findOrFail($id);

        // Validate only the fields that are present in the request
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'navigatorId' => 'nullable|exists:navigator,id',
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
            'treatment_closed' => 'nullable|boolean',
            'profile_pic' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $originalTreatmentClosed = $patient->treatment_closed;


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

        // checking if reatment_closed is yes/no from the admin UI, if there is mistaken in closing patient treatment, then we can reverse it back to null.t
        if (
            isset($validatedData['treatment_closed']) &&
            $validatedData['treatment_closed'] != $originalTreatmentClosed
        ) {
            if ($validatedData['treatment_closed'] == 1) {
                // Treatment closed — add timestamp
                $patient->treatment_closed_at = now();
            } else {
                // Treatment reopened — clear timestamp
                $patient->treatment_closed_at = null;
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
        return redirect()->route('individualpatientdetails', $id)->with('updatesuccess', 'Patient details updated successfully.');
    }
}