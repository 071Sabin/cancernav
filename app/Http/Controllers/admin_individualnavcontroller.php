<?php

namespace App\Http\Controllers;

use App\Models\hospitals;
use App\Models\navigator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin_individualnavcontroller extends Controller
{
    function showEachNavigatorDetails($id)
    {
        $individualnavdetails = navigator::with(['hospital', 'patients'])->find($id);

        return view('admin.individualnavigatordetail', compact('individualnavdetails'));
    }

    // this function will update the navigator details from admin
    public function update(Request $request, $id)
    {
        $navigator = navigator::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:navigator,email,' . $id,
            'phone' => 'required',
            'password' => 'nullable|string|min:8',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $navigator->name = $request->name;
        $navigator->email = $request->email;
        $navigator->phone = $request->phone;
        $navigator->password = bcrypt($request->password);

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('uploads');
            $navigator->profile_pic = $path;
        }

        $navigator->save();

        return redirect()->route('navigator.edit', $id)->with('success', 'Navigator updated successfully.');
    }
}