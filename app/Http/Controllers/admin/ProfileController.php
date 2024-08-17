<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\AdminRequest;
use App\Http\Requests\admin\UserRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Traits\Images;


class ProfileController extends Controller
{
    use Images;

    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('admin.profile.index', [
            'user' => auth()->guard('admin')->user(),
        ]);
    }
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'countries'=>Country::all(),
            'user' => auth()->guard('admin')->user(),
        ]);
    }
    /**
     * Update the user's profile information.
     */
    // public function update(UserRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }
    public function update(AdminRequest $request)
    {
        $user=auth()->guard('admin')->user();
        $data = $request->except(['password', 'image']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('image')) {
            $folder = 'users';
            $this->deleteOldImage($user->image , $folder);
            $data['image'] = $this->uploadAvatarImage($request->file('image'), $folder);
        }

        $user->country()->associate($request->country);
        $user->city()->associate($request->city);
        $user->update($data);

        return response()->json(['status_code' => 200, 'message' => __('User updated successfully')]);
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
