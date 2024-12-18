<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Ensure DB is imported

class ScholarController extends Controller
{
    // Add Scholar Method (unchanged)
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

    // Show Scholarships Method (unchanged)
    public function showScholarships()
    {
        // Fetch the scholars from the 'manage_scholars' table
        $scholars = DB::table('manage_scholars')->get();

        // Pass the $scholars variable to the view
        return view('dashboard', compact('scholars'));
    }

    // Updated Update Scholar Method
    public function updateScholar(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'yearLevel' => 'required|integer|min:1|max:5',
            'scholarshipType' => 'required|string',
            'gpa' => 'nullable|numeric|min:0|max:4.0',
            'category' => 'nullable|string',
        ]);

        // Find the scholar by ID in the database
        $scholar = DB::table('manage_scholars')->where('id', $id)->first();

        if ($scholar) {
            // Update the scholar's details
            DB::table('manage_scholars')->where('id', $id)->update([
                'first_name' => $request->input('name'), // Assuming 'name' is a single input field for full name
                'course' => $request->input('course'),
                'year_level' => $request->input('yearLevel'),
                'scholarship_type' => $request->input('scholarshipType'),
                'gpa' => $request->input('gpa'),
                'category' => $request->input('category'),
                'updated_at' => now(),
            ]);

            // Return a success response
            return response()->json(['success' => true]);
        }

        // Return failure response if scholar not found
        return response()->json(['success' => false, 'message' => 'Scholar not found.']);
    }

    // Delete Scholar Method (unchanged)
    public function deleteScholar($id)
    {
        $scholar = DB::table('manage_scholars')->where('id', $id)->first();
        if ($scholar) {
            // Delete the scholar from the database
            DB::table('manage_scholars')->where('id', $id)->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Scholar not found.']);
    }
}
