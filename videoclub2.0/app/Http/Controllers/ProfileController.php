<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Storage;

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
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Subida de imagen de perfil (siguiendo la estructura de MoviesController)
        if ($request->hasFile('profile_image')) {
            // Eliminar imagen anterior si existe
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Guardar nueva imagen
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's profile image.
     */
    public function deleteProfileImage(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
            $user->profile_image = null;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-image-deleted');
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

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
