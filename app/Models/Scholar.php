<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholar extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'manage_scholars';

    // Allow mass assignment for the following attributes
    protected $fillable = [
        'student_id', 'first_name', 'last_name', 'middle_name', 'course', 
        'year_level', 'scholarship_type', 'gpa', 'category'
    ];

    // Alternatively, you could use $guarded to prevent mass-assignment vulnerabilities
    // protected $guarded = [];
}
