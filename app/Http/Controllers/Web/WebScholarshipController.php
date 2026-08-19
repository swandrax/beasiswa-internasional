<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class WebScholarshipController extends Controller
{
    public function index()
    {
        // Prevent lazy loading is active globally, so we don't necessarily have with() 
        // unless we need creator. Right now Scholarship doesn't have a creator relation.
        $scholarships = Scholarship::latest()->paginate(10);
        
        return view('scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        return view('scholarships.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'provider' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|in:open,closed'
        ]);

        Scholarship::create($validated);

        return redirect()->route('web.scholarships.index')->with('success', 'Beasiswa berhasil ditambahkan.');
    }

    public function edit(Scholarship $scholarship)
    {
        return view('scholarships.edit', compact('scholarship'));
    }

    public function update(Request $request, Scholarship $scholarship)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'provider' => 'sometimes|required|string|max:255',
            'deadline' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:open,closed'
        ]);

        $scholarship->update($validated);

        return redirect()->route('web.scholarships.index')->with('success', 'Beasiswa berhasil diperbarui.');
    }

    public function destroy(Scholarship $scholarship)
    {
        $scholarship->delete();

        return redirect()->route('web.scholarships.index')->with('success', 'Beasiswa berhasil dihapus.');
    }
}
