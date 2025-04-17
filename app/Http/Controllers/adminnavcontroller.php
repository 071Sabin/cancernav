<?php

namespace App\Http\Controllers;

use App\Models\hospitals;
use App\Models\navigator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminnavcontroller extends Controller
{

    // this will show form for admin to add a new navigator
    public function show_addnavigator()
    {
        $hospitals = hospitals::select('id', 'hospitalId', 'name')->get(); // Fetch only required columns

        return view('admin.adminaddnav', compact('hospitals'));
    }

    public function addnavigator(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'hospitalId' => 'required|exists:hospital,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:navigator,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8', // Admin enters password manually
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional file upload
        ]);

        // dd(bcrypt($validated['password']));
        do {
            $randomId = 'N' . mt_rand(1000, 9999);
        } while (navigator::where('navigatorId', $randomId)->exists());


        // Create a new navigator instance
        $navigator = new navigator();
        $navigator->navigatorId = $randomId;
        $navigator->hospitalId = $validated['hospitalId'];
        $navigator->name = $validated['name'];
        $navigator->email = $validated['email'];
        $navigator->phone = $validated['phone'];
        $navigator->password = bcrypt($validated['password']); // Hash password before storing

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_pic')) {
            $navigator->profile_pic = $request->file('profile_pic')->store('uploads');
        }


        // Save the navigator record
        $navigator->save();

        return redirect()->back()->with('success', 'Navigator account created successfully!');
    }

    public function show_navigators()
    {
        // $navigators = DB::table('navigator')->get();
        $navigators = navigator::with('hospital')->get();

        return view('admin.navigatoraccounts', compact('navigators'));
    }
}