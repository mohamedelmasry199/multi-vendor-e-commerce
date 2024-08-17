<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('admin.auth.forget_password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Sending the password reset link
        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        // Handling response based on status
        if ($status == Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => __('auth.Password reset link sent! Check your email.'),
                'status_code' => 200,
                'direction' => route('admin.login'),
            ], 200);
        } else {
            return response()->json([
                'message' => __('Unable to send password reset link.'),
                'status_code' => 500,
                'direction' => route('admin.password.request'),
            ], 500);
        }
    }

}
