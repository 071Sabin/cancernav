<?php

namespace App\Http\Controllers\navigator;

use Illuminate\Http\Request;
use App\Models\adminbroadcast;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class navbroadcastcontroller extends Controller
{
    public function navbroadcast()
    {
        $navigatorId = Auth::id();

        $navbroadcasts = adminbroadcast::where('navigatorId', $navigatorId)
            ->where('for', 'patient')
            ->latest()
            ->get();
        // dd($navbroadcasts);
        return view('navigator.navbroadcast', compact('navbroadcasts'));
    }

    public function patientbroadcastbynav_process(request $request)
    {
        $request->validate(
            [
                'patientBroadcastmesg' => 'required',
                'patientmessageUrgency' => 'required',
                'patientBroadcastTitle' => 'required',
            ],
            [
                'patientBroadcastTitle.required' => 'What is the title of your broadcast for patient?',
                'patientmessageUrgency.required' => 'Please select a message importance for patient!',
                'patientBroadcastmesg.required' => 'Please write some message for patient!',
            ]
        );

        $b = new adminbroadcast();

        $b->navigatorId = Auth::guard('navigator')->user()->id;
        $b->broadcast_type = $request->patientmessageUrgency;
        $b->adminId = 0;
        $b->for = 'patient';
        $b->message = $request->patientBroadcastmesg;
        $b->broadcast_title = $request->patientBroadcastTitle;
        $b->link = $request->patientBroadcastlink;
        $b->linkname = $request->patientBroadcastlinkname;
        $b->save();

        // return to admindashboard.blade.php for patient broadcast success mesg
        return back()->with('patient_broadcast_success', 'Message broadcast success for patients.');
    }

    public function deletebroadcast($broadcast_id)
    {
        // broadcast::findOrFail($broadcast_id)->delete();

        // dump($broadcast_id);
        $broadcast = adminbroadcast::findOrFail($broadcast_id);

        // Check if the broadcast belongs to the currently logged-in navigator
        if ($broadcast->navigatorId !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $broadcast->delete();

        // returns to admindashboard.blade.php to show the message for deleted broadcast.
        return back()->with('broadcast_deleted', $broadcast_id);
    }
}