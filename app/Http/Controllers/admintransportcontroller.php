<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transportservices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class admintransportcontroller extends Controller
{

    public function show_addtransport()
    {
        return view('admin.adminaddtransport');
    }

    // this function will add he transport services from admin
    public function addtransport(request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'providerurl' => 'required',
            'apiurl' => 'required',
            'availability' => 'required|in:0,1', // Ensuring valid status
            'num_wheelchairs' => 'required|integer|min:0',
            'num_caregivers' => 'required|integer|min:0',
        ]);

        $adminId = Auth::guard('admin')->id();
        $transport = new transportservices();
        $transport->name = $validated['name'];
        $transport->admin_id = $adminId;
        $transport->city = $validated['city'];
        $transport->providerurl = $validated['providerurl'];
        $transport->apiurl = $validated['apiurl'];
        $transport->availability = $validated['availability'];
        $transport->num_wheelchairs = $validated['num_wheelchairs'];
        $transport->num_caregivers = $validated['num_caregivers'];
        // $transport->save();

        // return redirect()->back()->with('transport_success', 'Transport details added successfully!');

        if ($transport->save()) {
            return redirect()->back()->with('transport_success', 'Transport service added successfully!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to add transport service.']);
        }
    }


    public function availabletransport()
    {
        $transports = transportservices::all();
        return view('admin.availabletransport', compact('transports'));
    }

}