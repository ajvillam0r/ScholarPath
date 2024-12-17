<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Make sure this line is added

class ScholarController extends Controller
{
    public function addScholar(Request $request)
    {
        // Validate the input data
        $request->validate([
            'studentId' => 'required|string|max:50',
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'middleName' => 'nullable|string|max:100',
            'course' => 'required|string|max:100',
            'yearLevel' => 'required|integer|min:1',
            'scholarshipType' => 'required|string',
            'gpa' => 'nullable|numeric|min:90|max:100',
            'category' => 'nullable|string|max:50'
        ]);

        // Insert data into the database
        DB::table('manage_scholars')->insert([
            'student_id' => $request->input('studentId'),
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'middle_name' => $request->input('middleName'),
            'course' => $request->input('course'),
            'year_level' => $request->input('yearLevel'),
            'scholarship_type' => $request->input('scholarshipType'),
            'gpa' => $request->input('gpa'),
            'category' => $request->input('category'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Scholar added successfully!');
    }

    public function showScholarships()
    {
        // Fetch the scholars from the 'manage_scholars' table
        $scholars = DB::table('manage_scholars')->get();

        // Pass the $scholars variable to the view
        return view('dashboard', compact('scholars'));
    }
}
