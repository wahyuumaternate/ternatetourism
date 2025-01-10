<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // $validated = $request->validateWithBag('updatePassword', [
        //     'current_password' => ['required', 'current_password'],
        //     'password' => ['required', Password::defaults(), 'confirmed'],
        // ]);

        // $request->user()->update([
        //     'password' => Hash::make($validated['password']),
        // ]);

        // notify()->success('Password has been updated successfully');
        // return back();
        try {
            $validated = $request->validateWithBag('updatePassword', [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'min:8', 'confirmed', Password::defaults()],
            ]);

            $request->user()->update([
                'password' => Hash::make($validated['password'])
            ]);

            notify()->success('Password has been updated successfully');
            return redirect()->route('profile.edit');

        } catch (\Exception $e) {
            notify()->error('Failed to update password');
            return redirect()->back()->withErrors([
                'current_password' => 'The provided password is incorrect.',
            ])->withInput();
        }
    }
}
