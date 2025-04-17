<?php

namespace App\Http\Controllers\navigator;

use Carbon\Carbon;
use App\Models\navigator;
use App\Models\all_requests;
use Illuminate\Http\Request;
use App\Models\adminbroadcast;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class navcontroller extends Controller
{
    public function navlogin()
    {
        return view('navigator.navlogin');
    }

    public function navloginprocess(request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd(Auth::guard());
        if (Auth::guard('navigator')->attempt($credentials)) {
            // Authentication passed...
            // echo "authenticated";
            // $nav = Auth::guard('navigator')->user();

            // $nav->active = 1;
            // $nav->save();

            return redirect()->route('nav.dashboard');

        } else {
            // returns to navigator login page with error
            return back()->withErrors("Invalid credentials !!");
        }
    }


    public function navdashboard()
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $navigatorId = Auth::id(); // or Auth::user()->id

        $pendingP2nRequestsCount = all_requests::where('status', 'pending')
            ->where('request_type', 'p2n')
            ->where('navigator_id', $navigatorId)
            ->count();

        $inProgressP2nRequestsCount = all_requests::where('status', 'in_progress')
            ->where('request_type', 'p2n')
            ->where('navigator_id', $navigatorId)
            ->count();

        $completedP2nRequestsCount = all_requests::where('status', 'completed')
            ->where('request_type', 'p2n')
            ->where('navigator_id', $navigatorId)
            ->count();

        $overdueHighPriorityFromPatients = all_requests::where('priority', 'high')
            ->where('status', 'pending')
            ->where('request_type', 'p2n')
            ->where('created_at', '<', $yesterday)
            ->where('navigator_id', $navigatorId)
            ->count();

        $navigatorbroadcastMesg = adminbroadcast::where('for', 'navigator')->get();
        return view('navigator.navdashboard', compact(
            'navigatorbroadcastMesg',
            'pendingP2nRequestsCount',
            'inProgressP2nRequestsCount',
            'completedP2nRequestsCount',
            'overdueHighPriorityFromPatients'
        ));
    }


    public function navprofile()
    {
        $navigator = navigator::with('hospital')->where('id', Auth::id())->first();

        if (!$navigator) {
            return redirect()->back()->with('error', 'Navigator not found.');
        }

        return view('navigator.navprofile', compact('navigator'));
    }


    // here we will update navigator profile details.
    public function updateProfile(Request $request)
    {
        $navigator = auth()->user();

        $request->validate([
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'old_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6',
            'confirm_password' => 'nullable|string|same:new_password',
        ]);

        // Profile Picture
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $path = $file->store('uploads');
            $navigator->profile_pic = $path;
        }

        // Password Change
        if ($request->filled('old_password') || $request->filled('new_password')) {
            if (!Hash::check($request->old_password, $navigator->password)) {
                return back()->with('password_error', 'Current password is incorrect.');
            }

            if ($request->new_password !== $request->confirm_password) {
                return back()->with('password_error', 'New password and confirmation do not match.');
            }

            $navigator->password = Hash::make($request->new_password);
            session()->flash('password_success', 'Password updated successfully!');
        }

        $navigator->save();

        return back()->with('success', 'Profile updated successfully!');
    }



    public function navlogout()
    {
        // $nav = Auth::guard('navigator')->user();
        // $nav->active = 0;
        // $nav->save();

        Auth::guard('navigator')->logout();
        return redirect()->route('nav.login');
    }
}