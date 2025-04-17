<?php

namespace App\Http\Controllers\patient;

use App\Models\patient;
use Illuminate\Http\Request;
use App\Models\adminbroadcast;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class patientcontroller extends Controller
{
    public function patientlogin()
    {
        return view('patient.patientlogin');
    }

    public function patientloginprocess(request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd(Auth::guard());
        if (Auth::guard('patient')->attempt($credentials)) {
            // Authentication passed...
            // echo "authenticated";
            return redirect()->route('patient.dashboard');

        } else {
            // returns to driver/driverlogin.blade.php
            return back()->withErrors("Invalid credentials !!");
        }
    }


    public function patientdashboard()
    {
        $patientbroadcastMesg = adminbroadcast::where('for', 'patient')->get();

        $patient = Auth::guard('patient')->user();

        $navigatorActiveStatus = $patient->navigator ? $patient->navigator->active : null;
        // dd($navigatorActiveStatus);
        return view('patient.patientdashboard', compact('patientbroadcastMesg', 'navigatorActiveStatus'));
    }


    public function patientprofile()
    {

        $currentPatientDetails = patient::with(['hospital', 'navigator.hospital'])->where('id', Auth::id())->first();
        // dd(gettype($currentPatientDetails->treatment_stage));
        return view('patient.patientprofile', compact('currentPatientDetails'));
    }


    public function patientlogout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patientlogin');
    }
}