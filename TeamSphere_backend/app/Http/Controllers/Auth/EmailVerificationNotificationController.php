<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['success' => true, 'message' => 'User already verified', "error" => null]);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['success' => true,'message' => 'verification-link-sent', "error" => null]);
    }
}
