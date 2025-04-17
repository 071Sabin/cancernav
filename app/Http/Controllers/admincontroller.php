<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\admin;
use App\Models\hospitals;
use App\Models\all_requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{
    // this will view admin login form
    public function adminlogin()
    {
        return view('admin.adminlogin');
    }


    // this will submit the login details and check with database if the credentials are correct
    public function adminloginprocess(request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('admindashboard');
        } else {
            // return to admin login page ie views/admin/adminlogin.blade.php 
            return back()->withErrors("Invalid email/password !!");
        }
    }

    // this will show admin dashboard after login
    public function admindashboard()
    {
        // Get counts for Pending, in_progress, and Completed requests for P2N and N2A
        $pendingP2nRequestsCount = all_requests::where('status', 'pending')
            ->where('request_type', 'p2n')
            ->count();

        $inProgressP2nRequestsCount = all_requests::where('status', 'in_progress')
            ->where('request_type', 'p2n')
            ->count();

        $completedP2nRequestsCount = all_requests::where('status', 'completed')
            ->where('request_type', 'p2n')
            ->count();

        $pendingN2aRequestsCount = all_requests::where('status', 'pending')
            ->where('request_type', 'n2a')
            ->count();

        $inProgressN2aRequestsCount = all_requests::where('status', 'in_progress')
            ->where('request_type', 'n2a')
            ->count();

        $completedN2aRequestsCount = all_requests::where('status', 'completed')
            ->where('request_type', 'n2a')
            ->count();


        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Requests created today
        // $todaysRequests = Request::whereDate('created_at', $today)->count();

        // Overdue high-priority pending requests (older than 1 day)
        $overdueHighPriorityFromPatients = all_requests::where('priority', 'high')
            ->where('status', 'pending')
            ->where('request_type', 'p2n')
            ->where('created_at', '<', $yesterday)
            ->count();

        $overdueHighPriorityFromNavigators = all_requests::where('priority', 'high')
            ->where('status', 'pending')
            ->where('request_type', 'n2a')
            ->where('created_at', '<', $yesterday)
            ->count();

        return view('admin.admindashboard', compact(
            'pendingP2nRequestsCount',
            'inProgressP2nRequestsCount',
            'completedP2nRequestsCount',
            'pendingN2aRequestsCount',
            'inProgressN2aRequestsCount',
            'completedN2aRequestsCount',
            'overdueHighPriorityFromPatients',
            'overdueHighPriorityFromNavigators'
        ));
    }

    // show admin broadcast system, can broadcast to navigators and patients
    public function adminbroadcast()
    {
        $allbroadcasts = DB::table('broadcast')->get();
        return view('admin.adminbroadcast', compact('allbroadcasts'));
    }

    // admin views their profile from here
    public function adminprofile()
    {
        $adminid = Auth::id();
        $admindetails = admin::findOrFail($adminid);

        return view('admin.adminprofile', compact('admindetails'));
    }

    // this will show existing navigator accounts
    public function navigatoraccounts()
    {
        $navigators = DB::table('navigator')->get();
        $totalnav = count($navigators);
        return view('admin.navigatoraccounts', compact('navigators', 'totalnav'));
    }





    // admin logout function
    public function adminlogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('adminlogin');
    }

}