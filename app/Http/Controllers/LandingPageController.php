<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VhfEntry;

class LandingPageController extends Controller
{
    public function showForm()
    {
        return view('public-ship-entry', [
            'formSchema' => \App\Filament\Resources\LandingPageResource::getShipDetailsFormSchema(),
        ]);
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            // 'vessel_name' => 'required|string|max:50',
            // 'mmsi_number' => 'required|string|max:50',
        ]);

        VhfEntry::create($validated);

        return redirect()->back()->with('success', 'Data submitted successfully!');
    }
}
