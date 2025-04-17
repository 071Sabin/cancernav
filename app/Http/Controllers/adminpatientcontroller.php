<?php

namespace App\Http\Controllers;

use App\Models\diagnosis_available;
use App\Models\patient;
use App\Models\hospitals;
use App\Models\navigator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminpatientcontroller extends Controller
{
    //

    // this will show existing patient accounts
    public function patientaccounts()
    {
        $patients = Patient::with('navigator')->get();
        // dd(json_decode($patients->treatment_stage, true));  // Check if it's an array or string

        // dd($patients);
        return view('admin.patientaccounts', compact('patients'));
    }


    // this will show add patient form
    public function show_addpatient()
    {
        $hospitals = hospitals::select('id', 'hospitalId', 'name')->get(); // Fetch only required columns
        $navigators = navigator::select('id', 'navigatorId', 'name')->get(); // Fetch only required columns
        $cancertypes = diagnosis_available::select('name', 'icd_code')->get();
        return view('admin.addpatient', compact('hospitals', 'navigators', 'cancertypes'));
    }

    // return the navigators with respective hospital only
    public function getNavigators($id)
    {
        $navigators = navigator::where('hospitalId', $id)->get();
        return response()->json($navigators);
    }


    public function getCancerTypes($id)
    {
        $cancerTypes = diagnosis_available::where('hospitalid', $id)->get(['id', 'name']);
        return response()->json($cancerTypes);
    }


    public function addpatientprocess(request $request)
    {
        // Validate input fields
        $validated = $request->validate(
            [
                'hospitalId' => 'required|exists:hospital,id',
                'navigatorId' => 'required|exists:navigator,id',
                'name' => 'required|string|max:255',
                'doctorname' => 'required|string|max:255',
                'gender' => 'required',

                'dateofbirth' => 'required|date',
                'ssn' => 'required|string|max:15|unique:patient,ssn',
                'email' => 'required|email|unique:patient,email',

                'password' => 'required|string|min:8',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',

                'city' => 'required|string|max:100',
                'state' => 'required|string',
                'zipcode' => 'required|string|max:10',

                'cancertype' => 'required|string',
                'insurance_status' => 'required|string',
                'treatment_stage' => 'required|array',

                'insuranceProvider' => 'required|string',
                'insurance_policy_number' => 'required|string',
                'treatment_closed' => 'nullable|boolean',
                'employment_status' => 'required|string',

                'yearly_income' => 'required|string',
                'income_source' => 'required|string',
                'emergency_contact' => 'required|string|max:20',

                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bank_statements' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'government_id' => 'required|file|mimes:pdf,jpg,png|max:2048',
            ],
            [
                'ssn.unique' => 'The patient with this SSN is already registered!',
            ]
        );

        // Generate a unique Patient ID (e.g., "P1234") while checking if the generated id alreadyexists, if exists generate new one
        do {
            $randomId = 'P' . mt_rand(1000, 9999);
        } while (patient::where('patientId', $randomId)->exists());

        do {
            $caseId = 'C' . mt_rand(1000, 9999);
        } while (patient::where('caseId', $caseId)->exists());

        // Create a new Patient record
        $patient = new patient();
        $patient->patientId = $randomId;
        $patient->caseId = $caseId;
        $patient->hospitalId = $validated['hospitalId'];
        $patient->navigatorId = $validated['navigatorId'];
        $patient->name = $validated['name'];
        $patient->doctorname = $validated['doctorname'];
        $patient->gender = $validated['gender'];
        $patient->dateofbirth = $validated['dateofbirth'];
        $patient->ssn = $validated['ssn'];
        $patient->email = $validated['email'];
        $patient->password = bcrypt($validated['password']); // Hash the password
        $patient->phone = $validated['phone'];
        $patient->address = $validated['address'];
        $patient->city = $validated['city'];
        $patient->state = $validated['state'];
        $patient->zipcode = $validated['zipcode'];
        $patient->cancer_type = $validated['cancertype'];
        $patient->treatment_stage = json_encode($validated['treatment_stage']);
        $patient->treatment_closed_at = $validated['treatment_closed'] ? now() : null;
        $patient->insurance_status = $validated['insurance_status'];
        $patient->insuranceProvider = $validated['insuranceProvider'];
        $patient->insurance_policy_number = $validated['insurance_policy_number'];
        $patient->employment_status = $validated['employment_status'];
        $patient->yearly_income = $validated['yearly_income'];
        $patient->income_source = $validated['income_source'];
        $patient->emergency_contact = $validated['emergency_contact'];

        // Handle file uploads
        if ($request->hasFile('profile_pic')) {
            $patient->profile_pic = $request->file('profile_pic')->store('uploads');
        }
        if ($request->hasFile('bank_statements')) {
            $patient->bank_statements = $request->file('bank_statements')->store('uploads');
        }
        if ($request->hasFile('government_id')) {
            $patient->government_id = $request->file('government_id')->store('uploads');
        }

        // Save to database
        $patient->save();

        return redirect()->back()->with('p_success', 'Patient record created successfully with ID: ' . $randomId);
    }

}