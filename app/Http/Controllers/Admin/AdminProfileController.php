<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdateAdminPasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateAdminProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    /**
     * Display the admin profile page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.pages.profiles.profile', compact('user'));
    }

    /**
     * Update the admin profile (name and email).
     */
    public function updateProfile(UpdateAdminProfileRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->update($request->validated());

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update the admin password.
     */
    public function updatePassword(UpdateAdminPasswordRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
}
