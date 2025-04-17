<?php

namespace App\Http\Controllers;

use App\Models\hospitals;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class hospitalcontroller extends Controller
{
    // this will show add hospital form
    public function show_addhospital()
    {
        return view('admin.addhospital');
    }

    // it will add hospital to Database
    public function addhospital(request $request)
    {
        // Validate the form data
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|unique:hospital,email',
                'city' => 'required|string|max:255',
                'state' => 'required|string',
                'address' => 'required|string',
                'contact_no' => 'required|string|max:15',
                'established' => 'nullable|date',
            ]

        );


        do {
            $randomId = 'H_' . $request->state . mt_rand(1000, 9999);
        } while (hospitals::where('hospitalId', $randomId)->exists());

        $h = new hospitals();
        $h->hospitalId = $randomId;
        $h->name = $request->name;
        $h->email = $request->email;
        $h->city = $request->city;
        $h->address = $request->address;
        $h->state = $request->state;
        $h->contact_no = $request->contact_no;
        $h->established = $request->established;

        $h->save();

        return redirect()->back()->with('h_success', 'Hospital added successfully!');
    }

    public function show_hospital()
    {
        $hospitals = hospitals::all();
        return view('admin.hospitallists', compact('hospitals'));
    }
}