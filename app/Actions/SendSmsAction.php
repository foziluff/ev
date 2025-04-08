<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class SendSmsAction
{
    public function handle($phone, $message): void
    {
        $login  = env('OSONSMSLOGIN');
        $sender = env('OSONSMSSENDER');
        $hash   = env('OSONSMSHASH');
        $server = env('OSONSMSSERVER');

        $txn_id = uniqid();
        $str_hash = hash('sha256', "$txn_id;$login;$sender;$phone;$hash");

        $params = [
            "from"          => $sender,
            "phone_number"  => $phone,
            "msg"           => $message,
            "str_hash"      => $str_hash,
            "txn_id"        => $txn_id,
            "login"         => $login,
        ];

        Http::get($server, $params);
    }
}
