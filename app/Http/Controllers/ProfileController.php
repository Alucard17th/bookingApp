<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = User::findOrFail(auth()->id());
        $workingHours = $user->workingHours;
        return view('admin.profile.index', compact('user', 'workingHours'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'company_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->company_name = $request->company_name;
        $user->description = $request->description;
        $user->address = $request->address;
        $user->phone = $request->phone;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $user->logo = $logoPath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function markAllNotificationsAsRead(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function contact(Request $request)
    {
        $user = auth()->user();
        $user->website = $request->website;
        $user->facebook = $request->facebook;
        $user->instagram = $request->instagram;
        $user->linkedin = $request->linkedin;
        $user->twitter = $request->twitter;

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function saveIntegrations(Request $request)
    {
        $user = auth()->user();
        $user->google_calendar_id = $request->google_calendar_id;
        $user->save();

        return redirect()->back()->with('success', 'Integrations parameters updated successfully.');
    }
}
