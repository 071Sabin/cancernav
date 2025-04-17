<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\hospitals;
use Illuminate\Http\Request;

class admin_individualhospitalcontroller extends Controller
{
    public function showEachHospitalDetails($id)
    {
        $hospitaldetails = hospitals::with('diagnosis')->find($id);
        return view('admin.individualhospital', compact('hospitaldetails'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $hospital = hospitals::findOrFail($id);
        $hospital->name = $request->name;
        $hospital->email = $request->email;
        $hospital->address = $request->address;
        $hospital->contact_no = $request->phone;
        $hospital->save();

        return redirect()->back()->with('success', 'Hospital details updated successfully.');
    }

}