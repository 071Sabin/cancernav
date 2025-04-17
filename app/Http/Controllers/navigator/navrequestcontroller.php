<?php

namespace App\Http\Controllers\navigator;

use App\Models\all_requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class navrequestcontroller extends Controller
{
    // this will show the request form for navigator, they can request anything to admin
    public function nav2adminreqform()
    {
        $navigatorId = Auth::id();

        $requests = all_requests::where('navigator_id', $navigatorId)
            ->where('request_type', 'n2a')
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')")
            ->latest()
            ->get();

        return view('navigator.nav2adminrequest', compact('requests'));
    }


    // this will be submitted from navigator to admin on clicking submit
    public function submitNavigatorRequest(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:50',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $newRequest = new all_requests();
        $newRequest->request_type = 'n2a';
        $newRequest->navigator_id = Auth::id();
        $newRequest->subject = $request->subject;
        $newRequest->category = $request->category;
        $newRequest->message = $request->message;
        $newRequest->priority = $request->priority;
        $newRequest->status = 'pending';
        $newRequest->seen_by_recipient = false;

        $newRequest->save();

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }



    // this will show all the requests in table
    public function showpatientrequests()
    {
        // this will show just the requests from respective navigator patients
        $requests = all_requests::with('patient')
            ->where('request_type', 'p2n')
            ->where('navigator_id', Auth::id())
            ->orderByRaw("FIELD(priority, 'high', 'medium', 'low')")
            ->orderByRaw("FIELD(status, 'pending', 'in_progress', 'completed')")
            ->latest()
            ->get();

        return view('navigator.nav_patients2navrequests', compact('requests'));
    }

    //delete patient request by navigator
    public function deletePatientRequest($id)
    {
        $request = all_requests::where('id', $id)
            ->where('navigator_id', Auth::id()) // Ensure it's owned by this navigator
            ->firstOrFail();
        $request->delete();

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }

    // this fn shows individual patient request details and navigator can edit them like status, message as reply
    public function editpatientreq($id)
    {
        // $request = all_requests::findOrFail($id);
        $request = all_requests::with(['patient.hospital'])
            ->where('id', $id)
            ->where('navigator_id', Auth::id()) // ✅ Only if this request belongs to the current navigator
            ->firstOrFail(); // Will 404 if not matched

        return view('navigator.nav_individualp2nrequests', compact('request'));
    }

    // this will update the patient requests details as admin applies some editings like updating the status, giving message replies.
    public function updatepatientreq(Request $requestData, $id)
    {
        $request = all_requests::findOrFail($id);

        $request->status = $requestData->input('status');
        $request->response_message = $requestData->input('response_message');
        $request->seen_by_recipient = true; // so navigator can see the update
        $request->save();

        return redirect()->route('nav.patient.requests.edit', $id)->with('success', 'Request updated successfully.');
    }
}