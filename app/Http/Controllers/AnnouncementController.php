<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Mostra tutti gli annunci.
     */
    public function index()
    {
        $announcements = Announcement::with('categories', 'images')->latest()->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Mostra il form per creare un nuovo annuncio.
     */
    public function create()
    {
        $categories = Category::all();
        return view('announcements.create', compact('categories'));
    }

    /**
     * Salva un nuovo annuncio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'des' => 'required|string',
            'price' => 'required|numeric',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|max:2048',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'des' => $request->des,
            'price' => $request->price,
            'user_id' => Auth::id(),
        ]);

        // Categorie
        if ($request->filled('categories')) {
            $announcement->categories()->sync($request->categories);
        }

        // Immagini
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('announcements', 'public');
                $announcement->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('announcements.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'Annuncio creato con successo.'
        ]);
    }

    /**
     * Mostra un singolo annuncio.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('categories', 'images');
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Mostra il form di modifica.
     */
    public function edit(Announcement $announcement)
    {if ($announcement->user_id !== auth()->id()) {
    abort(403, 'Non sei autorizzato ad accedere a questo annuncio.');
}
        $categories = Category::all();
        return view('announcements.edit', compact('announcement', 'categories'));
    }

    /**
     * Aggiorna l'annuncio.
     */
    public function update(Request $request, Announcement $announcement)
    {
if ($announcement->user_id !== auth()->id()) {
    abort(403, 'Non sei autorizzato ad accedere a questo annuncio.');
}
        $request->validate([
            'title' => 'required|string|max:255',
            'des' => 'required|string',
            'price' => 'required|numeric',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'images.*' => 'image|max:2048',
        ]);

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

        return redirect()->route('announcements.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'Annuncio aggiornato con successo.'
        ]);
    }

    /**
     * Elimina l'annuncio.
     */
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
