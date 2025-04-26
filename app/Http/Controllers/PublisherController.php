<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::latest()->paginate(10);
        return view('publishers.index', compact('publishers'));
    }
    
    public function create()
    {
        return view('publishers.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        Publisher::create($validated);
        return redirect()->route('publishers.index')->with('success', 'Publisher added successfully');
    }
    
    public function edit(Publisher $publisher)
    {
        return view('publishers.edit', compact('publisher'));
    }
    
    public function update(Request $request, Publisher $publisher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $publisher->update($validated);
        return redirect()->route('publishers.index')->with('success', 'Publisher updated successfully');
    }
    
    public function destroy(Publisher $publisher)
    {
        try {
            DB::table('books')->where('publisher_id', $publisher->id)->delete();
            $publisher->delete();
            return redirect()->route('publishers.index')->with('success', 'Publisher deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('publishers.index')->with('error', 'Failed to delete publisher: ' . $e->getMessage());
        }
    }
}