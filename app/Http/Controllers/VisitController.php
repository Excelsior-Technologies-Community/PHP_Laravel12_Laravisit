<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function index()
    {
        $totalVisits = Visit::count();
        return view('home', compact('totalVisits'));
    }

    public function track(Request $request)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'page_url'   => $request->fullUrl(),
        ]);

        return response()->json(['message' => 'Tracked']);
    }

    public function visits(Request $request)
    {
        $search = $request->search;
        $dateFrom = $request->date_from;

        $visits = Visit::when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ip_address', 'like', "%$search%")
                  ->orWhere('page_url', 'like', "%$search%");
            });
        })
        ->when($dateFrom, function ($query) use ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);

        $stats = [
            'total' => Visit::count(),
            'unique_ips' => Visit::distinct('ip_address')->count(),
            'top_url' => Visit::select('page_url', DB::raw('count(*) as total'))
                               ->groupBy('page_url')
                               ->orderBy('total', 'desc')
                               ->first()
        ];

        return view('visits.index', compact('visits', 'search', 'stats'));
    }

    public function exportCsv()
    {
        $visits = Visit::all();
        $fileName = 'visits_' . date('Y-m-d') . '.csv';

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID', 'IP Address', 'URL', 'Date']);

        foreach ($visits as $visit) {
            fputcsv($handle, [$visit->id, $visit->ip_address, $visit->page_url, $visit->created_at]);
        }
        fclose($handle);

        return response()->stream(function() use ($handle) {}, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ]);
    }

    public function destroy($id)
    {
        Visit::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted!');
    }

    public function destroyAll()
    {
        Visit::truncate();
        return redirect()->back()->with('success', 'Cleared!');
    }
}