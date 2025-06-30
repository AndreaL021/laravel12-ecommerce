<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
            $user = $request->user();

            // Gestione immagine
            if ($request->hasFile('img')) {
                // Elimina immagine precedente
                if ($user->img) {
                    Storage::disk('public')->delete($user->img);
                }

                // Salva nuova immagine con nome custom
                $path = $request->file('img')->storeAs(
                    'profiles',
                    $user->id . '.' . $request->file('img')->getClientOriginalExtension(),
                    'public'
                );
                $user->img = $path;
            }

            // Aggiorna dati
            $user->fill($request->validated());

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return Redirect::route('profile.edit')->with([
                'status' => 'success',
                'title' => '',
                'message' => 'profile.profile_updated'
            ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            // ✅ Elimina l'immagine se esiste
            if ($user->img) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->img);
            }

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/')
                ->with([
                    'status' => 'success',
                    'title' => '',
                    'message' => 'profile.profile_deleted'
                ]);
    }
}
