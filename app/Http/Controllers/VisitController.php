<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function track(Request $request)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
        ]);

        return response()->json(['message' => 'Visit tracked successfully']);
    }

    // ✅ UPDATED: search + pagination
    public function visits(Request $request)
    {
        $search = $request->search;

        $visits = Visit::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%$search%")
                    ->orWhere('url', 'like', "%$search%")
                    ->orWhere('user_agent', 'like', "%$search%")
                    ->orWhere('id', 'like', "%$search%");
            });
        })
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('visits.index', compact('visits', 'search'));
    }

    // ✅ DELETE SINGLE VISIT
    public function destroy($id)
    {
        Visit::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Visit deleted successfully!');
    }

    // ✅ DELETE ALL VISITS
    public function destroyAll()
    {
        Visit::truncate();

        return redirect()->back()->with('success', 'All visits deleted successfully!');
    }
}