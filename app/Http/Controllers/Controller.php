<?php

namespace App\Http\Controllers;

//use Illuminate\Contracts\Auth\Authenticatable;

abstract class Controller
{
//    protected ?Authenticatable $user;

    public function __construct()
    {
//        $this->user = auth()->user();
    }
}
