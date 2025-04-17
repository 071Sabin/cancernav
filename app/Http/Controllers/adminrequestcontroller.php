<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\all_requests;
use Illuminate\Http\Request;

class adminrequestcontroller extends Controller
{
    public function navrequests()
    {
        $requests = all_requests::with('navigator') // eager load navigator name
            ->where('request_type', 'n2a')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')")
            ->latest()
            ->get();

        return view('admin.nav2adminrequests', compact('requests'));
    }

    // this till show details for individual navigator while clicking in the request view details button
    public function editnavreq($id)
    {
        // $request = all_requests::findOrFail($id);
        $request = all_requests::with(['navigator.hospital'])->findOrFail($id);

        return view('admin.individualnav2adminrequests', compact('request'));
    }

    // this will then update the navigator requests after admin marks as completed or in progress, default willbe pending status.
    public function updatenavreq(Request $requestData, $id)
    {
        $request = all_requests::findOrFail($id);

        $request->status = $requestData->input('status');
        $request->response_message = $requestData->input('response_message');
        $request->seen_by_recipient = true; // so navigator can see the update
        $request->save();

        return redirect()->route('admin.navigator.requests.edit', $id)->with('success', 'Request updated successfully.');
    }

    public function deleteNavigatorRequest($id)
    {
        $request = all_requests::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }


    public function patientrequests()
    {
        $requests = all_requests::with('patient') // eager load navigator name
            ->where('request_type', 'p2n')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')")
            ->latest()
            ->get();

        return view('admin.patient2navrequests', compact('requests'));
    }

    public function deletePatientRequest($id)
    {
        $request = all_requests::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }

    // this fn shows individual patient request details and admin can edit them like status, giving response messages and submit
    public function editpatientreq($id)
    {
        // $request = all_requests::findOrFail($id);
        // $request = all_requests::with(['patient.hospital'])->findOrFail($id);
        $request = all_requests::with(['patient.hospital', 'patient.navigator'])->findOrFail($id);
        return view('admin.individualp2nrequests', compact('request'));
    }

    // this will update the patient requests details as admin applies some editings like updating the status, giving message replies.
    public function updatepatientreq(Request $requestData, $id)
    {
        $request = all_requests::findOrFail($id);

        $request->status = $requestData->input('status');
        $request->response_message = $requestData->input('response_message');
        $request->seen_by_recipient = true; // so navigator can see the update
        $request->save();

        return redirect()->route('admin.patient.requests.edit', $id)->with('success', 'Patient request updated successfully.');
    }
}