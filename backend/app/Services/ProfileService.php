<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function updateProfile($request)
    {
        $profile = Auth::user()->profile;
        $validated = $request->validated();


        if ($request->hasFile('banner')) {
            Storage::disk('public')->delete($profile->banner);
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('picture')) {
            Storage::disk('public')->delete($profile->picture);
            $validated['picture'] = $request->file('picture')->store('pictures', 'public');
        }

        $profile->update($validated);
    }
}
