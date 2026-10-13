<?php


namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Saving;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Jika role-nya user/anggota
        if ($user->role === 'user') {
            $member = Member::where('name', 'LIKE', '%' . $user->name . '%')->first();

            $mySavings = collect();
            $totalMySavings = 0;
            $myLoans = collect();
            $totalMyLoans = 0;

            if ($member) {
                $mySavings = Saving::where('member_id', $member->id)->latest()->get();
                $totalMySavings = $mySavings->sum('amount');

                $myLoans = Loan::where('member_id', $member->id)->latest()->get();
                $totalMyLoans = $myLoans->where('status', 'Approved')->sum('amount');
            }

            return view('user.dashboard', compact(
                'mySavings', 
                'totalMySavings', 
                'myLoans', 
                'totalMyLoans'
            ));
        }

        // Jika admin, tampilkan statistik lengkap seluruh koperasi
        $totalMembers = Member::count();
        $totalSavings = Saving::sum('amount');
        $totalLoans = Loan::sum('amount');
        $pendingLoans = Loan::where('status', 'Pending')->count();

        return view('dashboard', compact(
            'totalMembers', 
            'totalSavings', 
            'totalLoans', 
            'pendingLoans'
        ));
    }
}