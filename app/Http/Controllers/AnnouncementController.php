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

    public function search(Request $request)
    {
        $query = $request->input('search');
        $categoryId  = $request->input('category');

        $announcements = Announcement::where('user_id', Auth::id())
            ->when($query, function ($q) use ($query) {
                $q->where(function ($sub) use ($query) {
                    $sub->where('title', 'like', "%{$query}%")
                        ->orWhere('des', 'like', "%{$query}%");
                });
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->whereHas('categories', function ($catQuery) use ($categoryId) {
                    $catQuery->where('categories.id', $categoryId);
                });
            })
            ->latest()
            ->paginate(20);

        return view('announcements.index', compact('announcements', 'query', 'categoryId'));
    }


    public function create()
    {
        return view('announcements.create');
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
            'message' => 'announcement.created'
        ]);
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
        return view('announcements.edit', compact('announcement'));
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

        $announcement->update([
            'title' => $request->title,
            'des' => $request->des,
            'price' => $request->price,
        ]);

        $announcement->categories()->sync($request->categories ?? []);

        // Elimina le immagini selezionate
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $announcement->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }

        // Salva nuove immagini
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('announcements', 'public');
                $announcement->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('announcement.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'announcement.updated'
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

        return redirect()->route('announcement.index')->with([
            'status' => 'success',
            'title' => '',
            'message' => 'announcement.deleted'
        ]);
    }
}
