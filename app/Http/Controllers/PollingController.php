<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollingController extends Controller
{
    public function checkUpdates(Request $request)
    {
        // Simple short-polling implementation
        // Client can pass a 'last_checked' timestamp to get newly updated items
        
        $lastChecked = $request->query('last_checked');
        
        $query = \App\Models\Scholarship::query();
        
        if ($lastChecked) {
            $query->where('updated_at', '>=', $lastChecked);
        }

        $scholarships = $query->get();

        return response()->json([
            'timestamp' => now()->toDateTimeString(),
            'data' => $scholarships,
            'count' => $scholarships->count()
        ]);
    }
}
