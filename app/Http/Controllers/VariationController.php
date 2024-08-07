<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Support\Carbon;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("layouts.dashboard.variations.index", [
            'sizes' => Size::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("layouts.dashboard.variations.create",[
            'sizes' => Size::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Size::insert([
            'size' => $request-> size,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('size_added', 'Size added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
