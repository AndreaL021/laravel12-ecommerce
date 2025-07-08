<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {

        $announcements = Announcement::latest()
            ->paginate(20);
        return view('welcome', compact('announcements'));
    }
    public function show(Announcement $announcement)
    {
    $announcements = Announcement::where('id', '!=', $announcement->id)
        ->whereHas('categories', function ($query) use ($announcement) {
            $query->whereIn('categories.id', $announcement->categories->pluck('id'));
        })
        ->latest()
        ->take(12)
        ->get();
        return view('show', compact('announcements', 'announcement'));
    }
    public function search(Request $request)
    {
        $query = $request->input('search');
        $categoryId  = $request->input('category');

        $announcements = Announcement::query()
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

        return view('welcome', compact('announcements', 'query', 'categoryId'));
    }
}
