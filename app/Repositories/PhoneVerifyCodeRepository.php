<?php

namespace App\Repositories;
use App\Models\PhoneVerifyCode as Model;
use Carbon\Carbon;

class PhoneVerifyCodeRepository extends CoreRepository
{
    protected function getModel(): string
    {
        return Model::class;
    }

    public function isAlreadySent(string $phone, Carbon $time): int
    {
        return $this->startInit()
            ->where('phone', $phone)
            ->where('created_at', '>=', $time)
            ->count();
    }

    public function refresh(array $data): Model
    {
        $this->startInit()->where('phone', $data['phone'])->delete();
        return $this->startInit()->create($data);
    }
}
