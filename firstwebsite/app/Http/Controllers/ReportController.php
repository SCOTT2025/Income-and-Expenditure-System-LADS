<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function monthly()
    {
        // Your logic for the monthly report.
        return view('monthly_report'); // Ensure this view exists in resources/views/.
    }
}


