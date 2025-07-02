<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Auth::user()->announcements()->latest()->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('announcements.create', compact('categories'));
    }

    public function store(AnnouncementRequest $request)
    {
        $announcement = Announcement::create([
            'title' => $request->title,
            'des' => $request->des,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        // Associa categorie
        if ($request->filled('categories')) {
            $announcement->categories()->sync($request->categories);
        }

        // Salva immagini
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('announcements', 'public');
                $announcement->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('announcement.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'Annuncio creato con successo.'
        ]);
    }

    public function show(Announcement $announcement)
    {
        $announcement->load('categories', 'images');
        return view('announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        if ($announcement->user_id !== auth()->id()) {
            
             return back()->with([
            'status' => 'danger',
            'title' => '',
            'message' => 'validation.authorization'
        ]);
        }
        $categories = Category::all();
        return view('announcements.edit', compact('announcement', 'categories'));
    }

    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        if ($announcement->user_id !== auth()->id()) {
             return back()->with([
            'status' => 'danger',
            'title' => '',
            'message' => 'validation.authorization'
        ]);
        }
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'des' => 'required|string',
        //     'price' => 'required|numeric',
        //     'categories' => 'array',
        //     'categories.*' => 'exists:categories,id',
        //     'images.*' => 'image|max:2048',
        // ]);

        $announcement->update([
            'title' => $request->title,
            'des' => $request->des,
            'price' => $request->price,
        ]);

        $announcement->categories()->sync($request->categories ?? []);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('announcements', 'public');
                $announcement->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('announcement.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'Annuncio aggiornato con successo.'
        ]);
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato ad accedere a questo annuncio.');
        }
        // elimina immagini fisiche
        foreach ($announcement->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $announcement->delete();

        return redirect()->route('announcements.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'Annuncio eliminato.'
        ]);
    }
}
