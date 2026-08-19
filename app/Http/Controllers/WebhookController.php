<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Simple webhook simulation handling
        $payload = $request->all();

        // In a real app we might dispatch a job or update a status based on payload
        // Example payload: {"scholarship_id": 1, "status": "closed"}
        
        if (isset($payload['scholarship_id']) && isset($payload['status'])) {
            $scholarship = \App\Models\Scholarship::find($payload['scholarship_id']);
            if ($scholarship) {
                $scholarship->update(['status' => $payload['status']]);
            }
        }

        return response()->json(['message' => 'Webhook received', 'processed' => true], 200);
    }
}
