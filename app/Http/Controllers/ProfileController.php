<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get the user's profile (if exists)
        $profile = $user->profile; // assuming you have `profile()` relation in User model

        if ($request->ajax()) {
            return view('profile.index', get_defined_vars());
        }
    }
    // Create or Update Profile
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'phone' => 'nullable|regex:/^[0-9]+$/|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'profile' => $profile,
        ]);
    }
    // Upload profile photo separately
    public function uploadPhoto(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        // Fetch existing profile
        $profile = Profile::where('user_id', $user->id)->first();

        // ✅ Delete old photo if it exists
        if ($profile && $profile->profile_photo) {
            $oldPath = str_replace('storage/', '', $profile->profile_photo); // fix path format
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // ✅ Store new photo
        $path = $request->file('profile_photo')->store('profiles', 'public');

        // ✅ Update or create profile record
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id],
            ['profile_photo' => $path]
        );

        return response()->json([
            'success' => true,
            'message' => 'Profile photo updated successfully!',
            'photo_url' => asset('storage/' . $path),
        ]);
    }
}
