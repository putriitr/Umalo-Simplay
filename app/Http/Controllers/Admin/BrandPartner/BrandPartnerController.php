<?php

namespace App\Http\Controllers\Admin\BrandPartner;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandPartners = BrandPartner::all();
        return view('admin.brand.index', compact('brandPartners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|max:2048',
            'type' => 'required|in:brand,partner,principal',
            'url' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('uploads/brand', 'public');
        }

        BrandPartner::create($validated);

        return redirect()->route('admin.brand.index')->with('success', 'Brand Partner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('admin.brand.show', compact('brandPartner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('admin.brand.edit', compact('brandPartner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'type' => 'required|in:brand,partner,principal',
            'url' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        $brandPartner = BrandPartner::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($brandPartner->gambar) {
                Storage::delete('public/' . $brandPartner->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('uploads/brand', 'public');
        }

        $brandPartner->update($validated);

        return redirect()->route('admin.brand.index')->with('success', 'Brand Partner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);

        if ($brandPartner->gambar) {
            Storage::delete('public/' . $brandPartner->gambar);
        }

        $brandPartner->delete();

        return redirect()->route('admin.brand.index')->with('success', 'Brand Partner deleted successfully.');
    }
}
