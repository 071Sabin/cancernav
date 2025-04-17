<?php

namespace App\Http\Controllers;

use _PHPStan_781aefaf6\Fidry\CpuCoreCounter\Finder\NullCpuCoreFinder;
use Illuminate\Http\Request;
use App\Models\adminbroadcast;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class adminbroadcastcontroller extends Controller
{
    public function testing()
    {
        return view('admin.testing');
    }
    public function navbroadcast(request $request)
    {
        $request->validate(
            [
                'navBroadcastmesg' => 'required',
                'navBroadcastTitle' => 'required',
                'navmessageUrgency' => 'required',
            ],
            [
                'navBroadcastTitle.required' => 'What is the title of your broadcast for navigators?',
                'navmessageUrgency.required' => 'Please select a message type for navigators!',
                'navBroadcastmesg.required' => 'Please write some message for navigators!',
            ]
        );

        $b = new adminbroadcast();
        $b->adminId = Auth::guard('admin')->user()->id;

        $b->broadcast_type = $request->navmessageUrgency;
        $b->navigatorId = 0;
        $b->for = 'navigator';
        $b->message = $request->navBroadcastmesg;
        $b->broadcast_title = $request->navBroadcastTitle;
        $b->link = $request->navBroadcastlink;
        $b->linkname = $request->navBroadcastlinkname;
        $b->save();

        // returns to admin dashboard with the sessions and message separated by comma for navomer
        //  then display the message given.
        return back()->with('nav_broadcast_success', 'Message broadcast success for Navigators!');
    }

    public function patientbroadcast(request $request)
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

        $b->adminId = Auth::guard('admin')->user()->id;
        $b->broadcast_type = $request->patientmessageUrgency;
        $b->navigatorId = 0;
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
        adminbroadcast::findOrFail($broadcast_id)->delete();

        // returns to admindashboard.blade.php to show the message for deleted broadcast.
        return back()->with('broadcast_deleted', $broadcast_id);
    }
}