<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 1. Show the creation form and a list of existing campaigns
    public function index()
    {
        $campaigns = Content::latest()->get();
        return view('admin.index', compact('campaigns'));
    }

    // 2. Process and save a new campaign card
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'original_url' => 'required|url',
            'points_per_click' => 'required|integer|min:1',
        ]);

        Content::create($request->all());

        return back()->with('status', '🎉 New ABM Marketing Campaign created successfully!');
    }

    // 3. Show the Edit Form view for a specific campaign card
    public function edit(Content $content)
    {
        return view('admin.edit', compact('content'));
    }

    // 4. Update the campaign card details in the database
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'instructions' => 'required|string',
            'original_url' => 'required|url',
            'points_per_click' => 'required|integer|min:1',
        ]);

        $content->update($request->all());

        return redirect()->route('admin.index')->with('status', '✏️ Campaign updated successfully!');
    }

    // 5. Delete a campaign completely from the database
    public function destroy(Content $content)
    {
        $content->delete();

        return back()->with('status', '🗑️ Campaign card removed permanently.');
    }
}
