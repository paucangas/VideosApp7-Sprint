<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Serie::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $series = $query->paginate(12);

        return view('series.index', compact('series'));
    }

    public function show($id)
    {

        $serie = Serie::findOrFail($id);
        $videos = $serie->videos;

        return view('series.show', compact('serie', 'videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->store('images', 'public'); // Store file in 'storage/app/public/images'
            $data['image'] = basename($fileName); // Save only the file name
        }

        $data['user_name'] = auth()->user()->name;
        $data['user_photo_url'] = auth()->user()->profile_photo_url;
        $data['published_at'] = now();

        Serie::create($data);

        return redirect()->route('series.index')->with('success', 'Sèrie creada amb èxit!.');
    }

    public function create()
    {
        return view('series.create');
    }
}
