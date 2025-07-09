<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class AnnouncementImageController extends Controller
{
    public function destroy(AnnouncementImage $image): RedirectResponse
    {
        $announcement = $image->announcement;

        // Verifica che l'utente sia proprietario dell'annuncio
        if (auth()->id() !== $announcement->user_id) {
            return back()->with([
                'status' => 'warning',
                'title' => '',
                'message' => 'validation.authorization'
            ]);
        }

        // Elimina file fisico
        Storage::disk('public')->delete($image->path);

        // Elimina record DB
        $image->delete();

        return back()->with([
            'status' => 'success',
            'title' => '',
            'message' => 'announcement.image_deleted'
        ]);
    }
}
