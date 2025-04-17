<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\housing;
use Illuminate\Http\Request;

class adminhousingcontroller extends Controller
{
    public function show_addhousing()
    {
        return view('admin.adminaddhousing');
    }

    public function availablehousing()
    {
        $availablehousing = housing::all();
        return view('admin.availablehousing', compact('availablehousing'));
    }

    public function addhousing(request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:housing_providers',
            'city' => 'required|string|max:255',
            'state' => 'required|string',
            'has_wheelchair_access' => 'required|boolean',
            'has_caregiver_support' => 'required|boolean',
            'availability' => 'required|boolean',
            'url' => 'required',
        ]);

        $housing = new housing();
        $housing->name = $validated['name'];
        $housing->city = $validated['city'];
        $housing->state = $validated['state'];
        $housing->has_wheelchair_access = $validated['has_wheelchair_access'];
        $housing->has_caregiver_support = $validated['has_caregiver_support'];
        $housing->availability = $validated['availability'];
        $housing->url = $validated['url'];
        $housing->save();

        return redirect()->back()->with('housingsuccess', 'Housing provider added successfully!');

    }
}