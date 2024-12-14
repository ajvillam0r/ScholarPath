<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch necessary data from the database
        $scholarships = Scholarship::all();
        $users = User::all();

        return view('dashboard', compact('scholarships', 'users'));
    }

    public function filter(Request $request)
    {
        // Implement filtering logic
        $filteredData = Scholarship::where('type', $request->type)
            ->where('grade_level', $request->grade_level)
            ->get();

        return view('dashboard', ['scholarships' => $filteredData]);
    }
}
