<?php

namespace App\Http\Controllers\patient;

use App\Models\all_requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class patientrequestcontroller extends Controller
{
    public function patient2navreqform()
    {
        $patientId = Auth::id();

        $requests = all_requests::where('patient_id', $patientId)
            ->where('request_type', 'p2n')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')")
            ->latest()
            ->get();

        return view('patient.patientrequestform', compact('requests'));

    }

    public function submitPatientRequest(Request $request)
    {
        // dd(Auth::guard('patient')->user()->navigator->id);
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $newRequest = new all_requests();
        $newRequest->request_type = 'p2n';
        $newRequest->patient_id = Auth::id();
        $newRequest->navigator_id = Auth::guard('patient')->user()->navigator->id;
        $newRequest->subject = $request->subject;
        $newRequest->category = $request->category;
        $newRequest->message = $request->message;
        $newRequest->priority = $request->priority;
        $newRequest->status = 'pending';
        $newRequest->seen_by_recipient = false;

        $newRequest->save();

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }
}