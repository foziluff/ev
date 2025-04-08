<?php

namespace App\Http\Controllers\Api;

use App\Actions\SendSmsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SendCodeRequest;
use App\Repositories\PhoneVerifyCodeRepository;
use App\Repositories\UsersRepository;
use Illuminate\Http\JsonResponse;

class SendCodeController extends Controller
{

    public function __construct(
        readonly private UsersRepository $usersRepository,
        readonly private PhoneVerifyCodeRepository $phoneVerifyCodeRepository,
        readonly private SendSmsAction $sendSmsAction,
    )
    {
        parent::__construct();
    }

    public function sendCode(SendCodeRequest $request): JsonResponse
    {
        $user = $this->usersRepository->findByPhone($request->phone);
        if ($user && $user->status == 10) return response()->json(['message' => 'Blocked!'], 403);

        $minutes = 1;
        $time = now()->subMinute($minutes);

        if ($this->phoneVerifyCodeRepository->isAlreadySent($request->phone, $time)) {
            return response()->json(['message' => "Already sent!"], 429);
        }

        $request->merge(['code' => rand(1000, 9999)]);

        if ($request->phone == "992000000000") $request['code'] = 1111; // TODO временно потом убрать

        $message = "Ваш код: $request->code. Настоятельно рекомендуем не сообщать его третьим лицам.";

        $this->sendSmsAction->handle(substr($request->phone, 3), $message);

        $this->phoneVerifyCodeRepository->refresh($request->only('phone', 'code'));

        return response()->json([
            'message'   => 'Successfully sent!',
            'try_after' => $minutes * 60
        ]);
    }
}
