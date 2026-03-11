<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    // Show homepage
    public function index()
    {
        return view('home'); 
    }

    // Track visitor
    public function track(Request $request)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
        ]);

        return response()->json(['message' => 'Visit tracked successfully']);
    }

    // Display all visits
    public function visits()
    {
        $visits = Visit::latest()->paginate(20);
        return view('visits.index', compact('visits'));
    }
}