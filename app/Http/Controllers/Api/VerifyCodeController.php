<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\VerifyCodeRequest;
use App\Models\PhoneVerifyCode;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class VerifyCodeController extends Controller
{
    public function devToken(): JsonResponse //TODO remove in production
    {
        $user = User::where('phone', '992002887717')->first();
        $user->tokens()->delete();
        $token = $user->createToken('access_token');
        return response()->json(['access_token' => $token->plainTextToken]);
    }
    public function verifyCode(VerifyCodeRequest $request): JsonResponse
    {
        $phoneVerifyCode = PhoneVerifyCode::where('phone', $request->phone)->orderBy('id', 'desc')->first();
        if ($phoneVerifyCode) {
            if ($phoneVerifyCode->tries >= 3) {
                $phoneVerifyCode->delete();
                return response()->json(['message' => 'Too many attempts, please request a new code'], 422);
            }
            $phoneVerifyCode->increment('tries');
        }

        if (!$this->getIfVerified($request)) {
            return response()->json(['message' => 'Invalid code'], 400);
        }

        $user = User::firstOrCreate(['phone' => $request->phone], ['phone' => $request->phone]);

        $user->tokens()->delete();
        $phoneVerifyCode->delete();
        $token = $user->createToken('access_token');
        return response()->json(['access_token' => $token->plainTextToken]);
    }


    public function getIfVerified($request)
    {
        return PhoneVerifyCode::where([
            'phone' => $request->phone,
            'code' => $request->code,
        ])
            ->where('created_at', '>', now()
                ->subMinutes(1)
                ->toDateTimeString())
            ->where('tries', '<=', 3)
            ->orderBy('created_at', 'desc')
            ->first();
    }

}
