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
    public function search(Request $request)
    {
        $query = $request->input('search');

        $announcements = Announcement::where('title', 'like', "%{$query}%")
            ->orWhere('des', 'like', "%{$query}%")
            ->with(['images', 'categories'])
            ->latest()
            ->paginate(20); // meglio usare paginate per coerenza

        return view('welcome', compact('announcements', 'query'));
    }
}
