<?php

namespace App\Http\Controllers;

use App\Models\MetalType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MetalTypeController extends Controller
{
    public function index()
    {
        $metalTypes = MetalType::all();
        return view('metal_types.index', compact('metalTypes'));
    }

    public function create()
    {
        return view('metal_types.create');
    }

    public function store(Request $request)
    {
        // 1) Basic validation
        $request->validate([
            'name'    => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        // 2) External API validation using REST Countries
        $response = Http::get(
            'https://restcountries.com/v3.1/name/' . urlencode($request->country),
            ['fullText' => 'true']
        );

        $data = $response->json();

        if ($response->failed() || empty($data) || isset($data['status'])) {
            return back()
                ->withErrors(['country' => 'Country not recognised. Please enter a valid country name.'])
                ->withInput();
        }

        // 3) If API says OK, create the metal type (we only store the name)
        MetalType::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('metal-types.index')
            ->with('success', 'Metal type created successfully (country validated via external API).');
    }

    public function edit(MetalType $metalType)
    {
        return view('metal_types.edit', compact('metalType'));
    }

    public function update(Request $request, MetalType $metalType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $metalType->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('metal-types.index')
            ->with('success', 'Metal type updated.');
    }

    public function destroy(MetalType $metalType)
    {
        $metalType->delete();

        return redirect()
            ->route('metal-types.index')
            ->with('success', 'Metal type deleted.');
    }
}
